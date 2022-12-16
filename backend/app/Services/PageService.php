<?php

namespace App\Services;

use App\Models\Page;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\PageRepository;
use App\Exceptions\ClientErrorException;
use App\Libraries\StaticHelpPageContent;
use App\Repositories\LangGroupRepository;
use App\Repositories\NewsCategoryRepository;

class PageService extends AbstractService
{
    protected $repository = PageRepository::class;

    public function allOrByLangId($langId = null)
    {
        if (empty($langId)) {
            return $this->all();
        }
        return $this->repository::allByLangId($langId);
    }

    public function create($data)
    {
        if(LangGroupRepository::exists($data['lang_group_id'], $data['lang_id'], Page::class)) {
            throw new ClientErrorException('The page already exists for this language group.');
        }

        if (is_null($data['lang_group_id'])) {
            $data['lang_group_id'] = LangGroupRepository::getId(Page::class);
        }
        $data['json_values'] = $this->prepereJsonValues($data);
        $data['json_rules'] = json_encode(StaticHelpPageContent::$pageDefaultJsonContent, JSON_UNESCAPED_UNICODE);
        $data['name'] = Str::slug(strtolower($data['title']));
        $data['route'] = '/'. str_replace('/', '', str_replace(' ', '-', $data['route']));
        return $this->repository::create($data);
    }

    public function update(Request $request, $pageId)
    {
        $page = $this->findByIdOrFail($pageId);
        $rules = array_merge($page->getValidationRules(), [
            'can_delete' => ['required', 'in:yes,no'],
            'main_menu_show' => ['required', 'in:yes,no'],
            'footer_menu_show' => ['required', 'in:yes,no'],
            'route' => ['required', 'string', 'unique:pages,route,'.$page->id],
        ]);
        $data = $request->validate($rules);
        $data['json_values'] = $this->prepereJsonValues($data, $page);

        return  $this->repository::update($data, $page);
    }

    public function prepereJsonValues($data, $page = null)
    {
        if($page) {
            $values = $page->getContentValues();
            foreach ($page->getContentRules() as $key => $value) {
                if ($value->editable) {
                    $values->$key = $data[$key];
                }
            }
        } else {
            $values = (object) $data;
        }
        return json_encode($values, JSON_UNESCAPED_UNICODE);
    }


    public function datatable($langId = null)
    {
        $languages = (new LanguageService)->all();
        $query = Page::with(['language'])
            ->when($langId, function($q) use($langId){
                $q->where('lang_id', $langId);
            });

        return datatables()->eloquent($query)
            ->addColumn('title', function (Page $page) {
                return $page->getFieldValue('title');
            })
            ->addColumn('language', function (Page $page) {
                return $page->language->title;
            })
            ->addColumn('lang_groups', function (Page $page) use ($languages) {
                $string = '';
                foreach ($languages as $lang) {
                    if ($page->lang_id !== $lang->id) {
                        $string .= "<a class='page-language text-primary me-2' href='#' data-lang_group_id='{$page->lang_group_id}'
                        data-lang_id='{$lang->id}'>{$lang->html_lang}</a>";
                    }
                }
                return $string;
            })
            ->escapeColumns()
            ->rawColumns(['lang_groups'])
            ->make(true);
    }

    public function delete($pageId)
    {
        $page = $this->findByIdOrFail($pageId);
        if(!$page->canDelete()) {
            throw new ClientErrorException("Page {$page->name} can not be deleted.");
        }
        return $this->repository::delete($page);
    }
}

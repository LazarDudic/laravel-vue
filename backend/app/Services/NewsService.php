<?php

namespace App\Services;

use App\Models\News;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use App\Repositories\NewsRepository;
use App\Exceptions\ClientErrorException;
use App\Repositories\LangGroupRepository;
use App\Repositories\NewsCategoryRepository;

class NewsService extends AbstractService
{
    protected $repository = NewsRepository::class;

    public function create($data)
    {
        if(LangGroupRepository::exists($data['lang_group_id'], $data['lang_id'], News::class)) {
            throw new ClientErrorException('The news already exists for this language group.');
        }

        $data['owner_id'] = auth()->id();
        $category = (new CategoryService())->findById($data['category_id']);

        if (!$category->isTypeOf('news')) {
            throw new ClientErrorException('Selected Category must be type of news');
        }

        if (is_null($data['lang_group_id'])) {
            $data['lang_group_id'] = LangGroupRepository::getId(News::class);
        }
        try {
            DB::beginTransaction();
            $news = $this->repository::create($data);
            NewsCategoryRepository::create([
                'news_id' => $news->id,
                'category_id' => $category->id,
                'main_category' => 'yes'
            ]);
            DB::commit();
            return $news;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function update($data, $newsId)
    {
        $news = $this->findByIdOrFail($newsId);
        unset($data['lang_group_id']);

        $newsCat = NewsCategoryRepository::findByField('news_id', $newsId);
        NewsCategoryRepository::updateOrCreate(['category_id' => $data['category_id']], $newsCat);

        return $this->repository::update($data, $news);
    }

    public function datatable($langId = null)
    {
        $languages = (new LanguageService)->all();
        $query = News::with(['image', 'mainCategory', 'language'])
            ->when($langId, function($q) use($langId){
                $q->where('lang_id', $langId);
            });
        return datatables()->eloquent($query)
            ->addColumn('image_path', function (News $news) {
                return "<img height='70' src='{$news->image->getThumbPath()}' />";;
            })
            ->addColumn('category_title', function (News $news) {
                return $news->mainCategory?->first()->title;
            })
            ->editColumn('status', function (News $news) {
                $class = $news->status === 'published' ? 'badge-success' : 'badge-warning';
                return '<span class="badge rounded-pill '.$class.'">'.ucwords($news->status).'</span>';
            })
            ->addColumn('language', function (News $news) {
                return $news->language->title;
            })
            ->addColumn('lang_groups', function (News $news) use ($languages) {
                $string = '';
                foreach ($languages as $lang) {
                    if ($news->lang_id !== $lang->id) {
                        $string .= "<a class='news-language text-primary me-2' href='#' data-lang_group_id='{$news->lang_group_id}'
                        data-lang_id='{$lang->id}'>{$lang->html_lang}</a>";
                    }
                }
                return $string;
            })
            ->escapeColumns()
            ->rawColumns(['image_path', 'lang_groups', 'status'])
            ->make(true);
    }
}

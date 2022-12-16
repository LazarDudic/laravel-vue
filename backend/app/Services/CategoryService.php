<?php

namespace App\Services;

use App\Models\Category;
use App\Models\CategoryRel;
use Illuminate\Support\Facades\DB;
use App\Exceptions\ClientErrorException;
use App\Repositories\CategoryRepository;
use App\Repositories\LangGroupRepository;
use App\Repositories\CategoryRelRepository;

class CategoryService extends AbstractService
{
    protected $repository = CategoryRepository::class;

    public function allOrByLangId($langId = null)
    {
        if (empty($langId)) {
            return $this->all();
        }
        return $this->repository::allByLangId($langId);
    }

    public function getByType($type, $langId = null)
    {
        return $this->repository::getByType($type, $langId);
    }

    public function allByLangId($langId = null, $useDefaultLang = false)
    {
        if (is_null($langId) && !$useDefaultLang) {
            throw new ClientErrorException('Language Id is not set.');
        }

        if (is_null($langId)) {
            $appSettings = (new AppSettingsService)->getSettings();
            $langId = $appSettings->default_lang_id;
        }

        return $this->repository::allByLangId($langId);
    }

    public function create($data)
    {
        if(LangGroupRepository::exists($data['lang_group_id'], $data['lang_id'], Category::class)) {
            throw new ClientErrorException('The category already exists for this language group.');
        }

        if($this->titleExist($data['title'], $data['lang_id'], $data['type'])) {
            throw new ClientErrorException('The title for this language alredy exist, please take the other name.');
        }

        if($data['parent_id'] && !$this->findByFields([
            'lang_id' => $data['lang_id'],
            'id' => $data['parent_id'],
            'type' => $data['type']
        ])) {
            throw new ClientErrorException('The parent category does not exist.');
        }

        if (is_null($data['lang_group_id'])) {
            $data['lang_group_id'] = LangGroupRepository::getId(Category::class);
        }

        $category = $this->repository::create($data);

        if($data['parent_id']) {
            CategoryRelRepository::updateOrCreateParent($data['parent_id'], $category);
        }
        return $category;
    }

    public function update($data, $categoryId)
    {
        $category = $this->findByIdOrFail($categoryId);
        unset($data['lang_group_id']);

        if($data['parent_id']
            && !$this->parentExists($data['parent_id'], $category->lang_id, $category->type)
        ) {
            throw new ClientErrorException('The parent Category does not exist.');
        }

        $titleExist = $this->titleExist($data['title'], $category->lang_id, $category->type);
        if($titleExist && $titleExist?->id !== $category->id) {
            throw new ClientErrorException('Title for this language and type alredy exist, please take the other name.');
        }

        if($data['parent_id']) {
            CategoryRelRepository::updateOrCreateParent($data['parent_id'], $category);
        }

        return $this->repository::update($data, $category);
    }

    public function titleExist($title, $langId, $type)
    {
        return $this->findByFields([
            ['title', '=', $title],
            ['lang_id', '=', $langId],
            ['type', '=', $type],
        ]);
    }

    public function parentExists($parentId, $langId, $type)
    {
        return $this->findByFields([
            ['id', '=', $parentId],
            ['lang_id', '=', $langId],
            ['type', '=', $type],
        ]);
    }

    public function delete($catId)
    {
        $category = $this->findByIdOrFail($catId);
        try {
            DB::beginTransaction();
            CategoryRelRepository::deleteByCategoryId($catId);
            $this->repository::delete($category);
            DB::commit();
            return $category;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

}

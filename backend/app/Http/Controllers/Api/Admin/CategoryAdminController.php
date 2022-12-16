<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Response;
use App\Services\CategoryService;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Requests\Admin\Category\StoreCategoryRequest;
use App\Http\Requests\Admin\Category\UpdateCategoryRequest;
use App\Models\Category;

class CategoryAdminController extends Controller
{
    public function __construct(protected CategoryService $categoryServ){}

    public function list($langId = null)
    {
        $langId = $langId ?? request()->header('LanguageId');
        $categories = $this->categoryServ->allOrByLangId($langId);
        $categories->load(['image', 'language', 'parent']);
        return CategoryResource::collection($categories);
    }

    public function allByLanguageIdAndType($langId, $type, $id = null)
    {
        $categories = $this->categoryServ->getByFields([
            ['lang_id', '=', $langId],
            ['type', '=', $type],
            ['id', '!=', $id]
        ]);

        return CategoryResource::collection($categories);
    }

    public function getByType($type, $langId = null)
    {
        $categories = $this->categoryServ->getByType($type, $langId);
        $categories->load(['image', 'language', 'parent']);
        return CategoryResource::collection($categories);
    }

    public function findById($categoryId)
    {
        $category = $this->categoryServ->findByIdOrFail($categoryId);
        $category->load('parent');
        return CategoryResource::make($category);
    }

    public function getChildren($categoryId)
    {
        $category = $this->categoryServ->findByIdOrFail($categoryId);

        return CategoryResource::collection($category->children);
    }

    public function findByGroupIdAndLanguageId($langGroupId, $langId)
    {
        $category = $this->categoryServ->findByFields([
            ['lang_id', '=', $langId],
            ['lang_group_id', '=', $langGroupId],
        ]);
        if(! $category) {
            return response([]);
        }
        return CategoryResource::make($category);

    }

    public function store(StoreCategoryRequest $request)
    {
        $category = $this->categoryServ->create($request->validated());

        return response()->json(['success' => 'Category ' . $category->title . ' has been created.'], Response::HTTP_CREATED);
    }

    public function update(UpdateCategoryRequest $request, $categoryId)
    {
        $category = $this->categoryServ->update($request->validated(), $categoryId);

        return response()->json(['success' => 'Category ' . $category->title . ' has been updated.'], Response::HTTP_OK);
    }

    public function delete($categoryId)
    {
        $category = $this->categoryServ->delete($categoryId);

        return response()->json(['success' => 'Category ' . $category->title . ' has been deleted.'], Response::HTTP_OK);
    }
}

<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Services\PageService;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\PageResource;
use App\Http\Requests\Admin\Page\StorePageRequest;

class PageAdminController extends Controller
{
    public function __construct(protected PageService $pageServ){}

    public function list($langId = null)
    {
        $langId = $langId ?? request()->header('LanguageId');
        $categories = $this->pageServ->allOrByLangId($langId);
        $categories->load(['image', 'language', 'parent']);
        return PageResource::collection($categories);
    }

    public function datatablePage($langId = null)
    {
        return $this->pageServ->datatable($langId);
    }

    public function findById($pageId)
    {
        $page = $this->pageServ->findByIdOrFail($pageId);
        return PageResource::make($page);
    }

    public function findByGroupIdAndLanguageId($langGroupId, $langId)
    {
        $page = $this->pageServ->findByFields([
            ['lang_id', '=', $langId],
            ['lang_group_id', '=', $langGroupId],
        ]);
        if(! $page) {
            return response([]);
        }
        return PageResource::make($page);

    }

    public function store(StorePageRequest $request)
    {
        $page = $this->pageServ->create($request->validated());

        return response()->json(['success' => 'Page ' . $page->name . ' has been created.'], Response::HTTP_CREATED);
    }

    public function update(Request $request, $pageId)
    {
        $page = $this->pageServ->update($request, $pageId);

        return response()->json(['success' => 'Page ' . $page->name . ' has been updated.'], Response::HTTP_OK);
    }

    public function delete($pageId)
    {
        $page = $this->pageServ->delete($pageId);

        return response()->json(['success' => 'Page ' . $page->name . ' has been deleted.'], Response::HTTP_OK);
    }
}

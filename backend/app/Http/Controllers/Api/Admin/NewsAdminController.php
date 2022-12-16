<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\News;
use App\Services\NewsService;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\NewsResource;
use App\Http\Requests\Admin\News\StoreNewsRequest;
use App\Http\Requests\Admin\News\UpdateNewsRequest;

class NewsAdminController extends Controller
{
    public function __construct(protected NewsService $newsServ){}

    public function findById($id)
    {
        $news = $this->newsServ->findByIdOrFail($id);
        return NewsResource::make($news);
    }

    public function findByGroupIdAndLanguageId($langGroupId, $langId)
    {
        $news = $this->newsServ->findByFields([
            ['lang_id', '=', $langId],
            ['lang_group_id', '=', $langGroupId],
        ]);
        if(! $news) {
            return response([]);
        }
        $news->load('mainCategory');
        return NewsResource::make($news);

    }

    public function store(StoreNewsRequest $request)
    {
        $news = $this->newsServ->create($request->validated());

        return response()->json(['success' => 'News ' . $news->title . ' has been created.'], Response::HTTP_CREATED);
    }

    public function update(UpdateNewsRequest $request, $newsId)
    {
        $news = $this->newsServ->update($request->validated(), $newsId);

        return response()->json(['success' => 'News ' . $news->title . ' has been updated.'], Response::HTTP_OK);
    }

    public function delete($newsId)
    {
        $news = $this->newsServ->delete($newsId);

        return response()->json(['success' => 'news ' . $news->title . ' has been deleted.'], Response::HTTP_OK);
    }

    public function datatableNews($langId = null)
    {
        return $this->newsServ->datatable($langId);
    }

}

<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Response;
use App\Services\LanguageService;
use App\Http\Controllers\Controller;
use App\Http\Resources\LanguageResource;
use App\Http\Requests\Admin\LanguageRequest;

class LanguageAdminController extends Controller
{
    public function __construct(protected LanguageService $langServ){}

    public function list()
    {
        return LanguageResource::collection($this->langServ->all());
    }

    public function findById($id)
    {
        return LanguageResource::make($this->langServ->findByIdOrFail($id));
    }

    public function store(LanguageRequest $request)
    {
        $this->langServ->create($request->validated());
        return response()->json(['success' => 'Language has been created.'], Response::HTTP_CREATED);
    }

    public function update($langId, LanguageRequest $request)
    {
        $this->langServ->update($request->validated(), $langId);
        return response()->json(['success' => 'Language has been updated.'], Response::HTTP_OK);
    }

    public function delete($langId)
    {
        $this->langServ->delete($langId);
        return response()->json(['success' => 'Language has been deleted.'], Response::HTTP_OK);
    }
}

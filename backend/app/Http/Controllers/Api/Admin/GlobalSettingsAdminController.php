<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Services\GlobalSettingsService;
use App\Http\Resources\GlobalSettingsResource;
use App\Http\Requests\Admin\GlobalSettingsRequest;

class GlobalSettingsAdminController extends Controller
{
    public function __construct(protected GlobalSettingsService $settingsServ){}

    public function list()
    {
        $globalSettings = $this->settingsServ->allOrByLangId(request()->header('LanguageId'));
        $globalSettings->load(['language']);
        return GlobalSettingsResource::collection($globalSettings);
    }

    public function findById($id)
    {
        return GlobalSettingsResource::make($this->settingsServ->findByIdOrFail($id));
    }

    public function update($id, GlobalSettingsRequest $request)
    {

        $settings = $this->settingsServ->update($request->validated(), $id);
        return response()->json([
            'success' => 'Settings has been updated.',
            'data' => GlobalSettingsResource::make($settings)
            ]
            , Response::HTTP_OK);
    }
}

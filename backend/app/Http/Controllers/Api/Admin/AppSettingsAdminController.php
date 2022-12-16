<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\AppSettingsResource;
use App\Http\Requests\Admin\AppSettingsRequest;
use App\Services\AppSettingsService;

class AppSettingsAdminController extends Controller
{
    public function __construct(protected AppSettingsService $settingsServ){}

    public function get()
    {
        return AppSettingsResource::make($this->settingsServ->getSettings());
    }

    public function update(AppSettingsRequest $request)
    {
        $settings = $this->settingsServ->update($request->validated());
        return response()->json([
            'success' => 'Settings has been updated.',
            'data' => AppSettingsResource::make($settings)
            ]
            , Response::HTTP_OK);
    }
}

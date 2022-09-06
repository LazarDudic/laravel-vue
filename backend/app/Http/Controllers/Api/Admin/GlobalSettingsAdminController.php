<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Services\GlobalSettingsService;
use App\Http\Resources\GlobalSettingsResource;
use App\Http\Requests\Admin\GlobalSettingsRequest;

class GlobalSettingsAdminController extends Controller
{
    public function __construct(protected GlobalSettingsService $settingsServ){}

    public function get()
    {
        return GlobalSettingsResource::make($this->settingsServ->getSettings());
    }

    public function update(GlobalSettingsRequest $request)
    {
        abort_if(Gate::denies('global-settings-update'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $this->settingsServ->update($request->validated());
        return response()->json([
            'success' => 'Settings has been updated.',
            'data' => GlobalSettingsResource::make($this->settingsServ->getSettings())
            ]
            , 200);
    }
}

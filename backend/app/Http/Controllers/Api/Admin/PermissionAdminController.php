<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\PermissionService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\PermissionResource;
use App\Http\Requests\Admin\PermissionRequest;


class PermissionAdminController extends Controller
{
    public function __construct(protected PermissionService $permissionServ){}

    public function list()
    {
        abort_if(Gate::denies('permissions-list'), Response::HTTP_FORBIDDEN, 'Forbidden');

        return PermissionResource::collection($this->permissionServ->all());
    }

    public function findById($permissionId)
    {
        abort_if(Gate::denies('permissions-find'), Response::HTTP_FORBIDDEN, 'Forbidden');

        return PermissionResource::make($this->permissionServ->findByIdOrFail($permissionId));
    }

    public function store(PermissionRequest $request)
    {
        abort_if(Gate::denies('permissions-create'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $permission = $this->permissionServ->create($request->validated());

        return response()->json(['success' => 'Permission ' . $permission->name . ' has been created.'], 200);
    }

    public function update(PermissionRequest $request, $permissionId)
    {
        abort_if(Gate::denies('permissions-update'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $permission = $this->permissionServ->update($request->validated(), $permissionId);

        return response()->json(['success' => 'Permission ' . $permission->name . ' has been updated.'], 200);
    }

    public function delete($permissionId)
    {
        abort_if(Gate::denies('permissions-delete'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $permission = $this->permissionServ->delete($permissionId);

        return response()->json(['success' => 'User ' . $permission->name . ' has been deleted.'], 200);
    }
}

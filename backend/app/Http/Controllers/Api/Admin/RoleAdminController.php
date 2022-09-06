<?php

namespace App\Http\Controllers\Api\Admin;

use PDO;
use Illuminate\Http\Request;
use App\Services\RoleService;
use Illuminate\Http\Response;
use PhpParser\Node\Stmt\TryCatch;
use App\Http\Controllers\Controller;
use App\Http\Resources\RoleResource;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Admin\RoleRequest;

class RoleAdminController extends Controller
{
    public function __construct(protected RoleService $roleServ){}

    public function list()
    {
        abort_if(Gate::denies('roles-list'), Response::HTTP_FORBIDDEN, 'Forbidden');

        return RoleResource::collection($this->roleServ->all());
    }

    public function findById($roleId)
    {
        abort_if(Gate::denies('roles-find'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $role = $this->roleServ->findByIdOrFail($roleId);
        $role->load('permissions');
        return RoleResource::make($role);
    }

    public function store(RoleRequest $request)
    {
        abort_if(Gate::denies('roles-create'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $role = $this->roleServ->create($request->validated());

        return response()->json(['success' => 'Role ' . $role->name . ' has been created.'], 200);
    }

    public function update(RoleRequest $request, $roleId)
    {
        abort_if(Gate::denies('roles-update'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $role = $this->roleServ->update($request->validated(), $roleId);

        return response()->json(['success' => 'Role ' . $role->name . ' has been updated.'], 200);
    }

    public function delete($roleId)
    {
        abort_if(Gate::denies('roles-delete'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $role = $this->roleServ->delete($roleId);

        return response()->json(['success' => 'User ' . $role->name . ' has been deleted.'], 200);
    }
}

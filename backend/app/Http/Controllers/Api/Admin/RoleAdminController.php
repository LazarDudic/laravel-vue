<?php

namespace App\Http\Controllers\Api\Admin;

use PDO;
use Illuminate\Http\Request;
use App\Services\RoleService;
use Illuminate\Http\Response;
use PhpParser\Node\Stmt\TryCatch;
use App\Http\Controllers\Controller;
use App\Http\Resources\RoleResource;
use App\Http\Requests\Admin\RoleRequest;

class RoleAdminController extends Controller
{
    public function __construct(protected RoleService $roleServ){}

    public function list()
    {
        return RoleResource::collection($this->roleServ->all());
    }

    public function findById($roleId)
    {
        return RoleResource::make($this->roleServ->findByIdOrFail($roleId));
    }

    public function store(RoleRequest $request)
    {

        $role = $this->roleServ->create($request->validated());

        return response()->json(['success' => 'Role ' . $role->name . ' has been created.'], Response::HTTP_CREATED);
    }

    public function update(RoleRequest $request, $roleId)
    {
        $role = $this->roleServ->update($request->validated(), $roleId);

        return response()->json(['success' => 'Role ' . $role->name . ' has been updated.'], Response::HTTP_OK);
    }

    public function delete($roleId)
    {
        $role = $this->roleServ->delete($roleId);

        return response()->json(['success' => 'User ' . $role->name . ' has been deleted.'], Response::HTTP_OK);
    }
}

<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\User;
use App\Libraries\Datatable;
use App\Services\UserService;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Admin\User\CreateUserRequest;
use App\Http\Requests\Admin\User\UpdateUserRequest;

class UserAdminController extends Controller
{
    public function __construct(protected UserService $userServ){ }

    public function findById($id)
    {
        abort_if(Gate::denies('users-find'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $user = $this->userServ->findByIdOrFail($id);
        return UserResource::make($user);
    }

    public function store(CreateUserRequest $request)
    {
        abort_if(Gate::denies('users-create'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $user = $this->userServ->create($request->validated());

        return response()->json(['success' => 'User ' . $user->full_name . ' has been created.'], 200);
    }

    public function update(UpdateUserRequest $request, $userId)
    {
        abort_if(Gate::denies('users-update'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $user = $this->userServ->update($request->validated(), $userId);

        return response()->json(['success' => 'User ' . $user->full_name . ' has been updated.'], 200);
    }

    public function delete($userId)
    {
        abort_if(Gate::denies('users-delete'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $user = $this->userServ->delete($userId);

        return response()->json(['success' => 'User ' . $user->full_name . ' has been deleted.'], 200);
    }

    public function datatableUsers()
    {
        abort_if(Gate::denies('users-list'), Response::HTTP_FORBIDDEN, 'Forbidden');

        return datatables()->eloquent(User::with('role'))->toJson();
    }
}

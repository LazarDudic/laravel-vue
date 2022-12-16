<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Requests\Admin\User\StoreUserRequest;
use App\Http\Requests\Admin\User\UpdateUserRequest;

class UserAdminController extends Controller
{
    public function __construct(protected UserService $userServ){ }

    public function findById($id)
    {
        $user = $this->userServ->findByIdOrFail($id);
        return UserResource::make($user);
    }

    public function store(StoreUserRequest $request)
    {
        $user = $this->userServ->create($request->validated());

        return response()->json(['success' => 'User ' . $user->full_name . ' has been created.'], Response::HTTP_CREATED);
    }

    public function update(UpdateUserRequest $request, $userId)
    {
        $user = $this->userServ->update($request->validated(), $userId);

        return response()->json(['success' => 'User ' . $user->full_name . ' has been updated.'], Response::HTTP_OK);
    }

    public function delete($userId)
    {
        $user = $this->userServ->delete($userId);

        return response()->json(['success' => 'User ' . $user->full_name . ' has been deleted.'], Response::HTTP_OK);
    }

    public function datatableUsers()
    {
        return datatables()->eloquent(User::with('role'))->toJson();
    }
}

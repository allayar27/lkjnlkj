<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\Contracts\UserContract;


class UserController extends Controller
{
    public function index(User $user)
    {
        $this->authorize('viewAny', $user);
        return new UserCollection(User::orderBy('created_at', 'DESC')->get());
    }

    public function show($id, User $user)
    {
        $this->authorize('view', $user);
        $user = User::findOrFail($id);
        return new UserResource($user);
    }

    public function create(UserRequest $request, User $user, UserContract $userContract)
    {
        $this->authorize('create', $user);
        return $userContract->create($request);
    }

    public function update(UserRequest $request, $id, User $user, UserContract $userContract)
    {
        $this->authorize('update', $user);
        return $userContract->update($request, $id);
    }

    public function destroy($id, User $user, UserContract $userContract)
    {
        $this->authorize('delete', $user);
        return $userContract->delete($id);
    }
}

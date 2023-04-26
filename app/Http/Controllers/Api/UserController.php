<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\UserService;
use App\Traits\ApiResponser;


class UserController extends Controller
{
    use ApiResponser;

    /** @var UserService */
    private $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function index(User $user)
    {
        $this->authorize('viewAny', $user);
        $collection = $user->orderBy('created_at', 'DESC')->get();
        return UserResource::collection($collection);
    }

    public function show(User $user)
    {
        $this->authorize('view', $user);
        $user = $user->findOrFail($user->id);
        return new UserResource($user);
    }

    public function create(UserRequest $request)
    {
        $valid = $request->validated();
        $create = $this->service->create($valid);
        if (!$create){
            return $this->error('creating was failed', 400);
        }
        return $this->success([
            $create,
            'token' => $create->createToken('bearer-token')->plainTextToken
        ],'created successfully!',201);
    }

    public function update(User $user, UserUpdateRequest $request)
    {
        $valid = $request->validated();
        $update = $user->where('id', $user->id)->update($valid);
        if(!$update){
            return $this->error('Updating is failed!',400);
        }
        return $this->success($update,'Updated successfully!',200);
    }

    public function destroy(User $user)
    {
        $this->authorize('delete', $user);
        $delete = $user->findOrFail($user->id)->delete();
        return $this->success($delete,'deleted successfully!',200);
    }
}

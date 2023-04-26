<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    use HandlesAuthorization;


    public function viewAny(?User $user)
    {
        if($user->can('viewAny-users')){
            return Response::allow();
        };
        return Response::deny('Вам запрешено');
    }


    public function view(?User $user)
    {
        if($user->can('view-users')){
            return Response::allow();
        };
        return Response::deny('Вам запрешено');
    }


    public function create(?User $user)
    {
        if($user->can('create-users')){
            return Response::allow();
        };
        return Response::deny('Вам запрешено');
    }


    public function update(?User $user)
    {
        if($user->can('edit-users')){
            return Response::allow();
        };
        return Response::deny('Вам запрешено');
    }


    public function delete(?User $user)
    {
        if($user->can('delete-users')){
            return Response::allow();
        };
        return Response::deny('Вам запрешено');
    }



}

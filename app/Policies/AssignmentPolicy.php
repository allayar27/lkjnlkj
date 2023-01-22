<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class AssignmentPolicy
{
    use HandlesAuthorization;


    public function viewAny(?User $user)
    {
        if($user->can('viewAny-assignments')){
            return Response::allow();
        };
        return Response::deny('Вам запрешено');
    }


    public function view(?User $user)
    {
        if($user->can('view-assignments')){
            return Response::allow();
        };
        return Response::deny('Вам запрешено');
    }


    public function create(?User $user)
    {
        if($user->can('create-assignments')){
            return Response::allow();
        };
        return Response::deny('Вам запрешено');
    }


    public function update(?User $user)
    {
       if($user->can('edit-assignments')){
           return Response::allow();
       };
        return Response::deny('Вам запрешено');
    }


    public function delete(?User $user)
    {
       if($user->can('delete-assignments')){
           return Response::allow();
       };
        return Response::deny('Вам запрешено');
    }


}

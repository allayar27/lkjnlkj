<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class CategoryPolicy
{
    use HandlesAuthorization;


    public function viewAny(?User $user)
    {
       if($user->can('viewAny-categories')){
           return Response::allow();
       };
        return Response::deny('Вам запрешено');
    }


    public function view(?User $user)
    {
       if($user->can('view-categories')){
           return Response::allow();
       };
        return Response::deny('Вам запрешено');
    }


    public function create(?User $user)
    {
       if($user->can('create-categories')){
           return Response::allow();
       };
        return Response::deny('Вам запрешено');
    }


    public function update(?User $user)
    {
       if($user->can('edit-categories')){
           return Response::allow();
       };
        return Response::deny('Вам запрешено');
    }


    public function delete(?User $user)
    {
        if($user->can('delete-categories')){
            return Response::allow();
        };
        return Response::deny('Вам запрешено');
    }


}

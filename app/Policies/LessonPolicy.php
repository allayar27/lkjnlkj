<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class LessonPolicy
{
    use HandlesAuthorization;


    public function viewAny(?User $user)
    {
       if($user->can('viewAny-lessons')){
           return Response::allow();
       }
       return Response::deny('Вам запрешено');
    }


    public function view(?User $user)
    {
       if($user->can('view-lessons')){
           return Response::allow();
       }
       return Response::deny('Вам запрешено');
    }


    public function create(?User $user)
    {
       if($user->can('create-lessons')){
           return Response::allow();
       }
       return Response::deny('Вам запрешено');
    }


    public function update(?User $user)
    {
       if($user->can('edit-lessons')){
           return Response::allow();
       }
       return Response::deny('Вам запрешено');
    }


    public function delete(?User $user)
    {
       if($user->can('delete-lessons')){
           return Response::allow();
       }
       return Response::deny('Вам запрешено');
    }


}

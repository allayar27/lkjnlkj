<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class AdditionalPolicy
{
    use HandlesAuthorization;


    public function viewAny(?User $user)
    {
       if ($user->can('viewAny-additionals')){
           return Response::allow();
       };
       return Response::deny('Вам запрешено');
    }


    public function view(?User $user)
    {
       if ($user->can('view-additionals')){
           return Response::allow();
       };
       return Response::deny('Вам запрешено');
    }


    public function create(?User $user)
    {
       if($user->can('create-additionals')){
           return Response::allow();
       };
       return Response::deny('Вам запрешено');
    }


    public function update(?User $user)
    {
       if($user->can('edit-additionals')){
           return Response::allow();
       };
        return Response::deny('Вам запрешено');
    }


    public function delete(?User $user)
    {
       if($user->can('delete-additionals')){
           return Response::allow();
       };
        return Response::deny('Вам запрешено');
    }


}

<?php

namespace App\Policies;

use App\Models\Response;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ResponsePolicy
{
    use HandlesAuthorization;

    public function viewAny(?User $user)
    {
        if($user->can('viewAny-responses')){
            return \Illuminate\Auth\Access\Response::allow();
        };
        return \Illuminate\Auth\Access\Response::deny('Вам запрешено');
    }


    public function view(?User $user, Response $response)
    {
        if ($user->id === $response->user_id){
            return \Illuminate\Auth\Access\Response::allow();
        }
        return \Illuminate\Auth\Access\Response::deny('Вам запрешено');

    }


    public function create(?User $user)
    {
        if($user->can('create-responses')){
            return \Illuminate\Auth\Access\Response::allow();
        };
        return \Illuminate\Auth\Access\Response::deny('Вам запрешено');
    }


    public function update(?User $user, Response $response)
    {
        if ($user->can('edit-responses')) {
            if ($user->id === $response->user_id) {
                return \Illuminate\Auth\Access\Response::allow();
            }
        }
        return \Illuminate\Auth\Access\Response::deny('Вам запрешено');

    }


    public function delete(User $user, Response $response)
    {
        if ($user->can('delete-responses')) {
            if ($user->id === $response->user_id) {
                return \Illuminate\Auth\Access\Response::allow();
            }
        }
        return \Illuminate\Auth\Access\Response::deny('Вам запрешено');
    }

}

<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class CommentPolicy
{
    use HandlesAuthorization;


    public function viewAny(?User $user)
    {
        if ($user->can('viewAny-comments')){
            return Response::allow();
        }
        return Response::deny('Вам запрешено');
    }


    public function view(?User $user)
    {
        if ($user->can('view-comments')){
            return Response::allow();
        }
        return Response::deny('Вам запрешено');
    }


    public function create(?User $user)
    {
        if($user->can('create-comments')){
            return Response::allow();
        }
        return Response::deny('Вам запрешено');
    }


    public function delete(?User $user, Comment $comment)
    {
        if ($user->id === $comment->user_id){
            return Response::allow();
        }
        return Response::deny('Вам запрешено');
    }

}

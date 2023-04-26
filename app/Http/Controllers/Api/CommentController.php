<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Traits\ApiResponser;

class CommentController extends Controller
{
    use ApiResponser;

    public function index(Comment $comment)
    {
        $this->authorize('viewAny', $comment);
        $all = $comment->orderBy('created_at', 'DESC')->get();
        return CommentResource::collection($all);
    }

    public function show(Comment $comment)
    {
        $comment = $comment->findOrFail($comment->id);
        $this->authorize('view', $comment);
        return new CommentResource($comment);
    }


    public function create(CommentRequest $request, Comment $comment)
    {
        $validated = $request->validated();
        $create = $comment->create($validated);
        if (!$create){
            return $this->error('creating process is failed',400);
        }
        return $this->success($create,'created',201);
    }

    public function destroy(Comment $comment)
    {
        $comment->findOrFail($comment->id);
        $this->authorize('delete', $comment);
        $delete = $comment->delete();

        return $this->success($delete,'deleted',200);
    }
}

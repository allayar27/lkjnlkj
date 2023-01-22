<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentCollection;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Traits\ApiResponser;

class CommentController extends Controller
{
    use ApiResponser;

    public function index(Comment $comment)
    {
        $this->authorize('viewAny', $comment);
        return new CommentCollection(Comment::orderBy('created_at', 'DESC')->get());
    }

    public function show($id)
    {
        $comment = Comment::findOrFail($id);
        $this->authorize('view', $comment);
        return new CommentResource($comment);
    }


    public function create(CommentRequest $request, Comment $comment)
    {
        $this->authorize('create', $comment);
        $validated = $request->validated();
        $create = Comment::create($validated);
        if (!$create){
            return $this->error('creating process is failed',400);
        }
        return $this->success($create,'created',201);
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $this->authorize('delete', $comment);
        $delete = Comment::where('id', $id)->delete();
        if (!$delete){
            return $this->error('id not found!',404);
        }
        return $this->success($delete,'deleted',200);
    }
}

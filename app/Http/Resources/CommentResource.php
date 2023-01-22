<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{

    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'message' => $this->message,
            'user_name' => $this->user->name,
            'assignment' => $this->assignment->title,
            'created_at' => date($this->created_at)
        ];
    }
}

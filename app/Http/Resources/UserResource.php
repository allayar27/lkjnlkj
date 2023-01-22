<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{

    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'created_at' => date($this->created_at),
            'comments' => CommentResource::collection($this->comments),
            'responses' => ResponseResource::collection($this->responses)

        ];
    }
}

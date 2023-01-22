<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AssignmentResource extends JsonResource
{

    public function toArray($request)
    {

        return [

            'id' => $this->id,
            'title' => $this->title,
            'due_date' => $this->due_date,
            'file' => url('assignment/',$this->file),
            'lesson' => $this->lesson->title,
            'created_at' => date_format($this->created_at, 'd/m/Y H:i:s'),
            'comments' => CommentResource::collection($this->comments),
            'responses' => ResponseResource::collection($this->response)
        ];
    }
}

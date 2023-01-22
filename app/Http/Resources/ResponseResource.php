<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ResponseResource extends JsonResource
{

    public function toArray($request)
    {

        return [

            'id' => $this->id,
            'file' => url('response/'.$this->file),
            'title' => $this->title,
            'assignment' => $this->assignment->title,
            'user_name' => $this->user->name,
            'created_at' => date_format($this->created_at, 'd/m/Y H:i:s'),

        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdditionalResource extends JsonResource
{

    public function toArray($request)
    {
        return [

            'id' => $this->id,
            'title' => $this->title,
            'media' => url('download/',$this->media),
            'lesson_title' => $this->lesson->title,
            'created_at' => date_format($this->created_at, 'd/m/Y H:i:s'),

        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LessonResource extends JsonResource
{

    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'image' => url('images/',$this->image),
            'video' => $this->video,
            'category' => $this->category->name,
            'created_at' => date_format($this->created_at, 'd/m/Y H:i:s'),
        ];
    }
}

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
            'created_at' => date_format($this->created_at, 'd/m/Y H:i:s'),
            'responses' => ResponseResource::collection($this->responses)
        ];
    }
}

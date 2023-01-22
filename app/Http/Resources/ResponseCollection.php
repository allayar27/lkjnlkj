<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ResponseCollection extends ResourceCollection
{

    public function toArray($request)
    {
        return parent::toArray($request);
    }
}

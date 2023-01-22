<?php

namespace App\Services\Contracts;

use App\Http\Requests\AdditionalRequest;

interface AdditionalContract {

    public function create(AdditionalRequest $request);
    public function update(AdditionalRequest $request, $id);
    public function delete($id);
}

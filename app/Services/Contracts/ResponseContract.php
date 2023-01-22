<?php

namespace App\Services\Contracts;

use App\Http\Requests\ResponseRequest;

interface ResponseContract {
    public function get();
    public function getId($id);
    public function create(ResponseRequest $request);
    public function update(ResponseRequest $request, $id);
    public function delete($id);
}

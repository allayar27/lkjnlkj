<?php

namespace App\Services\Contracts;

use App\Http\Requests\UserRequest;

interface UserContract {

    public function create(UserRequest $request);
    public function update(UserRequest $request, $id);
    public function delete($id);
}

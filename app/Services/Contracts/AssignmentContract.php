<?php

namespace App\Services\Contracts;

use App\Http\Requests\AssignmentRequest;

interface AssignmentContract {

    public function get();
    public function show($id);
    public function search($title);
    public function create(AssignmentRequest $request);
    public function update(AssignmentRequest $request, $id);
    public function delete($id);
}

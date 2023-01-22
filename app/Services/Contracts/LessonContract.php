<?php

namespace App\Services\Contracts;

use App\Http\Requests\LessonRequest;

interface LessonContract {

    public function get();
    public function show($id);
    public function search($title);
    public function create(LessonRequest $request);
    public function update(LessonRequest $request, $id);
    public function delete($id);
}

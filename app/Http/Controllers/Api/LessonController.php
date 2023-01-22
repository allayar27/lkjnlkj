<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LessonRequest;
use App\Models\Lesson;
use App\Services\Contracts\LessonContract;

class LessonController extends Controller
{

    public function index(Lesson $lesson, LessonContract $lessonContract)
    {
        $this->authorize('viewAny', $lesson);
        return $lessonContract->get();
    }

    public function show($id, Lesson $lesson, LessonContract $lessonContract)
    {
        $this->authorize('view', $lesson);
        return $lessonContract->show($id);
    }

    public function search($title, LessonContract $lessonContract)
    {
        return $lessonContract->search($title);
    }

    public function create(LessonRequest $request, Lesson $lesson, LessonContract $lessonContract)
    {
        $this->authorize('create', $lesson);
        return $lessonContract->create($request);
    }

    public function update(LessonRequest $request, $id, Lesson $lesson, LessonContract $lessonContract)
    {
        $this->authorize('edit', $lesson);
        return $lessonContract->update($request, $id);
    }

    public function destroy($id, Lesson $lesson, LessonContract $lessonContract)
    {
        $this->authorize('delete', $lesson);
        return $lessonContract->delete($id);

    }
}

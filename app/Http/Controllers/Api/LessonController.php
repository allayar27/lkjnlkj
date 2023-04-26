<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Lesson\LessonRequest;
use App\Http\Requests\Lesson\LessonUpdateRequest;
use App\Http\Resources\LessonResource;
use App\Models\Lesson;
use App\Services\LessonService;
use App\Traits\ApiResponser;

class LessonController extends Controller
{
    use ApiResponser;
    private $service;

    public function __construct(LessonService $service)
    {
        $this->service = $service;
    }

    public function index(Lesson $lesson)
    {
        $this->authorize('viewAny-lessons', $lesson);
        $collection = $lesson->orderBy('created_at', 'desc')->get();
        return LessonResource::collection($collection);
    }


    public function show(Lesson $lesson)
    {
        $this->authorize('view-lessons', $lesson);
        $byId = $lesson->findOrFail($lesson->id);
        return new LessonResource($byId);
    }


    public function search($title)
    {
        $result = $this->service->search($title);
        if (count($result) > 0) {
            return $this->success($result, 'found', 200);
        } else {
            return $this->error('No Data not found', 404);
        }
    }


    public function create(LessonRequest $request)
    {
        $validate = $request->validated();
        $create = $this->service->create($validate);
        if (!$create){
            return $this->error('creating process is failed!', 400);
        }
        return $this->success($create,'created successfully', 201);
    }

    public function update(Lesson $lesson, LessonUpdateRequest $request)
    {
        $validate = $request->validated();
        $update = $this->service->update($lesson->id, $validate);
        if(!$update){
            return $this->error('updating is failed', 400);
        }
        return $this->success($update, 'updated successfully', 200);
    }

    public function destroy(Lesson $lesson)
    {
        $this->authorize('delete', $lesson);

        $delete = $lesson->find($lesson->id)->delete();
        if (!$delete){
            return $this->error('failed!',400);
        }
        return $this->success($delete,'deleted successfully',200);
    }
}

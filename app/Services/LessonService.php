<?php

namespace App\Services;

use App\Http\Resources\LessonCollection;
use App\Http\Resources\LessonResource;
use App\Models\Lesson;
use App\Services\Contracts\LessonContract;
use App\Traits\ApiResponser;

class LessonService implements LessonContract
{
    use ApiResponser;

    public function get()
    {
        $lesson = Lesson::orderBy('created_at', 'DESC')->get();
        return new LessonCollection($lesson);
    }

    public function show($id)
    {
        $lesson = Lesson::findOrFail($id);
        return new LessonResource($lesson);
    }

    public function create($request)
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $image = $request->file('image')->getClientOriginalName();
        }
        $request->image->move(public_path('/images'), $image);
        $validated['image'] = $image;
        $create = Lesson::create($validated);
        if (!$create){
            return $this->error('creating process is failed!',400);
        }
        return $this->success($create,'created successfully',201);
    }

    public function search($title)
    {
        $result = Lesson::where('title', 'LIKE', '%'. $title .'%')->get();
        if(count($result)){
            return $this->success($result,'found',200);
        }
        else {
            return $this->error('No Data not found',404);
        }
    }

    public function update($request, $id)
    {
        $validated = $request->validated();
        if ($request->hasFile('image')){
            $image = $request->file('image')->getClientOriginalName();
            $validated['image'] = $image;
            $request->media->move(public_path('/images'), $image);
        }
        $update = Lesson::where('id', $id)->update($validated);
        if (!$update){
            return $this->error('updating process is failed!',400);
        }
        return $this->success($update,'updated successfully',200);
    }

    public function delete($id)
    {
       $lesson = Lesson::findOrFail($id)->delete();
        return $this->success($lesson,'lesson deleted successfully!',200);
    }
}

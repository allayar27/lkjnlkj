<?php

namespace App\Services;

use App\Models\Lesson;

final class LessonService
{

    /** @var Lesson */
    private $lesson;

    /** @var FileUploader */
    private $fileUploader;

    public function __construct(Lesson $lesson, FileUploader $fileUploader)
    {
        $this->lesson = $lesson;
        $this->fileUploader = $fileUploader;
    }


    public function create(array $request)
    {
        $filename = $request['image']->getClientOriginalName();
        $this->fileUploader->upload('/images', $filename);
        $request['image'] = $filename;
        return $this->lesson->create($request);
    }

    public function search($title)
    {
        return $this->lesson->where('title', 'LIKE', '%'. $title .'%')->get();
    }

    public function update($id, array $request)
    {
        if($request['image']){
            $this->fileUploader->deleteFile($this->lesson->image);
            $filename = $request['image']->getClientOriginalName();
            $this->fileUploader->upload('/images', $filename);
            $request['image'] = $filename;
        }
        return $this->lesson->where('id', $id)->update($request);
    }

}

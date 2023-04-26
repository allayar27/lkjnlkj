<?php

namespace App\Services;

use App\Models\Assignment;

final class AssignmentService
{
    /** @var Assignment */
    private $assignment;

    /** @var \App\Services\FileUploader */
    private $fileUploader;

    public function __construct(Assignment $assignment, \App\Services\FileUploader $fileUploader)
    {
        $this->assignment = $assignment;
        $this->fileUploader = $fileUploader;
    }

    public function search($title)
    {
        return $this->assignment
                    ->where('title', 'LIKE', '%'. $title .'%')
                    ->get();
    }

    public function create(array $request)
    {
        $fileName = $request['file']->getClientOriginalName();
        $this->fileUploader->upload('/assignment', $fileName);
        $request['file'] = $fileName;
        return $this->assignment->create($request);
    }

    public function update($id, array $request)
    {
        if ($request['file']){
            $this->fileUploader->deleteFile($this->assignment->file);

            $fileName = $request['file']->getClientOriginalName();
            $this->fileUploader->upload('/assignment', $fileName);
            $request['file'] = $fileName;
        }
        return $this->assignment->where('id', $id)->update($request);
        
    }

}

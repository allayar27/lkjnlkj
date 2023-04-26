<?php

namespace App\Services;

use App\Models\Response;

final class ResponseService
{
    /** @var Response */
    private $response;

    /** @var FileUploader */
    private $fileUploader;

    public function __construct(Response $response, FileUploader $fileUploader)
    {
        $this->response = $response;
        $this->fileUploader = $fileUploader;
    }


    public function create(array $request)
    {
        $filename = $request['file']->getClientOriginalName();
        $this->fileUploader->upload('/response', $filename);
        $request['file'] = $filename;
        return $this->response->save($request);
    }

    public function update(int $id, array $request)
    {
        if ($request['file']){
            $this->fileUploader->deleteFile($this->response->file);

            $fileName = $request['file']->getClientOriginalName();
            $this->fileUploader->upload('/response', $fileName);
            $request['file'] = $fileName;
        }
        return $this->response->where('id', $id)->update($request);
    }

}

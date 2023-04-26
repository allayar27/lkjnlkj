<?php

namespace App\Services;

use App\Models\Additional;

final class AdditionalService
{
    /** @var Additional */
    private $additional;

    /** @var FileUploader */
    private $fileUploader;

    public function __construct(Additional $additional, FileUploader $fileUploader)
    {
    }

    public function create(array $request)
    {
        $fileName = $request['media']->getClientOriginalName();
        $this->fileUploader->upload('/download', $fileName);
        $request['media'] = $fileName;
        return $this->additional->save($request);
    }

    public function update(int $id, array $request)
    {
        if ($request['media']) {
            $this->fileUploader->deleteFile($this->additional->media);

            $fileName = $request['media']->getClientOriginalName();
            $this->fileUploader->upload('/dewnload', $fileName);
            $request['media'] = $fileName;
        }
        return $this->additional->where('id', $id)->update($request);
    }

}

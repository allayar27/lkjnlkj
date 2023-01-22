<?php

namespace App\Services;

use App\Http\Resources\ResponseCollection;
use App\Http\Resources\ResponseResource;
use App\Models\Response;
use App\Services\Contracts\ResponseContract;
use App\Traits\ApiResponser;

class ResponseService implements ResponseContract
{
    use ApiResponser;

    public function get()
    {
       $response = Response::orderBy('created_at', 'DESC')->get();
       return new ResponseCollection($response);
    }

    public function getId($id)
    {
        $response = Response::findOrFail($id);
        return new ResponseResource($response);
    }

    public function create($request)
    {
        $validated = $request->validated();
        if($request->file('file')){
            $fileName = $request->file('file')->getClientOriginalName();
        }
        $request->file->move(public_path('/response'), $fileName);
        $validated['file'] = $fileName;
        $create = Response::create($validated);
        if (!$create){
            return $this->error('creating process is failed!',400);
        }
        return $this->success($create,'created successfully',201);
    }

    public function update($request, $id)
    {
        $validated = $request->validated();
        if ($request->has('file')){
            $fileName = $request->file('file')->getClientOriginalName();
        }
        $request->file->move(public_path('/response'), $fileName);

        $validated['file'] = $fileName;

        $update = Response::where('id', $id)->update($validated);
        if (!$update){
            return $this->error('updating process is failed!',400);
        }
        return $this->success($update,'updated successfully!',200);
    }

    public function delete($id)
    {
        $delete = Response::where('id', $id)->delete();
        if (!$delete){
            return $this->error('not deleted!',400);
        }
        return $this->success($delete,'deleted successfully',200);
    }
}

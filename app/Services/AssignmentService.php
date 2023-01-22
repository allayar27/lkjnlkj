<?php

namespace App\Services;

use App\Http\Requests\AssignmentRequest;
use App\Http\Resources\AssignmentCollection;
use App\Http\Resources\AssignmentResource;
use App\Models\Assignment;
use App\Services\Contracts\AssignmentContract;
use App\Traits\ApiResponser;

class AssignmentService implements AssignmentContract
{
    use ApiResponser;

    public function get()
    {
        $assignment = Assignment::orderBy('created_at', 'DESC')->get();
        return new AssignmentCollection($assignment);
    }

    public function show($id)
    {
        $assignment = Assignment::findOrFail($id);
        return new AssignmentResource($assignment);
    }

    public function search($title)
    {
        $result = Assignment::where('title', 'LIKE', '%'. $title .'%')->get();

        if(count($result)){
            return $this->success($result,'found',200);
        }
        else {
            return $this->error('No Data not found',404);
        }
    }

    public function create($request)
    {
        $validated = $request->validated();

        if ($request->has('file')){
            $file = $request->file('file')->getClientOriginalName();
        }
        $request->file->move(public_path('/assignment'), $file);
        $validated['file'] = $file;
        $create = Assignment::create($validated);
        if (!$create){
            return $this->error('creating process is failed!',400);
        }
        return $this->success($create,'created successfully',201);

    }

    public function update($request, $id)
    {
        $request = new AssignmentRequest();
        $validated = $request->validated();

        if ($request->has('file')){
            $file = $request->file('file')->getClientOriginalName();
            $validated['file'] = $file;
            $request->file->move(public_path('/assignment'), $file);
        }
        $update = Assignment::where('id', $id)->update($validated);

        if(!$update) {
            return $this->error('not updated!',400);
        }
        return $this->success($update, 'updated successfully', 200);
    }

    public function delete($id)
    {
        $delete = Assignment::findOrFail($id)->delete();
        return $this->success($delete,'Assignment deleted successfully!',200);
    }
}

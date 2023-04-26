<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Assignment\AssignmentRequest;
use App\Http\Requests\Assignment\AssignmentUpdateRequest;
use App\Http\Resources\AssignmentResource;
use App\Models\Assignment;
use App\Services\AssignmentService;
use App\Traits\ApiResponser;

class AssignmentController extends Controller
{
    use ApiResponser;

    /** @var AssignmentService */
    private $service;

    public function __construct(AssignmentService $service)
    {
        $this->service = $service;
    }

    public function index(Assignment $assignment)
    {
        $this->authorize('viewAny-assignments', $assignment);
        $collection = $assignment->orderBy('created_at', 'desc')->get();
        return AssignmentResource::collection($collection);
    }

    public function show(Assignment $assignment)
    {
        $this->authorize('view-assignments', $assignment);
        $assignment = $assignment->findOrFail($assignment->id);
        return new AssignmentResource($assignment);
    }

    public function search($title)
    {
        $result = $this->service->search($title);
        if(count($result) > 0){
            return $this->success($result,'found',200);
        }
        else {
            return $this->error('No Data not found',404);
        }
    }

    public function create(AssignmentRequest $request)
    {
        $validated = $request->validated();
        $create = $this->service->create($validated);
        if (!$create){
            return $this->error('creating process is failed!',400);
        }
        return $this->success($create,'created successfully',201);
    }

    public function update(Assignment $assignment, AssignmentUpdateRequest $request)
    {
        $validated = $request->validated();
        $update = $this->service->update($assignment->id, $validated);
        if(!$update) {
            return $this->error('not updated!',400);
        }
        return $this->success($update, 'updated successfully', 200);
    }

    public function destroy(Assignment $assignment)
    {
        $this->authorize('delete-assignments', $assignment);
        $delete = $assignment->findOrFail($assignment->id)->delete();
        return $this->success($delete, 'deleted successfully', 200);
    }
}

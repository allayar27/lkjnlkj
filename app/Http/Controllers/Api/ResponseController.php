<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Response\ResponseRequest;
use App\Http\Requests\Response\ResponseUpdateRequest;
use App\Http\Resources\ResponseResource;
use App\Models\Response;
use App\Services\ResponseService;
use App\Traits\ApiResponser;

class ResponseController extends Controller
{
    use ApiResponser;

    /** @var ResponseService */
    private $service;

    public function __construct(ResponseService $service)
    {
        $this->service = $service;
    }


    public function index(Response $response)
    {
        $this->authorize('viewAny-responses',$response);
        $collection = $response->orderBy('created_at', 'desc')->get();
        return ResponseResource::collection($collection);
    }


    public function show(Response $response)
    {
        $response = $response->findOrFail($response->id);
        $this->authorize('view', $response);
        return new ResponseResource($response);
    }


    public function store(ResponseRequest $request)
    {
        $valid = $request->validated();
        $create = $this->service->create($valid);
        if (!$create){
            return $this->error('creating process is failed!',400);
        }
        return $this->success($create,'created successfully',201);
    }


    public function update(Response $response, ResponseUpdateRequest $request)
    {
        $valid = $request->validated();
        $update = $this->service->update($response->id, $valid);
        if (!$update){
            return $this->error('updating process is failed!',400);
        }
        return $this->success($update,'updated successfully!',200);
    }


    public function destroy(Response $response)
    {
       $response = $response->findOrFail($response->id);
       $this->authorize('delete-responses', $response);
       $delete = $response->delete();
       return $this->success($delete, 'responses deleted', 200);
    }
}

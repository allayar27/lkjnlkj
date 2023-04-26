<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Additional\AdditionalRequest;
use App\Http\Requests\Additional\AdditionalUpdateRequest;
use App\Http\Resources\AdditionalResource;
use App\Models\Additional;
use App\Services\AdditionalService;
use App\Traits\ApiResponser;

class AdditionalController extends Controller
{
    use ApiResponser;

    /** @var AdditionalService */
    private $service;

    public function __construct(AdditionalService $service)
    {
        $this->service = $service;
    }

    public function index(Additional $additional)
    {
        $this->authorize('viewAny-additionals', $additional);
        $collection = $additional->orderBy('created_at','desc')->get();
        return AdditionalResource::collection($collection);
    }


    public function show(Additional $additional)
    {
        $this->authorize('view-additionals', $additional);
        $additional = $additional->findOrFail($additional->id);
        return new AdditionalResource($additional);
    }


    public function create(AdditionalRequest $request)
    {
        $validate = $request->validated();
        $create = $this->service->create($validate);
        if(!$create){
            return $this->error('error while creating!',400);
        }
        return $this->success($create,'created successfully',201);
    }


    public function update(Additional $additional, AdditionalUpdateRequest $request)
    {
        $validate = $request->validated();
        $update = $this->service->update($additional->id, $validate);
        if (!$update){
            return $this->error('update error!',200);
        }
        return $this->success($update,'updated successfully',200);
    }


    public function destroy(Additional $additional)
    {
        $this->authorize('delete-additionals', $additional);
        $delete = $additional->findOrFail($additional->id)->delete();
        return $this->success($delete, 'deleted successfully', 200);
    }

}

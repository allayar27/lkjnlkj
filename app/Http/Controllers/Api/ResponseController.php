<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResponseRequest;
use App\Models\Response;
use App\Services\Contracts\ResponseContract;

class ResponseController extends Controller
{
    public function index(Response $response, ResponseContract $responseContract)
    {
        $this->authorize('viewAny',$response);
        return $responseContract->get();
    }

    public function show($id, ResponseContract $responseContract)
    {
        $response = Response::findOrFail($id);
        $this->authorize('view', $response);
        return $responseContract->getId($id);
    }


    public function store(ResponseRequest $request, Response $response, ResponseContract $responseContract)
    {
        $this->authorize('create', $response);
        return $responseContract->create($request);
    }

    public function update(ResponseRequest $request, $id, ResponseContract $responseContract)
    {
        $response = Response::findOrFail($id);
        $this->authorize('update', $response);
        return $responseContract->update($request,$id);
    }

    public function destroy($id, ResponseContract $responseContract)
    {
       $response = Response::findOrFail($id);
       $this->authorize('delete', $response);
       return $responseContract->delete($id);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdditionalRequest;
use App\Http\Resources\AdditionalCollection;
use App\Http\Resources\AdditionalResource;
use App\Models\Additional;
use App\Services\Contracts\AdditionalContract;

class AdditionalController extends Controller
{
    public function index(Additional $additional)
    {
        $this->authorize('viewAny', $additional);
        return new AdditionalCollection(Additional::orderBy('created_at', 'DESC')->get());
    }

    public function show($id, Additional $additional)
    {
        $this->authorize('view', $additional);
        $add = Additional::findOrFail($id);
        return new AdditionalResource($add);
    }

    public function create(AdditionalRequest $request, Additional $additional, AdditionalContract $additionalContract)
    {
        $this->authorize('create', $additional);
        return $additionalContract->create($request);
    }

    public function update(AdditionalRequest $request, $id, Additional $additional, AdditionalContract $additionalContract)
    {
        $this->authorize('edit', $additional);
        return $additionalContract->update($request, $id);
    }

    public function destroy($id, Additional $additional, AdditionalContract $additionalContract)
    {
        $this->authorize('delete', $additional);
        return $additionalContract->delete($id);
    }
}

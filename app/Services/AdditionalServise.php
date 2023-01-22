<?php

namespace App\Services;

use App\Http\Requests\AdditionalRequest;
use App\Models\Additional;
use App\Services\Contracts\AdditionalContract;
use App\Traits\ApiResponser;

class AdditionalServise implements AdditionalContract
{
    use ApiResponser;

    public function create(AdditionalRequest $request)
    {
        $validated = $request->validated();
        if ($request->hasFile('media')) {
            $media = $request->file('media')->getClientOriginalName();
        }
        $request->media->move(public_path('/download'), $media);
        $validated['media'] = $media;

        $create = Additional::create($validated);
        if(!$create){
            return $this->error('error while creating!',400);
        }
        return $this->success($create,'created successfully',201);
    }

    public function update(AdditionalRequest $request, $id)
    {
        $validated = $request->validated();
        if ($request->hasFile('media')) {
            $media = $request->file('media')->getClientOriginalName();
        }
        $request->media->move(public_path('/download'), $media);
        $validated['media'] = $media;

        $update = Additional::where('id', $id)->update($validated);
        if (!$update){
            return $this->error('update error!',200);
        }
        return $this->success($update,'updated successfully',200);
    }

    public function delete($id)
    {
        $delete = Additional::findOrFail($id)->delete();
        return $this->success($delete,'deleted successfully',200);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Traits\ApiResponser;

class CategoryController extends Controller
{
    use ApiResponser;

    public function index(Category $category)
    {
        $this->authorize('viewAny-categories', $category);
        $category = $category->orderBy('created_at', 'DESC')->get();
        return CategoryResource::collection($category);
    }


    public function show(Category $category)
    {
        $this->authorize('view-categories', $category);
        $category = $category->query()->findOrFail($category->id);
        return new CategoryResource($category);
    }


    public function create(CategoryRequest $request, Category $category){
        $validated = $request->validated();
        $create = $category->create($validated);
        if (!$create){
            return $this->error('creating is failed!',400);
        }
        return $this->success($create,'created',201);
    }


    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $validated = $request->validated();
        $update = $category->where('id', $category->id)->update($validated);
        if (!$update) {
            return $this->error('updating is failed!', 400);
        }
        return $this->success($update,'updated',200);
    }


    public function destroy(Category $category)
    {
        $this->authorize('delete-categories', $category);

        $delete = $category->findOrFail($category->id)->delete();
        return $this->success($delete,'deleted',200);
    }
}

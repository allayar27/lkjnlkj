<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Traits\ApiResponser;

class CategoryController extends Controller
{
    use ApiResponser;

    public function index(Category $category)
    {
        $this->authorize('viewAny', $category);
        return new CategoryCollection(Category::orderBy('created_at', 'DESC')->get());
    }

    public function show($id, Category $category)
    {
        $this->authorize('view', $category);
        $category = Category::findOrFail($id);
        return new CategoryResource($category);
    }



    public function create(CategoryRequest $request, Category $category){
        $this->authorize('create', $category);
        $validated = $request->validated();
        $create = Category::create($validated);
        if (!$create){
            return $this->error('creating is failed!',400);
        }
        return $this->success($create,'created',201);
    }

    public function update(CategoryRequest $request, $id, Category $category)
    {
        $this->authorize('edit', $category);
        $validated = $request->validated();
        $update = Category::where('id', $id)->update($validated);
        if (!$update) {
            return $this->error('updating is failed!', 400);
        }
        return $this->success($update,'updated',200);
    }

    public function destroy($id, Category $category)
    {
        $this->authorize('delete', $category);
        $delete= Category::findOrFail($id)->delete();
        return $this->success($delete,'deleted',200);
    }
}

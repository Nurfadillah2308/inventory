<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CategoryController extends BaseController
{
    public function index()
    {
        $categories = Category::all();
        return $this->success($categories, 'Categories retrieved successfully.');
    }

    public function store(StoreCategoryRequest $request)
    {
        $category = Category::create($request->validated());
        return $this->success($category, 'Category created successfully.', 201);
    }

    public function show($id)
    {
        try {
            $category = Category::findOrFail($id);
            return $this->success($category, 'Category found successfully.');
        } catch (ModelNotFoundException $e) {
            return $this->error('Category not found.', 404);
        }
    }

    public function update(UpdateCategoryRequest $request, $id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->update($request->validated());
            return $this->success($category, 'Category updated successfully.');
        } catch (ModelNotFoundException $e) {
            return $this->error('Category not found.', 404);
        }
    }

    public function destroy($id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->delete();
            return $this->success(null, 'Category deleted successfully.');
        } catch (ModelNotFoundException $e) {
            return $this->error('Category not found.', 404);
        }
    }
}
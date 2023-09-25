<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\CategoryRequset;
use App\Http\Resources\CategoryResource;
use App\Http\Controllers\Api\Traits\ApiResponse;
use App\Http\Controllers\Api\Traits\ImageUploadTrait;

class CategoryController extends Controller
{
    use ApiResponse, ImageUploadTrait;
    public function index()
    {
        $categories = Category::all();
        return $this->successResponse(CategoryResource::collection($categories), "show all categories", 200);
    }

    public function store(CategoryRequset $request)
    {
        $image = $this->uploadImage($request, "image", "categories/");

        $category = Category::create([
            'name' => $request->name,
            'image' => $image
        ]);
        return $this->successResponse(new CategoryResource($category), "category created successfully", 201);
    }
    public function show(Category $category)
    {
        return $this->successResponse(new CategoryResource($category), " This is your category", 200);
    }
    public function update(CategoryRequset $request, Category $category)
    {
        $image = $this->uploadImage($request, "image", "categories/");
        $category->update([
            'name' => $request->name,
            'image' =>  $image ?? $category->image
        ]);
        return $this->successResponse(new CategoryResource($category), " category updated successfully", 200);
    }
    public function destroy(Category $category)
    {
        $image = $category->image;
        $this->deleteImage($image);
        $category->delete();
        return $this->successResponse(" category deleted successfully", 200);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CategoryResource;
use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where('is_active','1')->get();

        return apiResourceResponse(CategoryResource::collection($categories));
    }

    public function subCategories(Category $category)
    {
        $category->load('subcategories');

        return apiResourceResponse(CategoryResource::make($category));
    }
}

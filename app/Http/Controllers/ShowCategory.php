<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ShowCategory extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Category $category)
    {
        return Inertia::render('Category', [
            'category' => $category,
            'categories' => CategoryResource::collection(
                Category::all(),
            ),
            'products' => ProductResource::collection(
                $category
                    ->products()
                    ->paginate(25)
            ),
        ]);
    }
}

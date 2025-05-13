<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Inertia\Inertia;

class ShowProduct extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Product $product)
    {
        return Inertia::render('Product', [
            'product' => ProductResource::make($product),
            'categories' => CategoryResource::collection(
                Category::all(),
            ),
        ]);
    }
}

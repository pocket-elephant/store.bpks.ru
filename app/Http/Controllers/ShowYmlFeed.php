<?php

namespace App\Http\Controllers;


use App\Models\Product;

class ShowYmlFeed extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $products = Product::with('category')
            ->get();

        $categories = $products
            ->unique('category.id')
            ->pluck('category');

        return response()->view('feed', [
            'products' => $products,
            'categories' => $categories,
        ])->header('Content-Type', 'text/xml');
    }
}

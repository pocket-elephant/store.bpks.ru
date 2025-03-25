<?php

namespace App\Http\Controllers;

use App\Data\SearchData;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Inertia\Inertia;

class SearchController extends Controller
{

    public function search(SearchData $searchData): \Inertia\Response
    {
        $products = Product::search($searchData->query)
            ->paginate(100);

        Inertia::share('search.query', $searchData->query);

        return Inertia::render('Search', [
            'products' => $products->count()
                ? ProductResource::collection($products)
                : null,
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Inertia\Inertia;
use Inertia\Response;

class ShowHomepage extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(): Response
    {
        return Inertia::render('Home', [
            'categories' => CategoryResource::collection(
                Category::all()
            ),
        ]);
    }
}

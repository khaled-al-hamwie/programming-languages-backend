<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use HttpResponses;
    public function index(Request $request)
    {
        $category = $request->query('category');
        if (!is_null($category)) {
            return Category::where('title', 'regexp', "$category")->get();
        }
        return Category::all();
    }

    public function show(int $id)
    {
        $category = Category::find($id);
        if (is_null($category))
            return response()->json(['messsage' => "the id $id doesn't exist"], 404);

        return response()->json([
            'name' => $category->title,
            'experts' => $category->experts
        ]);
    }
}

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
            return $this->success(['category' => Category::where('title', 'regexp', "$category")->get()], 'ok');
        }
        return $this->success(['category' => Category::all()], 'ok');
    }

    public function show(int $id)
    {
        $category = Category::find($id);
        if (is_null($category))
            return $this->error(['errors' => "the id $id not found"], 'Not Found Error', 404);
        return $this->success(['category' => [
            'name' => $category->title,
            'experts' => $category->experts
        ]], 'ok');
    }
}

<?php

namespace App\Http\Controllers;

use App\category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = category::get();
        return view('admin/categories/category', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        $category = new category($request->all());
        $category->save();

        if (!$category->save()) {
            return response()->json([
                'saved' => false
            ]);
        }

        return response()->json([
            'saved' => true,
            'category' => $category
        ]);
    }

    public function update(Request $request,  category $category)
    {
        $category->update($request->all());
        return $category;
    }

    public function delete(category $category)
    {
        if ($category->delete()) {
            return response()->json([
                'status' => true
            ]);
        }
        return response()->json([
            'status' => false
        ]);
    }
}

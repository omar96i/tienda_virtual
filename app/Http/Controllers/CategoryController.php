<?php

namespace App\Http\Controllers;

use App\category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = category::get();
        return view('category', ['categories' => $categories]);
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $category = new category();
        $category->name = $request->name;
        $category->save();
        return response()->json([
			'saved' => true,
			'category' => $category
		]);
    }

    public function show(category $category)
    {
        //
    }

    public function edit(category $category)
    {
        //
    }

    public function update(Request $request,  $id)
    {
        $category = category::find($id);
		$category->name = $request->name;
		$category->save();
		return $category;
    }

    public function delete($id)
    {
        $category = category::find($id);
    	$category->delete();
    }
}

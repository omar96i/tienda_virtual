<?php

namespace App\Http\Controllers;

use App\product;
use App\category;

use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        $category = category::get();
        $products = product::select('products.*', 'categories.name as Cname')->join('categories', 'products.id_category', '=', 'categories.id')->get();
        return view('product', ['products' => $products, 'category' => $category]);
    }

    public function indexH(){
        $products = product::get();
        return view('home', ['products' => $products]);
    }

    public function indexT(Request $request)
    {
        $products = product::where('name', 'like', "$request->buscar%")->get();
        return response()->json([
            'products' => $products
        ]);
    }

    public function detalles($id)
    {
        $products = product::find($id);
        return view('detalleProducto', ['products' => $products]);
    }

    public function getProducts(){
        $products = product::select('products.*', 'categories.name as Cname')->join('categories', 'products.id_category', '=', 'categories.id')->get();
        return $products;
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $imageName = time().'.'.$request->url->extension();
        $request->url->move(public_path('images'), $imageName);
        $products = new product();
        $products->name = $request->name;
        $products->value = $request->value;
        $products->stock = $request->stock;
        $products->description = $request->description;
        $products->id_category = $request->id_category;
        $products->url = $imageName;
        $products->save();
        return response()->json([
			'saved' => true,
			'products' => $products
		]);
    }

    public function edit_product($id){
        $products = product::select('products.*', 'categories.name as Cname')->join('categories', 'products.id_category', '=', 'categories.id')->where('products.id', $id)->get();
        return $products;
    }


    public function show(product $product)
    {
        //
    }


    public function edit(product $product)
    {
        //
    }


    public function update(Request $request, product $product)
    {
        //
    }


    public function delete(product $product)
    {
        $product->delete();

        return response()->json([
			'deleted' => true
		]);
    }
}

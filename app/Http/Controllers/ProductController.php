<?php

namespace App\Http\Controllers;

use App\product;
use App\category;

use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index($tipo = false)
    {
        $category = category::with('product')->get();
        $products = product::with('categories')->get();
        if ($tipo == "admin") {
            return view('admin/products/product', ['products' => $products, 'category' => $category]);
        }
        else if(!$tipo)
        {
            return view('default/products/home', ['products' => $products, 'categories' => $category]);
        }
        else if($tipo=="categories")
        {
            return view('default/categories/productsOfCategories', ['categories' => $category]);
        }
        else if($tipo=="datos"){
            return $products;
        }
    }

    public function withCategories($id, $tipo = false)
    {
        $products = product::with('categories')->where('category_id', $id)->get();

        if ($tipo == "consulta") {
            return $products;
        }

        return view('default/categories/categoryItsProducts', ['products' => $products]);
    }


    public function store(Request $request)
    {
        $imageName = time() . '.' . $request->url->extension();
        $request->url->move(public_path('images'), $imageName);
        $products = new product($request->all());
        $products->url = $imageName;
        $products->save();
        return response()->json([
            'saved' => true,
            'products' => $products
        ]);
    }

    public function update(Request $request, product $product)
    {
        $imageName = time() . '.' . $request->url->extension();
        $request->url->move(public_path('images'), $imageName);
        $product->update($request->all());
        $product->url = $imageName;
        $product->save();
        return response()->json([
            'saved' => true,
            'products' => $product
        ]);
    }

    public function delete(product $product)
    {
        $product->delete();
        return response()->json([
            'deleted' => true
        ]);
    }

    public function edit($id)
    {
        $products = product::find($id);
        $category = category::get();
        return view('admin/products/editProduct', ['product' => $products, 'category' => $category]);
    }

    public function home()
    {
        $products = product::get();
        return view('default/products/home', ['products' => $products]);
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
        return view('default/products/detalleProducto', ['products' => $products]);
    }
}

<?php

namespace App\Http\Controllers;

use App\product;
use App\category;

use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index($tipo = false)
    {
        $category = category::get();
        $products = product::with('categories')->get();
        if ($tipo == "admin") {
            return view('admin/products/product', ['products' => $products, 'category' => $category]);
        }
        else if(!$tipo)
        {
            return view('home', ['products' => $products, 'categories' => $category]);
        }
        else if($tipo=="categories")
        {
            return view('productsOfCategories', ['categories' => $category]);
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

    public function getProducts()
    {
        $products = product::select('products.*', 'categories.name as Cname')->join('categories', 'products.id_category', '=', 'categories.id')->get();
        return $products;
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

    public function update(Request $request, $id)
    {
        $imageName = time() . '.' . $request->url->extension();
        $request->url->move(public_path('images'), $imageName);
        $products = product::find($id);
        $products->name = $request->name;
        $products->value = $request->value;
        $products->stock = $request->stock;
        $products->description = $request->description;
        $products->category_id = $request->category_id;
        $products->url = $imageName;
        $products->save();
        return response()->json([
            'saved' => true,
            'products' => $products
        ]);
    }

    public function edit_product($id)
    {
        $products = product::select('products.*', 'categories.name as Cname')->join('categories', 'products.id_category', '=', 'categories.id')->where('products.id', $id)->get();
        return $products;
    }


    public function deleteProduct($id)
    {
        $product = product::find($id);
        $product->delete();

        return response()->json([
            'deleted' => true
        ]);
    }

    public function updateIndex($id)
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

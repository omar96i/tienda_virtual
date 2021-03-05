<?php

namespace App\Http\Controllers;

use App\product;
use App\Factura;
use Illuminate\Http\Request;

class FacturaController extends Controller
{
    public function store(Request $request,product $product){
        $user_id = auth()->user()->id;
        if($product->stock > $request->cantidad){
            $factura = auth()->user()->facturas->where('estado', false)->first();
            if($factura){
                if(!$factura->factura_producto()->where('product_id', $product->id)->exists()){
                    $factura->factura_producto()->attach($product->id, ['cantidad' => $request->cantidad]);
                    return $this->update($factura, $product, $request->cantidad);
                }else{
                    $factura->factura_producto()->updateExistingPivot($product->id, array(
                        'cantidad' => $request->cantidad
                    ));
                    return $this->update($factura);
                }
            }else{
                $data['user_id'] = $user_id;
                $data['total'] = 0;
                $data['estado'] = false;
                $factura = new Factura($data);
                if($factura->save()){
                    $factura->factura_producto()->attach($product->id, ['cantidad' => $request->cantidad]);
                    return $this->update($factura);
                }
            }
        }
        return "ERROR#NO##STOCK";
    }

    public function update(Factura $factura){
        $aux = $factura->with('factura_producto')->find($factura->id);
        $total = 0;
        foreach($aux->factura_producto as $valor){
            $total = $total + ($valor->value * $valor->pivot->cantidad);
        }
        $factura->total = $total;
        $factura->save();
        return response()->json([
            'total' => $total,
            'status' => true
        ]);
    }

    public function index()
    {
        $factura = auth()->user()->facturas->where('estado', false)->first();

        if ($factura != null) {
            $aux = $factura->with('factura_producto')->where('estado', false)->where('user_id', $factura->user_id)->first();
            return response()->json([
                'status' => true,

                'factura' =>
                $aux,

                'user' =>
                auth()->user()->name,
            ], 200);
        } else {
            return response()->json([

                'status' => false,

                'factura' =>
                false,

                'user' =>
                auth()->user()->name,
            ], 200);
        }
    }

    public function updateCantidad(Factura $factura, Request $request)
    {

        if ($request->stock >= $request->pivot['cantidad']) {
            $factura->factura_producto()->updateExistingPivot($request->id, array(
                'cantidad' => $request->pivot['cantidad']
            ));
            return $this->update($factura);
        } else {
            return "Cantidad no disponible";
        }
    }

    public function deleteProducto(Factura $factura, Request $request)
    {
        $factura->factura_producto()->detach($request->id);

        return $this->update($factura);
    }

    public function finalizar(Factura $factura)
    {
        $factura->estado = true;
        $factura->save();

        $aux = $factura->with('factura_producto')->where('id', $factura->id)->get();
        foreach($aux[0]->factura_producto as $item){
            $producto = product::find($item->id);
            $producto->stock = $producto->stock - $item->pivot->cantidad;
            $producto->save();
        }
        return "OK##UPDATE";
    }
}

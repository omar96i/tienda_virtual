<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    protected $fillable = [
        'user_id', 'total', 'estado'
    ];

    public function factura_producto()
    {
        return $this->belongsToMany(product::class, 'factura_producto')->withPivot('factura_id', 'product_id', 'cantidad', 'created_at', 'updated_at');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}

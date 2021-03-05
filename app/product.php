<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\category;

class product extends Model
{
    protected $fillable = [
        'name','value','stock','description','image','category_id'
    ];

    public function categories()
    {
        return $this->belongsTo(category::class, 'category_id');
    }

    public function factura_producto()
    {
        return $this->belongsToMany(Factura::class, 'factura_producto')->withPivot('factura_id', 'product_id', 'cantidad', 'created_at', 'updated_at');
    }
}

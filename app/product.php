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
}

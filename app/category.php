<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class category extends Model
{
    protected $fillable = [
        'name'
    ];

    public function product(){
        return $this->hasMany(product::class, 'category_id');
    }
}

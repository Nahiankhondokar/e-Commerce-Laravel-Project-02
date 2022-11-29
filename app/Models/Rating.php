<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $guarded = [];


    // get user
    public function getUser () {
        return $this -> belongsTo(User::class, 'user_id');
    }

    // get product
    public function getProduct () {
        return $this -> belongsTo(Product::class, 'product_id');
    }

}

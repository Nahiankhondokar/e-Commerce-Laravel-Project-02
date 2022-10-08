<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    // get category relationship
    public function getCategory(){
        return $this -> belongsTo(Category::class, 'category_id');
    }

    // get section relationship
    public function getSection(){
        return $this -> belongsTo(CreateSection::class, 'section_id');
    }

    // get product attribute relationship
    public function getProductAttr(){
        return $this -> hasMany(ProductAttribute::class, 'product_id', 'id');
    }


        

}

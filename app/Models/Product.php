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

    
    // brand name find
    public function getBrand(){
        return $this -> belongsTo(ProductBrand::class, 'brand_id', 'id') -> select('id' ,'name');
    }

    // get product attribute relationship
    public function getProductAttr(){
        return $this -> hasMany(ProductAttribute::class, 'product_id', 'id');
    }


    // get product gallery relationship
    public function getProductGallery(){
        return $this -> hasMany(ProductGallery::class, 'product_id', 'id');
    }


    // all filter static filter items
    public static function getAllFilters(){
        $allData['fabricArr']   = ['Cotton', 'Colyster', 'Wool'];
        $allData['sleeveArr']   = ['Full Sleeve', 'Half Sleeve', 'Short Sleeve'];
        $allData['patternArr']  = ['Cehcked', 'Plain', 'Solid', 'Printed'];
        $allData['fitArr']      = ['Regular', 'Slim'];
        $allData['ocassionArr'] = ['Casual', 'Formal'];

        return $allData;
    }

        

}

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
        return $this -> hasMany(ProductAttribute::class, 'product_id', 'id') -> where('status', 1);
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


    // get product discount price
    public static function getDiscountPrice($product_id){

        $discountPro = Product::select('id', 'product_price', 'product_discount', 'product_weight', 'category_id') -> where('id', $product_id) -> first();
        $discountCat = Category::select('id', 'category_discount') -> where('id', $discountPro -> category_id) -> first();

        

        if($discountPro -> product_discount > 0){
            // return $discountPro -> product_discount . 'pro';
            $discountPrice = $discountPro -> product_price - ($discountPro -> product_price * $discountPro -> product_discount / 100);

        }else if($discountCat -> category_discount > 0){
            // return $discountCat -> category_discount . 'cat';
            $discountPrice = $discountPro -> product_price - ($discountPro -> product_price * $discountCat -> category_discount / 100);
        }else {
            $discountPrice = 0;
        }

        return round($discountPrice);
    }
        


    // get attribute product discount price
    public static function getAttrDiscountPrice($product_id, $size){

        $attrPrice = ProductAttribute::select('price') -> where(['product_id' => $product_id, 'size' => $size]) -> first();

        $discountPro = Product::select('product_price', 'product_discount', 'category_id') -> where('id', $product_id) -> first();

        $discountCat = Category::select('id', 'category_discount') -> where('id', $discountPro -> category_id) -> first();

        

        if($discountPro -> product_discount > 0){
            // return $discountPro -> product_discount . 'pro';
            $discountPrice = $attrPrice -> price - ($attrPrice -> price * $discountPro -> product_discount / 100);

            $discountAmount = $attrPrice -> price - $discountPrice;

        }else if($discountCat -> category_discount > 0){
            // return $discountCat -> category_discount . 'cat';
            $discountPrice = $attrPrice -> price - ($attrPrice -> price * $discountCat -> category_discount / 100);

            $discountAmount = $attrPrice -> price - $discountPrice;
        }else {
            $discountPrice = $attrPrice -> price;
            $discountAmount = 0;
        }

        return [
            'attrDiscountPrice'     => $discountPrice, // this price is after discount
            'attrPrice'             => $attrPrice, // only product price
            'discountAmount'        => $discountAmount // discount amount
        ];
    }



    // get product main image
    public static function getProductImage($product_id){

        $mainImage = Product::select('main_image') -> where('id', $product_id) -> first() -> toArray();
       
        return $mainImage;
    }

    // get product status
    public static function getProductStatus($product_id){

        $getProdudctStatus = Product::select('status') -> where('id', $product_id) -> first() -> toArray();
       
        return $getProdudctStatus['status'];
    }


    // get product status
    public static function getCategoryStatus($category_id){
        $getCategoryStatus = Category::select('status') -> where('id', $category_id) -> first() -> toArray();
        return $getCategoryStatus['status'];
    }


    // cart product stock check
    public static function getProductStockCheck($product_id, $size){
        $getProductStock = ProductAttribute::select('stock') -> where(['product_id' => $product_id, 'size' => $size]) -> first() -> toArray();

        return $getProductStock['stock'];
    }


    // product attribute status check
    public static function getAttributeCount($product_id, $size){
        $getAttributeCount = ProductAttribute::where(['product_id' => $product_id, 'size' => $size, 'status' => 1]) -> count();

        return $getAttributeCount;
    }
    


    // cart product delete
    public static function deleteCartProduct($product_id){
        Cart::where('product_id', $product_id) -> delete();
    }

    

          
           

}

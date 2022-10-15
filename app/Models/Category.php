<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];


    // sub-category find
    public function subcategories(){
        return $this -> hasMany(Category::class, 'parent_id', 'id') -> where('status', 1);
    }

    // section name find
    public function section(){
        return $this -> belongsTo(CreateSection::class, 'section_id', 'id') -> select('id' ,'name');
    }

    // section name find
    public function parentCategory(){
        return $this -> belongsTo(Category::class, 'parent_id', 'id') -> select('id', 'category_name');
    }

    // get all filter product category
    public static function catDetails($url) {
        $catDetails = Category::select('id', 'category_name', 'url', 'description', 'parent_id') -> with('subcategories', function($query){
            $query -> select('id', 'parent_id', 'description', 'category_name', 'parent_id') -> where('status', 1);
        }) -> where(['url' => $url]) -> first() -> toArray();

        // cat or subcat all Ids array
        // $catDetails['catIds'] = [$catDetails['allCats']['id']];
        $catIds = array();
        $catIds[] = $catDetails['id'];
        foreach($catDetails['subcategories'] as $key => $item){
            // $catIds = $item['id'];
            // array_push($catDetails['catIds'], $item['id']);
            $catIds[] = $item['id'];
        }

        return [
            'catIds'        => $catIds,
            'catDetails'    => $catDetails
        ];
    }




}

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

}

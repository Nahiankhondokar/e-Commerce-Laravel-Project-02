<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreateSection extends Model
{
    use HasFactory;

    protected $guarded = [];

    // category realtionship
    public function getCategory(){
        return $this -> hasMany(Category::class, 'section_id') -> where('parent_id', 0) -> where('status', 1) -> with('subcategories');
    }


}

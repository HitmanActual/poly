<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subcategory extends Model
{
    //
    use SoftDeletes;

    protected $table = 'subcategories';
    protected $fillable = [
        'thumbnail_path',
        'subcategory_title',
        'description',
        'category_id'
    ];

    public function getThumbnailPathAttribute($val)
    {
        return ($val !== null) ? asset('images/subcategory/' . $val) : "";
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }


}

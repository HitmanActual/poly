<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    //
    use SoftDeletes;

    protected $table = 'categories';
    protected $fillable = [
        'thumbnail_path',
        'category_title',
        'description',
    ];

    public function getThumbnailPathAttribute($val)
    {
        return ($val !== null) ? asset('images/category/' . $val) : "";
    }




}

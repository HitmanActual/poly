<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model
{
    use SoftDeletes;
    //
    protected $table = 'activities';
    protected $fillable = [
        'user_id',
        'translation_id',

    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function translation(){
        return $this->belongsTo(Translation::class);
    }


}

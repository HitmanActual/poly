<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    //
    use SoftDeletes;
    protected $table = 'subjects';
    protected $fillable = [
        'subject_title',
        'description',
    ];

    public function translation(){
        return $this->hasMany(Translation::class);
    }

    public function modes(){
        return $this->belongsToMany(Mode::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Translation extends Model
{
    //
    use SoftDeletes;
    protected $table = 'translations';
    protected $fillable = [
        'subject_id',
        'language_id',
        'translated_text',
        'description',
        'status',
    ];

    public function subjects(){
        return $this->belongsTo(Subject::class);
    }

    public function languages(){
        return $this->belongsTo(Language::class);
    }

//    protected $casts = [
//        'translations' => 'array'
//    ];

//    public function setLanguageIdAttribute($lang){
//        $this->attributes['language_id'] = json_encode($lang);
//    }


}

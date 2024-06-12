<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    //
    public function translation(){
        return $this->hasMany(Translation::class);
    }

    public function users(){
        return
            $this->hasMany(User::class);
    }
}

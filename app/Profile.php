<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model {

    protected $table = 'profiles';

    protected $fillable=['telephone','nickname','avatar','address'];

    public function user(){
        return $this->belongsTo('App\User');
    }

}

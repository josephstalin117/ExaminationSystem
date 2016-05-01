<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Single extends Model
{
    //
    protected $table = 'singles';

    protected $fillable=['user_id','title','score','a','b','c','d','answer','remark'];

    public function questions(){
        return $this->hasMany('App\Question','question_id');
    }
}

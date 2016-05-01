<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';

    protected $fillable=['paper_id','user_id','question_id','type'];

    public function paper(){
        return $this->hasOne('App\Paper');
    }

    public function single(){
        return $this->hasOne('App\Single','id','question_id');
    }
}

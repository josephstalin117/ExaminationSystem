<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paper extends Model {
    protected $table = 'papers';
    protected $fillable = ['name', 'user_id', 'score', 'remark'];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function questions() {
        return $this->hasMany('App\Question');
    }

    public function scores() {
        return $this->hasMany('App\Score');
    }

    public function room() {
        return $this->hasOne('App\Room');
    }
}

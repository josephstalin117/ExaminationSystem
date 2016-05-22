<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Score extends Model {
    //
    protected $table = 'scores';

    protected $fillable = ['user_id', 'paper_id', 'score', 'room_id'];

    public function paper() {
        return $this->belongsTo('App\Paper');
    }


    public function room() {
        return $this->belongsTo('App\Room');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}

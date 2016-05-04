<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Score extends Model {
    //
    protected $table = 'scores';

    protected $fillable = ['user_id', 'paper_id', 'score'];

    public function papers() {
        return $this->belongsTo('App\Paper', 'paper_id');
    }

    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }
}

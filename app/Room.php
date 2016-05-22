<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model {

    //连接表
    protected $table = 'rooms';

    protected $fillable = ['paper_id', 'name', 'remark'];

    public function room_user() {
        return $this->belongsTo('App\Room_user');
    }

    public function scores() {
        return $this->hasMany('App\Score');
    }

    public function paper() {
        return $this->belongsTo('App\Paper');
    }

}

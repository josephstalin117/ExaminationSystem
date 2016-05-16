<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model {

    //连接表
    protected $table = 'rooms';

    protected $fillable = ['paper_id', 'name', 'remark'];

    public function room_users() {
        return $this->hasMany('App\Room_user');
    }

    public function paper(){
        return $this->hasOne('App\Paper');
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room_user extends Model
{
    //
    protected $table = 'room_users';

    protected $fillable = ['user_id', 'room_id'];

    public function user() {
        return $this->hasOne('App\user');
    }

    public function room() {
        return $this->hasOne('App\room');
    }


}

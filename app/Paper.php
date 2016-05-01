<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paper extends Model {
    protected $table = 'papers';
    protected $fillable = ['name', 'user_id', 'score', 'remark'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow_request extends Model
{
    protected $guarded = ['id'];
    protected $fillable = ['user_id', 'follow_id', 'request_permission'];

    public function profile() {
        return $this->belongsTo('App\Profile');
    }
}

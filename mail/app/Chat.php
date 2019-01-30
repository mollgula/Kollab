<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $guarded = ['id'];
    protected $fillable = ['user1_id', 'user2_id'];
}

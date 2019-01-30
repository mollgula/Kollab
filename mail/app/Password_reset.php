<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Password_reset extends Model
{
    protected $guarded = ['id'];
    protected $fillable = ['mail', 'token'];

    public function scopeToken($query, $str)
    {
        return $query->where('token', $str);
    }
}

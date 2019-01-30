<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
    protected $guarded = ['id'];
    protected $fillable = ['mail', 'password', 'confirm_password', 'token'];

    public function scopeToken($query, $str)
    {
        return $query->where('token', $str);
    }
}
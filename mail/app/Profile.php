<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = ['id'];
    protected $fillable = ['user_id', 'name', 'department', 'course', 'schoolYear', 'age', 'icon', 'text'];

    /*
    public function departments()
    {
        return $this->hasMany('App\Department');
    }

    public function courses()
    {
        return $this->hasMany('App\Course');
    }
    */
}

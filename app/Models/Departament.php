<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departament extends Model
{
    protected $touches = ['users'];

    // Пользователи входящие в отдел
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Panitia extends Model
{
    protected $table = 'panitia';
    protected $primaryKey = 'id';
    public function user()
    {
        return $this->belongsTo('App\User', 'id_user', 'id');
    }
    public function acara()
    {
        return $this->hasMany('App\Acara', 'id', 'id_acara');
    }
}

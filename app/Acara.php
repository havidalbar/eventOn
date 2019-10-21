<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Acara extends Model
{
    protected $table = 'acara';
    protected $primaryKey = 'id';
    public function panitia()
    {
        return $this->belongsTo('App\Panitia', 'id_acara', 'id');
    }
    public function komentar()
    {
        return $this->hasMany('App\Komentar', 'id', 'id_acara');
    }
}

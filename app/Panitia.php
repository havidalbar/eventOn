<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Panitia extends Model
{
    protected $table = 'panitia';
    protected $primaryKey = 'id';
    public function member()
    {
        return $this->belongsTo('App\Member', 'id_member', 'id');
    }
    public function acara()
    {
        return $this->hasMany('App\Acara', 'id', 'id_acara');
    }
}

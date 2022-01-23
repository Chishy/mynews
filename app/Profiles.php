<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Profiles extends Model
{
protected $guarded = array('id');

    public static $rules = array(
        'simei' => 'required',
        'seibetsu' => 'required',
        'syumi' => 'required',
        'syoukai' => 'required',
    );
//Profiles Modelに関連付を行う
    public function profilehistories()
    {
        return $this->hasMany('App\Profilehistory');
    }    
}

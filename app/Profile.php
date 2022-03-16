<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
protected $guarded = array('id');

    public static $rules = array(
        'simei' => 'required',
        'seibetsu' => 'required',
        'syumi' => 'required',
        'syoukai' => 'required',
    );
    
    public function histories()
    {
        return $this->hasMany('App\Profilehistory');
    }
}

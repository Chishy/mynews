<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $guarded = array('id');

    public static $rules = array(
        'title' => 'required|max:20',
        'body' => 'required',
    );
    
//News Modelに関連付を行う
    public function histories()
    {
        return $this->hasMany('App\History');
    }
}

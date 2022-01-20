<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Profiles;
class ProfileController extends Controller
{
    //Laravel08ControllerとRoutingの関係について理解しよう課題4,5
    public function add()
    {
        return view('admin.profile.create');
    }
    
    public function create(Request $request)
    {
      // Varidationを行う
      $this->validate($request, Profiles::$rules);
      
      $profiles = new Profiles;
      $form = $request->all();
      if (isset($form['image'])) {
        $path = $request->file('image')->store('public/image');
        $profiles->image_path = basename($path);
      } else {
          $profiles->image_path = null;
      }
      
      // フォームから送信されてきた_tokenを削除する
      unset($form['_token']);
      // フォームから送信されてきたimageを削除する
      unset($form['image']);
      
      // データベースに保存する
      $profiles->fill($form);
      $profiles->save();
      
      return redirect('admin/profile/create');
  }

    
    public function edit()
    {
        return view('admin.profile.edit');
    }
    
    public function update()
    {
        return redirect('admin/profile/edit');
    }
}

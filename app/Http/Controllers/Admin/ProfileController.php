<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Profiles;
use App\Profilehistory;
use Carbon\Carbon;
class ProfileController extends Controller
{
  
    public function index(Request $request)
  {
      $cond_name = $request->cond_name;
      if ($cond_name != '') {
          // 検索されたら検索結果を取得する
          $posts = Profiles::where('simei', $cond_name)->get();
      } else {
          // それ以外はすべてのニュースを取得する
          $posts = Profiles::all();
      }
      return view('admin.profile.index', ['posts' => $posts, 'cond_name' => $cond_name]);
  }
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

    
    public function edit(Request $request)
    {
      //Profiles Modelからデータを取得
    $profiles = Profiles::find($request->id);
    if (empty($profiles)){
      return view('admin.profile.index');
    }
        return view('admin.profile.edit',['profiles_form'=>$profiles]);
    }
    
    public function update(Request $request)
    {
      //validationをかける
    $this->validate($request,Profiles::$rules);
    //Profiles Modelからデータを取得
    $profiles = Profiles::find($request->id);
    //送信されてきたフォームデータを格納する
    $profiles_form = $request->all();
      if ($request->remove == 'true'){
          $profiles_form['image_path'] = null;
      }elseif($request->file('image')){
          $path = $request->file('image')->store('public/image');
          $profiles_form['image_path'] = basename($path);
      }else{
          $profiles_form['image_path'] = $profiles->image_path;
      }
      unset($profiles_form['image']);
      unset($profiles_form['remove']);
      unset($profiles_form['_token']);
    //該当するデータを上書きして保存する
    $profiles->fill($profiles_form)->save();
    //ProfilehistoryModelにも編集履歴を保存する
    $profilehistories = new Profilehistory();
    $profilehistories->profiles_id = $profiles->id;
    $profilehistories->edited_at = Carbon::now();
    $profilehistories->save();
        return redirect('admin/profile/edit');
    }
    
    public function delete(Request $request)
  {
    //該当するNews Modelを取得
    $profiles = Profiles::find($request->id);
    //削除する
    $profiles->delete();
    return redirect('admin/profile');
  }
}

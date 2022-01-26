<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\HTML;
use App\Profiles;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $posts = Profiles::all()->sortByDesc('update_at');
        //更新日順に新しい方から並べる
        if (count($posts) > 0){
            $headline = $posts->shift();
        } else {
            $headline = null;
        }
        //最初のデータを削除して，ズラす
    //profile/index.blade.phpにファイルを渡す
    return view('profile.index',['headline' => $headline, 'posts' => $posts]);
    //viewテンプレートにheadline,postsという変数を渡している
    }
}

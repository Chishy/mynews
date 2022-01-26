<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\HTML;
use App\News;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $posts = News::all()->sortByDesc('update_at');
        //投稿日順に新しい方から並べる
        if (count($posts) > 0){
            $headline = $posts->shift();
        } else {
            $headline = null;
        }
        //最初のデータを削除して，ズラす
    //news/index.blade.phpにファイルを渡す
    return view('news.index',['headline' => $headline, 'posts' => $posts]);
    //viewテンプレートにheadline,postsという変数を渡している
    }
}

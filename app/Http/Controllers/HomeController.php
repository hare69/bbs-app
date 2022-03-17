<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function create(Request $request)
    {

        //    // フォームで入力されたユーザー名をセッションに登録
        //    session(['user_name' => $request->user_name]);

        //    // フォームに入力されたスレッド情報をデータベースへ登録
        //    $threads = new Thread;
        //    $form = $request->all();
        // //    $threads->fill($form)->save();
   
        //    // 掲示板ページへリダイレクト
        //    return redirect('/');
        return view('BBS.create');
    }
}

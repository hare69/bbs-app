
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ env('app_name') }}</title>
    
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}"></script>

    <style>
        .link-hover:hover {opacity: 70%;}   /* リンクをホバーした時に少し薄く表示 */
    </style>
</head>
<body class="bg-blue-100">
       
<div class="row flex">
        <a href="{{ url('/thread') }}"><img src="{{ asset('image/グループ 72.png') }}" alt="" class="logo"></a>

        <div class="text-center">
                            
            <div class="flex">
                        {{-- 最新ボタン --}}
                    <div class="justify-end mt-2">
                        <a href="{{ url('/thread') }}"><input class="my-2 px-2 py-1 rounded bg-blue-300 text-blue-900 font-bold link-hover cursor-pointer border" type="submit" value="最新"></a>
                    </div>
                
            
                {{-- スレ作成 --}}
                    <div class="justify-end mt-2">
                        <a href="{{ url('/create') }}"><input class="my-2 px-2 py-1 rounded bg-blue-300 text-blue-900 font-bold link-hover cursor-pointer border" type="submit" value="スレ作成"></a>
                    </div>
                    
            </div>

                <div class="w-4/12 max-w-screen-md m-auto">
            

                    {{-- 検索フォーム --}}
                        <div class="rounded-md mt-3 p-3">
                                <form action="{{route('thread.search')}}" method="post">
                                    @csrf
                                    <div class="mx-1 flex">
                                        <input class="border rounded px-2 flex-auto" type="text" name="search_message" required placeholder="タイトル検索">
                                        <input class="ml-2 px-2 py-1 rounded bg-blue-300 font-bold link-hover cursor-pointer" type="submit" value="検索">
                                    </div>
                                </form>
                        </div>
                </div>
        </div>
        

        
                
      
                    <ul class="navbar-nav me-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('ログイン') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('会員登録') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}さん
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('ログアウト') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
    </div>
    <div class="w-11/12 max-w-screen-md m-auto">

        {{-- タイトル --}}
        <h1 class="text-xl font-bold mt-5">{{ env('app_name') }}</h1>

        {{-- 入力フォーム --}}
        <div class="bg-white rounded-md mt-5 p-3">
            <form action="{{route('thread.store')}}" method="POST">
                @csrf
                {{-- ユーザー識別子の隠し要素 --}}
                <input type="hidden" name="user_identifier" value="{{session('user_identifier')}}">
                <div class="flex">
                    <p class="font-bold">名前:{{ Auth::user()->name }}<p>
                    <input class="border rounded px-2 ml-2" type="hidden" name="user_name" value="{{ Auth::user()->name }}">
                </div>
                <div class="flex mt-2">
                    <p class="font-bold">件名</p>
                    <input class="border rounded px-2 ml-2 flex-auto" type="text" name="message_title" required autofocus>
                </div>
                <div class="flex flex-col mt-2">
                    <p class="font-bold">本文</p>
                    <textarea class="border rounded px-2" name="message" required></textarea>
                </div>
                <div class="flex justify-end mt-2">
                    <input class="my-2 px-2 py-1 rounded bg-blue-300 text-blue-900 font-bold link-hover cursor-pointer" type="submit" value="投稿">
                </div>
            </form>
        </div>
        </div>
     
     
   
   
</body>
</html>

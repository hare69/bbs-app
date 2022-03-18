
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
<body class="bg-ye-100">
           
    <div class="row flex">
            <img src="{{ asset('image/グループ 72.png') }}" alt="" class="logo">

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
        

        
                

                    <ul class="navbar-nav ms-auto">
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
           
     
        {{-- ページネーション --}}
        <p class="mt-5">{{ $threads->links() }}</p>

        {{-- 投稿 --}}
        @foreach ($threads as $thread)
            <div class="bg-white rounded-md mt-1 mb-5 p-3 border">
                {{-- スレッド --}}
                <div>
                    <p class="mb-2 text-xs">{{$thread->created_at}} ＠{{$thread->user_name}}</p>
                    <p class="mb-2 text-xl font-bold under">{{$thread->message_title}}</p>
                    <p class="mb-2">{{$thread->message}}</p>
                </div>
                {{-- ボタン --}}
                <div class="flex mt-5">
                    {{-- 返信 --}}
                    <form class="flex flex-auto" action="{{route('reply.store')}}" method="POST">
                        @csrf
                        <input type="hidden" name="thread_id" value={{$thread->id}}>
                        <input class="border rounded px-2 w-2/5 md:w-4/12 text-sm md:text-base" type="hidden" name="user_name" placeholder="UserName" value="{{ Auth::user()->name }}" required>
                        <input class="border rounded px-2 ml-2 w-3/5 md:w-10/12 text-sm md:text-base" type="text" name="message" placeholder="コメント" required>
                        <input class="px-2 py-1 ml-2 rounded bg-green-600 text-white font-bold link-hover cursor-pointer" type="submit" value="返信">
                    </form>
                    {{-- 削除 --}}
                    @if ($thread->user_identifier == session('user_identifier'))
                        <form action="{{route('thread.destroy', ['thread'=>$thread->id])}}" method="post">
                            @csrf
                            @method('DELETE')
                            <input class="px-2 py-1 ml-2 rounded bg-red-500 text-white font-bold link-hover cursor-pointer" type="submit" value="削除" onclick="return Check()">
                        </form>
                    @endif
                </div>
                {{-- リプライ --}}
                <hr class="mt-2 m-auto">
                <div class="flex justify-end rpy">
                    <div class="w-11/12">
                        @foreach ($thread->replies as $reply)
                            <div>
                                <p class="mt-2 text-xs">{{$reply->created_at}} ＠{{$reply->user_name}}</p>
                                <p class="my-2 text-sm">{{$reply->message}}</p>
                            </div>
                    
                            
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach

        {{-- ページネーション --}}
        <p class="my-5">{{ $threads->links() }}</p>
    </div>
    </div>

    </div>
    {{-- スレッド削除の確認 --}}
    <script type="text/javascript">
        function Check(){
            var checked = confirm("本当に削除しますか？");
            if (checked == true) { return true; } else { return false; }
        }

        
    </script>
   
</body>
</html>

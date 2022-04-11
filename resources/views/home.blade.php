@extends('layouts.app')

@section('content')
<div class="container bg-ye-100 text-center">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('ログインできました') }}
                    <a href="{{ url('/thread') }}" class="my-2 px-2 py-1 rounded bg-blue-300 text-blue-900 font-bold link-hover cursor-pointer border">トップページ</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

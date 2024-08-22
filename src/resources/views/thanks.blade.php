@extends('layouts.app')

@section('css')
@endsection

@section('content')
<div class="thanks_content">
    <div class="thanks_content-inner">
        <h2 class="thanks_content-text">
            会員登録ありがとうございます。
        </h2>
    </div>
    <form action="/" method="get">
        @csrf
        <div class="thanks_button">
            <button class="thanks_button-submit">ログインする</button>
        </div>
    </form>
</div>
@endsection
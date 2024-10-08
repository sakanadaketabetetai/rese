@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/done.css') }}">
@endsection

@section('content')
<div class="done_content">
    <div class="done_content-inner">
        <h2 class="done_content-text">ご予約ありがとうございます</h2>
    </div>
    <form action="/back" method="get">
        @csrf
        <div class="done_button">
            <button class="done_button-submit">戻る</button>
        </div>
    </form>
</div>
@endsection
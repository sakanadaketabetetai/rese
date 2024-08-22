@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="login_content">
    <div class="login_inner">
        <div class="login_inner-title">
            <p class="login_inner-text">login</p>
        </div>
        <div class="login_form">
            <form action="/login" method="post">
                @csrf
                <div class="login_input-content">
                    <img src="/storage/images/icon_112180_16.png" alt="">
                    <input type="email" name="email" class="login_input-item" value="{{ old('email') }}" placeholder="Email">
                </div>
                <div class="login_input-content">
                    <img src="/storage/images/icon_158130_16.png" alt="">
                    <input type="password" name="password" class="login_input-item" placeholder="Password">
                </div>
                <div class="login_button">
                    <button class="login_button-submit">ログイン</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
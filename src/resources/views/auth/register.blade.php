@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="asset('css/register.css')">
@endsection

@section('content')
<div class="register_content">
    <div class="register_title">
        <h2 class="register_title-text">Registration</h2>
    </div>
    <div class="register_form">
        <form action="/register" method="post">
            @csrf
            <div class="register_form-input">
                <img src="/storage/images/" alt="">
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Username">
            </div>
            <div class="register_form-input">
                <img src="/storage/images/" alt="">
                <input type="email" name="email" value="{{ old('email') }}" placeholder="Email">
            </div>
            <div class="register_form-input">
                <img src="/storage/images/" alt="">
                <input type="password" name="password" placeholder="Password">
            </div>
            <div class="register_button">
                <button class="register_button-submit">登録</button>
            </div>
        </form>
    </div>
</div>
@endsection
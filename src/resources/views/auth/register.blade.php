@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="register_content">
    <div class="register_inner">
        <div class="register_inner-title">
            <h2 class="register_inner-text">Registration</h2>
        </div>
        <div class="register_form">
            <form action="/register" method="post">
                @csrf
                <div class="register_input-content">
                    <img src="/storage/images/icon_112180_16.png" alt="">
                    <input type="text" name="name" class="register_input-item"value="{{ old('name') }}" placeholder="Username">
                </div>
                <div class="register_input-content">
                    <img src="/storage/images/icon_158130_16.png" alt="">
                    <input type="email" name="email" class="register_input-item"value="{{ old('email') }}" placeholder="Email">
                </div>
                <div class="register_input-content">
                    <img src="/storage/images/" alt="">
                    <input type="password" name="password" class="register_input-item"placeholder="Password">
                </div>
                <div class="register_button">
                    <button class="register_button-submit">登録</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
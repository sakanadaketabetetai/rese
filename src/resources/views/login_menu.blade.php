@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login_menu.css') }}">
@endsection

@section('content')
    <div class="login_menu-content">
        <div class="login_menu-back">
            <a href="/login" class="login_menu-back-link">×</a>
        </div>
        <div class="login_menu-inner">
            <div class="login_menu-link">
                <a href="/" class="login_menu-text">Home</a>
            </div>
            <div class="login_menu-link">
                <a href="/register" class="login_menu-text">Registration</a>
            </div>
            <div class="login_menu-link">
                <a href="/login" class="login_menu-text">Login</a>
            </div>
        </div>
    </div>
@endsection
@extends('layouts.app')

@section('css')

@endsection

@section('content')
    <div class="register_menu-content">
        <div class="register_menu-back">
            <a href="/register" class="register_menu-back-link">×</a>
        </div>
        <div class="register_menu-inner">    
            <div class="register_menu-link">
                <a href="/" class="register_menu-text">Home</a>
            </div>
            <div class="register_menu-link">
                <a href="/register" class="register_menu-text">Registration</a>
            </div>
            <div class="register_menu-link">
                <a href="/login" class="register_menu-text">Login</a>
            </div>
        </div>
    </div>
@endsection
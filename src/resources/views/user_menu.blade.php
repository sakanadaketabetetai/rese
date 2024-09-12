@extends('layouts.menu')

@section('css')
<link rel="stylesheet" href="{{ asset('css/user_menu.css') }}">
@endsection

@section('content')
    <div class="user_menu-content">
        <div class="user_menu-back">
            <a href="/" class="user_menu-back-link">×</a>
        </div>
        <div class="user_menu-inner">
            <div class="user_menu-link">
                <a href="/" class="user_menu-text">Home</a>
            </div>
            <div class="user_menu-link">
                <form action="/logout" method="post">
                    @csrf
                    <button class="user_menu-button">Logout</button>
                </form>
            </div>
            <div class="user_menu-link">
                <a href="/mypage/{{ Auth::id() }}" class="user_menu-text">Mypage</a>
            </div>
            @hasanyrole('admin')
            <div class="user_menu-link">
                <a href="/admin" class="user_menu-text">Admin</a>
            </div>
            @endhasanyrole
            @hasanyrole('store_owner')
            <div class="user_menu-link">
                <a href="{{ route('store_owner') }}" class="user_menu-text">Store_Owner_Admin</a>
            </div>
            @endhasanyrole
        </div>
    </div>
@endsection
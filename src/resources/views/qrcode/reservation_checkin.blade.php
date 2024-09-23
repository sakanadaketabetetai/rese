@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/reservation_checkin.css') }}">
@endsection

@section('content')
<div class="checkin-complete">
    <div class="checkin-complete__container">
        <div class="checkin-complete__icon-container">
            <i class="checkin-complete__icon">&#10003;</i>
        </div>
        <h1 class="checkin-complete__title">入店完了</h1>
        <p class="checkin-complete__message">予約が正常に確認されました。<br>ご来店いただきありがとうございます。</p>
        <a href="/" class="checkin-complete__home-link">ホームに戻る</a>
    </div>
</div>
@endsection

@extends('layouts.app')
    <link rel="stylesheet" href="{{ asset('css/reservation_qrcode.css') }}">
@section('content')
<div class="qr-code_inner">
    <a href="/mypage/{{ Auth::id() }}" class="qr-code_link"><</a>
</div>
<div class="qr-code">
    <h1>予約のQRコード</h1>
    <p>以下のQRコードを店舗に提示してください。</p>
    <div>{!! $qrCode !!}</div>
</div>
@endsection 
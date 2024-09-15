@extends('layouts.app')

@section('content')
<div class="qr-code">
    <h1>予約のQRコード</h1>
    <p>以下のQRコードを店舗に提示してください。</p>
    <div>{!! $qrCode !!}</div>
</div>
@endsection
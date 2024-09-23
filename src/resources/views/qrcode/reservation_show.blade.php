@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/reservation_show.css') }}">
@endsection

@section('content')
<div class="reservation">
    <h1 class="reservation__title">予約情報</h1>
    
    <div class="reservation__details">
        <p class="reservation__detail"><strong>予約ID:</strong> {{ $reservation->id }}</p>
        <p class="reservation__detail"><strong>予約者名:</strong> {{ $reservation->user->name }}</p>
        <p class="reservation__detail"><strong>予約日:</strong> {{ $reservation->reservation_day }}</p>
        <p class="reservation__detail"><strong>予約時間:</strong> {{ $reservation->reservation_time }}</p>
        <p class="reservation__detail"><strong>人数:</strong> {{ $reservation->number_of_people }} 人</p>
    </div>
    
    <form action="{{ route('reservation.checkIn') }}" method="post" class="reservation__form">
        @csrf
        <input type="hidden" name="id" value="{{ $reservation->id }}">
        <button class="reservation__checkin-btn">入店確認する</button>
    </form>
</div>
@endsection

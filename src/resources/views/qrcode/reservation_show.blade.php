@extends('layouts.app')

@section('content')
    <h1>予約情報</h1>
    <p>予約ID: {{ $reservation->id }}</p>
    <p>予約者名: {{ $reservation->user->name }}</p>
    <p>予約日: {{ $reservation->reservation_day }}</p>
    <p>予約時間: {{ $reservation->reservation_time }}</p>
    <p>人数: {{ $reservation->number_of_people }}</p>
    <form action="{{ route('reservation.checkIn') }}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{ $reservation->id }}">
        <button>入店確認する</button>
    </form>
@endsection

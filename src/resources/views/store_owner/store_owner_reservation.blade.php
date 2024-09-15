@extends('layouts.store_owner')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/store_owner_reservation.css') }}">
@endsection

@section('content')
<div class="reservations">
    <table class="reservations__table">
        <thead class="reservations__header">
            <tr class="reservations__row">
                <th class="reservations__column-title">来店者名</th>
                <th class="reservations__column-title">予約日</th>
                <th class="reservations__column-title">予約時間</th>
                <th class="reservations__column-title">予約人数</th>
            </tr>
        </thead>
        <tbody class="reservations__body">
            @foreach($reservations as $reservation)
            <tr class="reservations__row">
                <td class="reservations__data">{{ $reservation->user_name }}</td>
                <td class="reservations__data">{{ $reservation->reservation_day }}</td>
                <td class="reservations__data">{{ $reservation->reservation_time }}</td>
                <td class="reservations__data">{{ $reservation->number_of_people }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

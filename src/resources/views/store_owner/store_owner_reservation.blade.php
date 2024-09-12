@extends('layouts.store_owner')

@section('css')

@endsection

@section('content')
<div>
    <table>
        <tr>
            <th>来店者名</th>
            <th>予約日</th>
            <th>予約時間</th>
            <th>予約人数</th>
        </tr>
        @foreach($reservations as $reservation)
        <tr>
            <td>{{ $reservation->user_name }}</td>
            <td>{{ $reservation->reservation_day }}</td>
            <td>{{ $reservation->reservation_time }}</td>
            <td>{{ $reservation->number_of_people }}</td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
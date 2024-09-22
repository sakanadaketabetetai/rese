@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/reservation_detail.css') }}">
@section('content')
<div class="reservation-detail">
    <div class="reservation_header-back">
        <form action="/mypage/{{ Auth::id() }}" method="get">
            @csrf
            <button class="reservation_button-submit"><</button>
        </form>
    </div>
    <div class="reservation-detail_content">
        <div class="reservation-detail__info">
            <table class="reservation-detail__table"> 
                <tr>
                    <th class="reservation-detail__label">Shop</th>
                    <td class="reservation-detail__value">{{ $store->store_name }}</td>
                </tr>
                <tr>
                    <th class="reservation-detail__label">Date</th>
                    <td class="reservation-detail__value">{{ $reservation->reservation_day }}</td>
                </tr>
                <tr>
                    <th class="reservation-detail__label">Time</th>
                    <td class="reservation-detail__value">{{ $reservation->reservation_time }}</td>
                </tr>
                <tr>
                    <th class="reservation-detail__label">Number</th>
                    <td class="reservation-detail__value">{{ $reservation->number_of_people }} 人</td>
                </tr>
            </table>
        </div>
        <div class="reservation-detail__form">
            <form action="/reservation/detail/update" method="post">
                @csrf
                <input type="hidden" name="id" value="{{ $reservation->id }}">
                <table class="reservation-detail__form-table">
                    <tr>
                        <th class="reservation-detail__form-label">Shop</th>
                        <td class="reservation-detail__form-value">{{ $store->store_name }}</td>
                    </tr>
                    <tr>
                        <th class="reservation-detail__form-label">Date</th>
                        <td>
                            <input type="date" name="reservation_day" value="{{ old('reservation_day', $reservation->reservation_day) }}" class="reservation-detail__form-input">
                        </td>
                    </tr>
                    <tr>
                        <th class="reservation-detail__form-label">Time</th>
                        <td>
                            <select name="reservation_time" class="reservation-detail__form-select">
                                @foreach($times as $time)
                                    <option value="{{ $time }}" {{ old('reservation_time', $reservation->reservation_time) == $time ? 'selected' : '' }}>
                                        {{ $time }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th class="reservation-detail__form-label">Number</th>
                        <td>
                            <select name="number_of_people" class="reservation-detail__form-select">
                                @foreach($number_of_peoples as $number)
                                    <option value="{{ $number }}" {{ old('number_of_people', $reservation->number_of_people) == $number ? 'selected' : '' }}>
                                        {{ $number }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                </table>
                <div class="reservation-detail__form-button">
                    <button type="submit" class="reservation-detail__submit-button">予約内容修正</button>
                </div>
            </form>
        </div>
    </div>
    
</div>
@endsection

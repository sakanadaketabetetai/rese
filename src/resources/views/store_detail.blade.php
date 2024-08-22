@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/store_detail.css') }}">
@endsection

@section('content')
<div class="store_detail-content">
    <div class="store_deatil">
        <div class="store_detail-inner">
                <a href="/" class="store_detail-linl"><</a>
                <h2 class="store_detail-ttl">{{ $store->store_name }}</h2>
        </div>
        <div class="store_detail-img">
            <img src="{{ $store->image }}">
        </div>
        <div class="store_detail-tag">
            <span class="store_detail-tag-text">#{{ $store->store_area }}</span>
            <span class="store_detail-tag-text">#{{ $store->store_genre }}</span>
        </div>
        <div class="store_detail-introduction">
            <p class="store_detail-introduction-text">{{ $store->store_introduction }}</p>
        </div>
    </div>
    <div class="store_reservation">
        <div class="store_reservation-ttl">
            <h2 class="store_reservation-ttl-text">予約</h2>
        </div>
        <form action="/reservation" method="post">
            @csrf
            <div class="store_reservation-date">
                <input type="hidden" name="store_id" value="{{ $store->id }}">
                <input type="date" name="reservation_day" id="reservation_day" onchange="updateTable()">
            </div>
            <div class="store_reservation-time">
                <select name="reservation_time" id="reservation_time" onchange="updateTable()">
                    @foreach($times as $time)
                        <option value="{{ $time }}">{{ $time }}</option>
                    @endforeach
                </select>
            </div>
            <div class="store_reservation-number">
                <select name="reservation_number" id="reservation_number" onchange="updateTable()">
                    @foreach($number_of_peoples as $number_of_people)
                        <option value="{{ $number_of_people }}">{{ $number_of_people }} 人</option>
                    @endforeach
                </select>
            </div>
            <div class="store_reservation-confirm">
                <table>
                    <tr>
                        <th>Shop</th>
                        <td>{{ $store->store_name }}</td>
                    </tr>
                    <tr>
                        <th>Date</th>
                        <td id="confirm_day" ></td>
                    </tr>
                    <tr>
                        <th>Time</th>
                        <td id="confirm_time"></td>
                    </tr>
                    <tr>
                        <th>Number</th>
                        <td id="confirm_number"></td>
                    </tr>
                </table>
            </div>
            <div class="store_reservation-button">
                <button class="store_reservation-button-submit">予約する</button>
            </div>
        </form>
        <script>
            function updateTable(){
                //日付を更新
                var date = document.getElementById('reservation_day').value;
                document.getElementById('confirm_day').innerText = date;
                //時間を更新
                var time = document.getElementById('reservation_time').value;
                document.getElementById('confirm_time').innerText = time;
                //人数を更新
                var number = document.getElementById('reservation_number').value;
                document.getElementById('confirm_number').innerText = number + '人';
            }
        </script>
    </div>
</div>
@endsection
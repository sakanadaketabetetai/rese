@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/store_detail.css') }}">
@endsection

@section('content')
<div class="store_detail-content">
    <div class="store_detail">
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
        <div class="store_review">
            <div class="store_review-inner">
                @foreach($store_reviews as $store_review)
                <div class="store_review-content">
                    <p class="store_review-text">{{ $store_review->content}}</p>
                    <p class="store_review-star">{{ $store_review->stars}}</p>
                    <label>{{ $store_review->created_at}} {{ $store_review->user->name}}</label>
                </div>
                @endforeach
                <form action="/store/review" method="POST">
                    @csrf
                    <h3>レビュー投稿</h3>
                    <h4>スター</h4>
                    <div class="store_review-star">
                        <div class="store_review-star-input">
                            <input type="radio" name="stars" value="5">★★★★★
                        </div>
                        <div class="store_review-star-input">
                            <input type="radio" name="stars" value="4">★★★★
                        </div>
                        <div class="store_review-star-input">
                            <input type="radio" name="stars" value="3">★★★
                        </div>
                        <div class="store_review-star-input">
                            <input type="radio" name="stars" value="2">★★
                        </div>
                        <div class="store_review-star-input">
                            <input type="radio" name="stars" value="1">★
                        </div>
                    </div>
                    <div class="star_review-comment">
                        <h4>コメント</h4>
                        <textarea name="content" class="store_review-text"></textarea>
                    </div>
                    <input type="hidden" name="store_id" value="{{ $store->id }}">
                    <div class="store_review-button">
                        <button type="submit" class="store_review-button-submit">評価する</button>
                    </div>
                </form>
            </div>
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
            @error('reservation_day')
            <div class="reservation_error">
                {{$errors->first('reservation_day')}}
            </div>
            @enderror  
            <div class="store_reservation-time">
                <select name="reservation_time" id="reservation_time" onchange="updateTable()">
                    @foreach($times as $time)
                        <option value="{{ $time }}">{{ $time }}</option>
                    @endforeach
                </select>
            </div>
            @error('reservation_time')
            <div class="reservation_error">
                {{$errors->first('reservation_time')}}                
            </div>
            @enderror  
            <div class="store_reservation-number">
                <select name="number_of_people" id="number_of_people" onchange="updateTable()">
                    @foreach($number_of_peoples as $number_of_people)
                        <option value="{{ $number_of_people }}">{{ $number_of_people }} 人</option>
                    @endforeach
                </select>
            </div>
            @error('number_of_people')
            <div class="reservation_error">
                {{$errors->first('number_of_people')}}                
            </div>
            @enderror  
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
                var number = document.getElementById('number_of_people').value;
                document.getElementById('confirm_number').innerText = number + '人';
            }
        </script>
        <script src="https://unpkg.com/vue@next"></script>
        <script>
            const app = Vue.createApp({
                data() {
                    return {
                        stars: 0,
                        reservationDay: '',
                        reservationTime: '',
                        numberOfPeople: 1
                    }
                },
                methods: {
                    updateTable() {
                        // 日付、時間、人数のデータはリアクティブに自動更新される
                    }
                }
            });

            app.mount('#app');
        </script>
    </div>
</div>
@endsection
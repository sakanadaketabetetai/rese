@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
<div class="mypage_content">
    <div class="mypage_ttl">
        <h2 class="mypage_ttl-text">{{ $user->name }} さん</h2>
    </div>
    <div>
        <div class="mypage_reservation">
            <div class="mypage_reservation-ttl">
                <h2 class="mypage_reservation-text">予約状況</h2>
            </div>
            <div class="mypage_reservation-card">
                @foreach ( $reservations as $reservation )
                <div class="mypage_reservation-card-header">
                    <img src="/storage/images/シンプルな丸時計のアイコン.png">
                    <span>予約</span>
                    <form action="/reservation/delete" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $reservation->id }}">
                        <button>
                            <img src="/storage/images/ノーマルの太さのバツアイコン2.png">                            
                        </button>
                    </form>
                </div>
                <div class="mypage_reservation-card-table">
                    <table>
                        <tr>
                            <th>Shop</th>
                            <td>{{ $reservation->store_name }}</td>
                        </tr>
                        <tr>
                            <th>Date</th>
                            <td>{{ $reservation->reservation_day }}</td>
                        </tr>
                        <tr>
                            <th>Time</th>
                            <td>{{ $reservation->reservation_time }}</td>
                        </tr>
                        <tr>
                            <th>Number</th>
                            <td>{{ $reservation->number_of_people }} 人</td>
                        </tr>
                    </table>
                </div>
                @endforeach
            </div>
        </div>
        <div class="mypage_favorite">
            <div class="mypage_favorite-ttl">
                <h2 class="mypage_favorite-text">お気に入り店舗</h2>
            </div>
            @foreach ($stores as $store)
            <div class="store_card">
                <div class="store_card-img">
                    <img src="{{ $store->image }}" alt="">
                </div>
                <div class="store_card-ttl">{{ $store->store_name }}</div>
                <div class="store_card-content">
                    <div class="store_card-content-tag">
                        <span class="store_card-content-tag">#{{ $store->store_area }}</span>
                        <span class="store_card-content-tag">#{{ $store->store_genre }}</span>
                    </div>
                    <div class="store_card-button">
                        <form action="/detail/{{ $store->id }}" method="get">
                            @csrf
                            <button class="form_button-submit" type="submit">詳しく見る</button>
                        </form>
                        <form action="/favorite_store" method="post">
                            @csrf
                            <input type="hidden" name="store_id" value="{{ $store->id }}">
                            @if($store->isFavorite())
                                <button class="form_button-submit-favorite" type="submit">♥</button>
                            @else
                                <button class="form_button-submit" type="submit">♥</button>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
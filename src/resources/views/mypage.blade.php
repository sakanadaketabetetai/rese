@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
<div class="mypage">
    <div class="mypage_header">
        <h2 class="mypage_title">{{ $user->name }} さん</h2>
    </div>
    <div class="mypage_sections">
        <div class="mypage_reservations">
            <div class="mypage_reservations-header">
                <h2 class="mypage_reservations-title">予約状況</h2>
            </div>
            <div class="mypage_reservations-list">
                @foreach ( $reservations as $reservation )
                <div class="reservations-card">
                    <div class="reservation-card_header">
                        <img src="/storage/images/シンプルな丸時計のアイコン.png">
                        <div class="reservation-card_title">
                            <span>予約</span>
                        </div>
                        <form action="/reservation/delete" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $reservation->id }}">
                            <button>
                                <img src="/storage/images/ノーマルの太さのバツアイコン2.png">                            
                            </button>
                        </form>
                    </div>
                    <div class="reservation-card-table">
                        <form action="/reservation/detail/{{ $reservation->id }}" method="get">
                            @csrf
                            <table>
                                <tr>
                                    <th>Shop</th>
                                    <td class="mypage_reservation-store-name">
                                        <div class="mypage_reservation-time">
                                            <p class="mypage_reservation-input">{{ $reservation->store_name}}</p>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Date</th>
                                    <td>
                                        <div class="mypage_reservation-time">
                                            <p class="mypage_reservation-input" >{{ $reservation->reservation_day }}</p>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Time</th>
                                    <td>
                                        <div class="mypage_reservation-time">
                                            <p class="mypage_reservation-input">{{ $reservation->reservation_time }}</p>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Number</th>
                                    <td>
                                        <div class="mypage_reservation-time">
                                            <p class="mypage_reservation-input">{{ $reservation->number_of_people }} 人</p>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <div class="mypage_reservation-action">
                                <div class="mypage_reservation-action--link">
                                    <a href="{{ route('reservation_qrcode', ['id' => $reservation->id]) }}">QRコードを見る</a>
                                </div>
                                <div class="mypage_reservation-action--link">
                                    <a href="{{ route('stripe.index', ['id' => $reservation->id]) }}">支払い画面へ</a>
                                </div>
                                <div class="mypage_reservation-button">
                                    <button class="mypage_reservation-button-submit">予約情報変更画面</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="mypage_favorite">
            <div class="mypage_favorite-ttl">
                <h2 class="mypage_favorite-text">お気に入り店舗</h2>
            </div>
            <div class="mypage_favorite-list">
                @foreach ($favorite_stores as $favorite_store)
                <div class="store_card">
                    <div class="store_card-img">
                        <img src="{{ $favorite_store->image }}" alt="">
                    </div>
                    <div class="store_card-ttl">{{ $favorite_store->store_name }}</div>
                    <div class="store_card-content">
                        <div class="store_card-content-tag">
                            <span class="store_card-content-tag">#{{ $favorite_store->store_area }}</span>
                            <span class="store_card-content-tag">#{{ $favorite_store->store_genre }}</span>
                        </div>
                        <div class="store_card-button">
                            <form action="/detail/{{ $favorite_store->id }}" method="get">
                                @csrf
                                <button class="form_button-submit" type="submit">詳しく見る</button>
                            </form>
                            <form action="/favorite_store" method="post">
                                @csrf
                                <input type="hidden" name="store_id" value="{{ $favorite_store->id }}">
                                @if($favorite_store->isFavorite())
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
</div>
@endsection
@extends('layouts.store_owner')

@section('css')
<link rel="stylesheet" href="{{ asset('css/store_owner_info.css') }}">
@endsection


@section('content')
<div class="store-management">
    @foreach($stores as $store)
        <div class="store-management__view">
            <table class="store-management__table">
                <tr class="store-management__row">
                    <th class="store-management__header">店名</th>
                    <td class="store-management__data">{{ $store->store_name }}</td>
                </tr>
                <tr class="store-management__row">
                    <th class="store-management__header">エリア</th>
                    <td class="store-management__data">{{ $store->store_area }}</td>
                </tr>
                <tr class="store-management__row">
                    <th class="store-management__header">ジャンル</th>
                    <td class="store-management__data">{{ $store->store_genre }}</td>
                </tr>
                <tr class="store-management__row">
                    <th class="store-management__header">店舗情報</th>
                    <td class="store-management__data">{{ $store->store_introduction }}</td>
                </tr>
                <tr class="store-management__row">
                    <th class="store-management__header">店舗イメージ</th>
                    <td class="store-management__data">{{ $store->image }}</td>
                </tr>
                <tr class="store-management__row">
                    <th class="store-management__header">開店時間</th>
                    <td class="store-management__data">{{ $store->open_time }}</td>
                </tr>
                <tr class="store-management__row">
                    <th class="store-management__header">閉店時間</th>
                    <td class="store-management__data">{{ $store->close_time }}</td>
                </tr>
                <tr class="store-management__row">
                    <th class="store-management__header">定休日</th>
                    <td class="store-management__data">{{ $store->regular_holiday }}</td>
                </tr>
                <tr class="store-management__row">
                    <th class="store-management__header">最大予約可能人数</th>
                    <td class="store-management__data">{{ $store->max_number_of_people }} 人</td>
                </tr>
            </table>
        </div>

        <div class="store-management__edit">
            <div class="store-management__edit-title">
                <h3 class="store-management__edit-text">店舗情報更新フォーム</h3>
            </div>
            <form action="{{ route('store.info.update') }}" method="post" class="store-management__form">
                @csrf
                <input type="hidden" name="store_id" value="{{ $store->id }}">
                <table class="store-management__table">
                    <tr class="store-management__row">
                        <th class="store-management__header">店名</th>
                        <td class="store-management__data">
                            <input class="store-management__input" type="text" name="store_name" placeholder="{{ $store->store_name }}" value="{{ old($store->store_name) }}">
                        </td>
                    </tr>
                    <tr class="store-management__row">
                        <th class="store-management__header">エリア</th>
                        <td class="store-management__data">
                            <input class="store-management__input" type="text" name="store_area" placeholder="{{ $store->store_area }}" value="{{ old($store->store_area) }}">
                        </td>
                    </tr>
                    <tr class="store-management__row">
                        <th class="store-management__header">ジャンル</th>
                        <td class="store-management__data">
                            <input class="store-management__input" type="text" name="store_genre" placeholder="{{ $store->store_genre }}" value="{{ old($store->store_genre) }}">
                        </td>
                    </tr>
                    <tr class="store-management__row">
                        <th class="store-management__header">店舗情報</th>
                        <td class="store-management__data">
                            <input class="store-management__input" type="text" name="store_introduction" placeholder="{{ $store->store_introduction }}" value="{{ old($store->store_introduction) }}">
                        </td>
                    </tr>
                    <tr class="store-management__row">
                        <th class="store-management__header">店舗イメージ</th>
                        <td class="store-management__data">
                            <input class="store-management__input" type="text" name="image" placeholder="{{ $store->image }}" value="{{ old($store->image) }}">
                        </td>
                    </tr>
                    <tr class="store-management__row">
                        <th class="store-management__header">開店時間</th>
                        <td class="store-management__data">
                            <input class="store-management__input" type="text" name="open_time" placeholder="{{ $store->open_time }}" value="{{ old($store->open_time) }}">
                        </td>
                    </tr>
                    <tr class="store-management__row">
                        <th class="store-management__header">閉店時間</th>
                        <td class="store-management__data">
                            <input class="store-management__input" type="text" name="close_time" placeholder="{{ $store->close_time }}" value="{{ old($store->close_time) }}">
                        </td>
                    </tr>
                    <tr class="store-management__row">
                        <th class="store-management__header">定休日</th>
                        <td class="store-management__data">
                            <input class="store-management__input" type="text" name="regular_holiday" placeholder="{{ $store->regular_holiday }}" value="{{ old($store->regular_holiday) }}">
                        </td>
                    </tr>
                    <tr class="store-management__row">
                        <th class="store-management__header">最大予約可能人数</th>
                        <td class="store-management__data">
                            <input class="store-management__input" type="text" name="max_number_of_people" placeholder="{{ $store->max_number_of_people }}" value="{{ old($store->max_number_of_people) }}">
                        </td>
                    </tr>
                    <tr class="store-management__row">
                        <td class="store-management__data" colspan="2">
                            <div class="store-management__button">
                                <button class="store-management__button-submit" type="submit">更新</button>
                            </div>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    @endforeach
</div>
@endsection

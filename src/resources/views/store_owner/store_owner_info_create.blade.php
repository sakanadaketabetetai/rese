@extends('layouts.store_owner')

@section('css')
<link rel="stylesheet" href="{{ asset('css/store_owner_info_create.css') }}">
@endsection 

@section('content')
<div class="store-info">
    <div class="store-info__container">
        <form action="{{ route('store.info.create') }}" method="post" class="store-info__form">
            @csrf
            <table class="store-info__table">
                <tr class="store-info__row">
                    <th class="store-info__label">店名</th>
                    <td class="store-info__input-cell">
                        <input class="store-info__input" type="text" name="store_name" placeholder="店名" value="{{ old('store_name') }}">
                    </td>
                </tr>
                @error('store_name')
                <tr class="store_error">
                    {{ $message }}
                </tr>
                @enderror
                <tr class="store-info__row">
                    <th class="store-info__label">エリア</th>
                    <td class="store-info__input-cell">
                        <input class="store-info__input" type="text" name="store_area" placeholder="エリア" value="{{ old('store_area') }}">
                    </td>
                </tr>
                @error('store_area')
                <tr class="store_error">
                    {{ $message }}
                </tr>
                @enderror
                <tr class="store-info__row">
                    <th class="store-info__label">ジャンル</th>
                    <td class="store-info__input-cell">
                        <input class="store-info__input" type="text" name="store_genre" placeholder="ジャンル" value="{{ old('store_genre') }}">
                    </td>
                </tr>
                @error('store_genre')
                <tr class="store_error">
                    {{ $message }}
                </tr>
                @enderror
                <tr class="store-info__row">
                    <th class="store-info__label">店舗情報</th>
                    <td class="store-info__input-cell">
                        <input class="store-info__input" type="text" name="store_introduction" placeholder="店舗情報" value="{{ old('store_introduction') }}">
                    </td>
                </tr>
                @error('store_introduction')
                <tr class="store_error">
                    {{ $message }}
                </tr>
                @enderror
                <tr class="store-info__row">
                    <th class="store-info__label">店舗イメージ</th>
                    <td class="store-info__input-cell">
                        <input class="store-info__input" type="text" name="image" placeholder="画像イメージ" value="{{ old('image') }}">
                    </td>
                </tr>
                @error('image')
                <tr class="store_error">
                    {{ $message }}
                </tr>
                @enderror
                <tr class="store-info__row">
                    <th class="store-info__label">開店時間</th>
                    <td class="store-info__input-cell">
                        <input class="store-info__input" type="text" name="open_time" placeholder="開店時間" value="{{ old('open_time') }}">
                    </td>
                </tr>
                @error('open_time')
                <tr class="store_error">
                    {{ $message }}
                </tr>
                @enderror
                <tr class="store-info__row">
                    <th class="store-info__label">閉店時間</th>
                    <td class="store-info__input-cell">
                        <input class="store-info__input" type="text" name="close_time" placeholder="閉店時間" value="{{ old('close_time') }}">
                    </td>
                </tr>
                @error('close_time')
                <tr class="store_error">
                    {{ $message }}
                </tr>
                @enderror
                <tr class="store-info__row">
                    <th class="store-info__label">定休日</th>
                    <td class="store-info__input-cell">
                        <input class="store-info__input" type="text" name="regular_holiday" placeholder="定休日" value="{{ old('regular_holiday') }}">
                    </td>
                </tr>
                @error('regular_holiday')
                <tr class="store_error">
                    {{ $message }}
                </tr>
                @enderror
                <tr class="store-info__row">
                    <th class="store-info__label">最大予約可能人数</th>
                    <td class="store-info__input-cell">
                        <input class="store-info__input" type="text" name="max_number_of_people" placeholder="最大予約可能人数" value="{{ old('max_number_of_people') }}">
                    </td>
                </tr>
                @error('max_number_of_people')
                <tr class="store_error">
                    {{ $message }}
                </tr>
                @enderror
                <tr class="store-info__row">
                    <td class="store-info__input-cell" colspan="2">
                        <button class="store-info__submit-btn" type="submit">作成</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
@endsection

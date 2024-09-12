@extends('layouts.store_owner')

@section('css')

@endsection
@section('content')
<div>
    @foreach($stores as $store)
        <div>
            <table>
                <tr>
                    <th>店名</th>
                    <td>{{ $store->store_name }}</td>
                </tr>
                <tr>
                    <th>エリア</th>
                    <td>{{ $store->store_area }}</td>
                </tr>
                <tr>
                    <th>ジャンル</th>
                    <td>{{ $store->store_genre }}</td>
                </tr>
                <tr>
                    <th>店舗情報</th>
                    <td>{{ $store->store_introduction }}</td>
                </tr>
                <tr>
                    <th>店舗イメージ</th>
                    <td>{{ $store->image }}</td>
                </tr>
                <tr>
                    <th>開店時間</th>
                    <td>{{ $store->open_time }}</td>
                </tr>
                <tr>
                    <th>閉店時間</th>
                    <td>{{ $store->close_time }}</td>
                </tr>
                <tr>
                    <th>定休日</th>
                    <td>{{ $store->regular_holiday }}</td>
                </tr>
                <tr>
                    <th>最大予約可能人数</th>
                    <td>{{ $store->max_number_of_people }} 人</td>
                </tr>
            </table>
        </div>
        <div>
            <form action="{{ route('store.info.update') }}" method="post">
                @csrf
                <input type="hidden" name="store_id" value="{{ $store->id }}">
                <table>
                    <tr>
                        <th>店名</th>
                        <td>
                            <input type="text" name="store_name" placeholder="{{ $store->store_name }}" value="{{ old($store->store_name) }}">
                        </td>
                    </tr>
                    <tr>
                        <th>エリア</th>
                        <td>
                            <input type="text" name="store_area" placeholder="{{ $store->store_area }}" value="{{ old($store->store_area) }}">
                        </td>
                    </tr>
                    <tr>
                        <th>ジャンル</th>
                        <td>
                            <input type="text" name="store_genre" placeholder="{{ $store->store_genre }}" value="{{ old($store->store_genre) }}">
                        </td>
                    </tr>
                    <tr>
                        <th>店舗情報</th>
                        <td>
                            <input type="text" name="store_introduction" placeholder="{{ $store->store_introduction }}" value="{{ old($store->store_introduction) }}">
                        </td>
                    </tr>
                    <tr>
                        <th>店舗イメージ</th>
                        <td>
                            <input type="text" name="image" placeholder="{{ $store->image }}" value="{{ old($store->image) }}">
                        </td>
                    </tr>
                    <tr>
                        <th>開店時間</th>
                        <td>
                            <input type="text" name="open_time" placeholder="{{ $store->open_time }}" value="{{ old($store->open_time) }}">
                        </td>
                    </tr>
                    <tr>
                        <th>閉店時間</th>
                        <td>
                            <input type="text" name="close_time" placeholder="{{ $store->close_time }}" value="{{ old($store->close_time) }}">
                        </td>
                    </tr>
                    <tr>
                        <th>定休日</th>
                        <td>
                            <input type="text" name="regular_holiday" placeholder="{{ $store->regular_holiday }}" value="{{ old($store->regular_holiday) }}">
                        </td>
                    </tr>
                    <tr>
                        <th>最大予約可能人数</th>
                        <td>
                            <input type="text" name="max_number_of_people" placeholder="{{ $store->max_number_of_people }}" value="{{ old($store->max_number_of_people) }}">
                        </td>
                    </tr>
                    <tr>
                        <th></th>
                        <td>
                            <div>
                                <button type="submit">更新</button>
                            </div>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    @endforeach
</div>
@endsection
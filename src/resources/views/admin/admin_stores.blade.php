@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin_stores.css') }}">
@endsection

@section('content')
    <div class="store-list">
        <div class="store-list__header">
            <h1 class="store-list__title">店舗情報一覧</h1>
        </div>
        <div class="store-list__table-container">
            <table class="store-list__table">
                <thead class="store-list__table-head">
                    <tr class="store-list__table-row">
                        <th class="store-list__table-heading">ID</th>
                        <th class="store-list__table-heading">店名</th>
                        <th class="store-list__table-heading">エリア</th>
                        <th class="store-list__table-heading">ジャンル</th>
                        <th class="store-list__table-heading">お店情報</th>
                        <th class="store-list__table-heading">イメージ</th>
                        <th class="store-list__table-heading">開店時間</th>
                        <th class="store-list__table-heading">閉店時間</th>
                        <th class="store-list__table-heading">定休日</th>
                        <th class="store-list__table-heading">最大予約可能人数</th>
                        <th class="store-list__table-heading">登録日</th>
                    </tr>
                </thead>
                <tbody class="store-list__table-body">
                    @foreach($stores as $store)
                    <tr class="store-list__table-row">
                        <td class="store-list__table-cell">{{ $store->id }}</td>
                        <td class="store-list__table-cell">{{ $store->store_name }}</td>
                        <td class="store-list__table-cell">{{ $store->store_area }}</td>
                        <td class="store-list__table-cell">{{ $store->store_genre }}</td>
                        <td class="store-list__table-cell">{{ $store->store_introduction }}</td>
                        <td class="store-list__table-cell">{{ $store->image }}</td>
                        <td class="store-list__table-cell">{{ $store->open_time }}</td>
                        <td class="store-list__table-cell">{{ $store->close_time }}</td>
                        <td class="store-list__table-cell">{{ $store->regular_holiday }}</td>
                        <td class="store-list__table-cell">{{ $store->max_number_of_people }} 人</td>
                        <td class="store-list__table-cell">{{ $store->created_at }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

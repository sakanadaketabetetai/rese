@extends('layouts.admin')

@section('css')

@endsection

@section('content')
    <div class="admin-stores_content">
        <div class="admin-stores_title">
            <h1>ユーザー一覧</h1>
        </div>
        <div class="admin-stores_table">
            <table>
                <tr>
                    <th>ID</th>
                    <th>店名</th>
                    <th>エリア</th>
                    <th>ジャンル</th>
                    <th>お店情報</th>
                    <th>イメージ</th>
                    <th>開店時間</th>
                    <th>閉店時間</th>
                    <th>定休日</th>
                    <th>最大予約可能時間</th>
                    <th>登録日</th>
                </tr>
                @foreach($stores as $store)
                <tr>
                    <td>{{ $store->id }}</td>
                    <td>{{ $store->store_name }}</td>
                    <td>{{ $store->store_area }}</td>
                    <td>{{ $store->store_genre }}</td>
                    <td>{{ $store->store_introduction }}</td>
                    <td>{{ $store->image }}</td>
                    <td>{{ $store->open_time }}</td>
                    <td>{{ $store->close_time }}</td>
                    <td>{{ $store->regular_holiday }}</td>
                    <td>{{ $store->max_number_of_people }} 人</td>
                    <td>{{ $store->created_at }}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
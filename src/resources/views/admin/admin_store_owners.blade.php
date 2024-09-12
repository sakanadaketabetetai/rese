@extends('layouts.admin')

@section('css')

@endsection

@section('content')
    <div class="admin-users_content">
        <div class="admin-users_title">
            <h1>店舗代表者入力画面</h1>
        </div>
        <div class="admin-users_table">
            <table>
                <form action="{{ route('admin.add.store.owner') }}" method="post">
                    @csrf
                    <tr>
                        <th>店舗代表者氏名</th>
                        <td>
                            <input type="text" name="name" placeholder="店舗代表者氏名" value="{{ old('name') }}">
                        </td>
                    </tr>
                    <tr>
                        <th>メールアドレス</th>
                        <td>
                            <input type="email" name="email" placeholder="メールアドレス" value="{{ old('email')}}">
                        </td>
                    </tr>
                    <tr>
                        <th>パスワード</th>
                        <td>
                            <input type="password" name="password" placeholder="パスワード">
                        </td>
                    </tr>
                    <tr>
                        <th>店舗名</th>
                        <td>
                            <select name="store_id">
                                <option></option>
                                @foreach( $stores as $store )
                                    <option value="{{ $store->id }}">{{ $store->store_name }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <button>店舗代表者を追加する</button>
                    </tr>
                </form>
            </table>
        </div>
    </div>
@endsection
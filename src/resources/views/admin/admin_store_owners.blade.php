@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin_owners.css') }}">
@endsection

@section('content')
    <div class="store-owner-form">
        <div class="store-owner-form__header">
            <h1 class="store-owner-form__title">店舗代表者入力画面</h1>
        </div>
        <div class="store-owner-form__body">
            <table class="store-owner-form__table">
                <form action="{{ route('admin.add.store.owner') }}" method="post">
                    @csrf
                    <tr class="store-owner-form__row">
                        <th class="store-owner-form__label">店舗代表者氏名</th>
                        <td class="store-owner-form__input-container">
                            <input type="text" name="name" class="store-owner-form__input" placeholder="店舗代表者氏名" value="{{ old('name') }}">
                        </td>
                    </tr>
                    @error('name')
                    <tr>
                        <th></th>
                        <td>
                            <div class="error_message">
                                {{ $message }}
                            </div>
                        </td>
                    </tr>
                    @enderror 
                    <tr class="store-owner-form__row">
                        <th class="store-owner-form__label">メールアドレス</th>
                        <td class="store-owner-form__input-container">
                            <input type="email" name="email" class="store-owner-form__input" placeholder="メールアドレス" value="{{ old('email')}}">
                        </td>
                    </tr>
                    @error('email')
                    <tr>
                        <th></th>
                        <td>
                            <div class="error_message">
                                {{ $message }}
                            </div>
                        </td>
                    </tr>
                    @enderror
                    <tr class="store-owner-form__row">
                        <th class="store-owner-form__label">パスワード</th>
                        <td class="store-owner-form__input-container">
                            <input type="password" name="password" class="store-owner-form__input" placeholder="パスワード">
                        </td>
                    </tr>
                    @error('password')
                    <tr>
                        <th></th>
                        <td>
                            <div class="error_message">
                                {{ $message }}
                            </div>
                        </td>
                    </tr>
                    @enderror
                    <tr class="store-owner-form__row">
                        <th class="store-owner-form__label">店舗名</th>
                        <td class="store-owner-form__input-container">
                            <select name="store_id" class="store-owner-form__select">
                                <option></option>
                                @foreach( $stores as $store )
                                    <option value="{{ $store->id }}">{{ $store->store_name }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    @error('store_id')
                    <tr>
                        <th></th>
                        <td>
                            <div class="error_message">
                                {{ $message }}
                            </div>
                        </td>
                    </tr>
                    @enderror
                    <tr class="store-owner-form__row store-owner-form__row--submit">
                        <td colspan="2">
                            <button class="store-owner-form__submit-btn">店舗代表者を追加する</button>
                        </td>
                    </tr>
                </form>
            </table>
        </div>
    </div>
@endsection

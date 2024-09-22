@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin_users.css') }}">
@endsection

@section('content')
    <div class="user-list">
        <div class="user-list__header">
            <h1 class="user-list__title">ユーザー一覧</h1>
        </div>
        <div class="user-list__table-container">
            <form action="{{ route('admin.announcementMail.create') }}" method="post">
                @csrf
                <table class="user-list__table">
                    <thead class="user-list__table-head">
                        <tr class="user-list__table-row">
                            <th class="user-list__table-heading">メール送信先</th>
                            <th class="user-list__table-heading">ID</th>
                            <th class="user-list__table-heading">お名前</th>
                            <th class="user-list__table-heading">メールアドレス</th>
                            <th class="user-list__table-heading">パスワード</th>
                            <th class="user-list__table-heading">登録日</th>
                            <th class="user-list__table-heading">権限</th>
                            <th class="user-list__table-heading">権限変更</th>
                            <th class="user-list__table-heading">削除</th>
                        </tr>
                    </thead>
                    <tbody class="user-list__table-body">
                        @foreach( $users as $user )
                        <tr class="user-list__table-row">
                            <td class="user-list__table-heading">
                                <input type="checkbox" name="selected_users[]" value="{{ $user->id }}">
                            </td>
                            <td class="user-list__table-cell">{{ $user->id }}</td>
                            <td class="user-list__table-cell">{{ $user->name }}</td>
                            <td class="user-list__table-cell">{{ $user->email }}</td>
                            <td class="user-list__table-cell">{{ $user->password }}</td>
                            <td class="user-list__table-cell">{{ $user->created_at }}</td>
                            <td class="user-list__table-cell">
                                @foreach($user->roles as $role)
                                    {{ $role->name }}
                                @endforeach
                            </td>
                            <td class="user-list__table-cell">
                                <form action="{{ route('admin.user.assignRole', $user->id) }}" method="post">
                                    @csrf
                                    <div>
                                        <select name="role_id" class="user-list__select-role">
                                            <option></option>
                                            @foreach($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                                        <button class="user-list__button user-list__button--role-change">権限変更</button>
                                    </div>
                                </form>
                            </td>
                            <td class="user-list__table-cell">
                                <form action="{{ route('admin.user.delete') }}" method="post">
                                    @csrf
                                    <div class="user-list__button-container">
                                        <input type="hidden" name="id" value="{{ $user->id }}">
                                        <button class="user-list__button user-list__button--delete">削除</button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @error('selected_users')
                    <div class="error_message">
                        {{ $message }}
                    </div>
                @enderror
                <div class="user-list__button-container">
                    <button type="submit" class="user-list__button user-list__button--send">アナウンスメール送信</button>
                </div>
                @if(session('status'))
                    <p class="announcement-mail__status">{{ session('status') }}</p>
                @endif
            </form>
        </div>
    </div>
@endsection

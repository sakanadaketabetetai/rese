@extends('layouts.admin')

@section('css')

@endsection

@section('content')
    <div class="admin-users_content">
        <div class="admin-users_title">
            <h1>ユーザー一覧</h1>
        </div>
        <div class="admin-users_table">
            <table>
                <tr>
                    <th>ID</th>
                    <th>お名前</th>
                    <th>メールアドレス</th>
                    <th>パスワード</th>
                    <th>登録日</th>
                    <th>権限</th>
                    <th>権限変更</th>
                    <th>削除</th>
                </tr>
                @foreach( $users as $user )
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->password }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>
                        @foreach($user->roles as $role)
                            {{ $role->name }}
                        @endforeach
                    </td>
                    <td>
                        <form action="{{ route('admin.user.assignRole', $user->id) }}" method="post">
                            @csrf
                            <div>
                                <select name="role_id">
                                    <option></option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                <button>権限変更</button>
                            </div>
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('admin.user.delete') }}" method="post">
                            @csrf
                            <div class="admin-form_button">
                                <input type="hidden" name="id" value="{{ $user->id }}">
                                <button class="admin-form_button-submit">削除</button>
                            </div>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
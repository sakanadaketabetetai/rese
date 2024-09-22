@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin_announcement_create.css') }}">
@endsection

@section('content')
<div class="announcement-mail">
    <h1 class="announcement-mail__title">アナウンスメールの送信</h1>
    <form action="{{ route('admin.announcementMail.send') }}" method="post" class="announcement-mail__form">
        @csrf
        <div class="announcement-mail__form-group">
            <label for="users" class="announcement-mail__label">送信先</label>
            <div id="users" class="announcement-mail__users">
                @foreach($users as $user)
                    <input type="hidden" name="user_ids[]" value="{{ $user->id }}">
                    <span class="announcement-mail__user-name">{{ $user->name }}</span>
                @endforeach
            </div>
            @error('user_ids')
            <div class="error_message">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="announcement-mail__form-group">
            <label for="subject" class="announcement-mail__label">件名</label>
            <input type="text" name="subject" id="subject" class="announcement-mail__input" required>
        </div>
            @error('subject')
            <div class="error_message">
                {{ $message }}
            </div>
            @enderror
        <div class="announcement-mail__form-group">
            <label for="content" class="announcement-mail__label">内容</label>
            <textarea name="content" id="content" class="announcement-mail__textarea" rows="5"></textarea>
        </div>
            @error('content')
            <div class="error_message">
                {{ $message }}
            </div>
            @enderror
        <div class="announcement-mail__form-group">
            <button type="submit" class="announcement-mail__submit">送信</button>
        </div>
    </form>
</div>
@endsection

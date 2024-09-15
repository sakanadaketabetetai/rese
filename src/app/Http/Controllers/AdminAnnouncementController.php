<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\AnnouncementMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class AdminAnnouncementController extends Controller
{
    public function announcementMail_create(Request $request){
        //選択されたユーザーIDをリクエストから取得
        $user_ids = $request->input('selected_users');
        //ユーザーIDに基づいてユーザーを検索
        if($user_ids){ 
            $users = User::whereIn('id', $user_ids)->get();
        }

        //検索したユーザー情報をビューに渡す
        return view('admin.admin_announcement_create', compact('users'));
    }

    public function announcementMail_send(Request $request){
        $subject = $request->input('subject');
        $content = $request->input('content');
        $userIds = $request->input('user_ids');

        //全ユーザーにメールを送信
        if($userIds){
            //選択されたユーザーを取得
            $users = User::whereIn('id', $userIds)->get();
            //メール送信
            foreach( $users as $user){
                Mail::to($user->email)->send(new AnnouncementMail($subject, $content, $user));
            };
        };

        return redirect()->route('admin.users.index')->with('status', 'アナウンスメールを送信しました。');
    }
}

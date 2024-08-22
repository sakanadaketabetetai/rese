<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Store;
use App\Models\Favorite_store;
use App\Models\Reservation;

use Illuminate\Http\Request;

class ReservationController extends Controller
{
    //
    public function reservation_create(Request $request){
        $user_id = Auth::id();
        // dd($request->all());
        Reservation::create([
            'user_id' => $user_id,
            'store_id' => $request->store_id,
            'reservation_time' => $request->reservation_time,
            'reservation_day' => $request->reservation_day,
            'number_of_people' => $request->reservation_number,
        ]);
        return view('done');
    }

    public function reservation_delete(Request $request){
        $reservation_id = $request->id;
        
        // 予約が存在するか確認
        $reservation = Reservation::find($reservation_id);
        
        if ($reservation) {
            // 予約が見つかれば削除
            $reservation->delete();
            return redirect('/')->with('success', '予約が正常に削除されました');
        } else {
            // 予約が見つからなければエラーメッセージを返す
            return redirect('/')->with('error', '予約が見つかりませんでした');
        }
    }

    public function back(){
        return redirect('/');
    }
}

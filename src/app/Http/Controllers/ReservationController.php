<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Store;
use App\Models\Favorite_store;
use App\Models\Reservation;
use App\Models\User;
use App\Http\Requests\ReservationRequest;
use Carbon\Carbon;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

use Illuminate\Http\Request;

class ReservationController extends Controller
{
    //
    public function reservation_create(ReservationRequest $request){
        $user_id = Auth::id();
        Reservation::create([
            'user_id' => $user_id,
            'store_id' => $request->store_id,
            'reservation_time' => $request->reservation_time,
            'reservation_day' => $request->reservation_day,
            'number_of_people' => $request->number_of_people,
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
            return redirect('/mypage/' . Auth::id())->with('success', '予約が正常に削除されました');
        } else {
            // 予約が見つからなければエラーメッセージを返す
            return redirect('/')->with('error', '予約が見つかりませんでした'); 
        }
    }

    public function back(){
        return redirect('/');
    } 

    public function reservation_detail($id){
        $reservation = Reservation::find($id);
        $store = Store::find($reservation->store_id);

        //営業時間から30分毎のドロップダウンを作成
        $open_time = Carbon::parse($store->open_time);
        $close_time = Carbon::parse($store->close_time);
        $times = [];
        for ($time = $open_time; $time <= $close_time; $time->addMinute(30)){
            $times[] = $time->format('H:i');
        }
    
        $number_of_peoples = [];
        for($number_of_people = 1; $number_of_people <= $store->max_number_of_people; $number_of_people++){
            $number_of_peoples[] = $number_of_people;
        }
        return view('reservation_detail', compact(['reservation','store','times','number_of_peoples']));
    }

    public function reservation_update(Request $request) {
        $reservation = Reservation::find($request->id);  
        if ($reservation) {
            $reservation->reservation_day = $request->reservation_day;
            $reservation->reservation_time = $request->reservation_time;
            $reservation->number_of_people = $request->number_of_people;
            $reservation->save();
        }
        return redirect('/'); // Assuming 'index' is the route name
    }

    public function generateQrCode($id){
        //予約情報を取得
        $reservation = Reservation::find($id);
        $url = route('reservation_qrcode', ['id'=> $reservation->id]);
        //QRコードを生成
        $qrCode = QrCode::size(300)->generate($url);

        // ビューにQRコードを渡して表示
        return view('qrcode.reservation_qrcode', compact(['qrCode'])); 
    }
}

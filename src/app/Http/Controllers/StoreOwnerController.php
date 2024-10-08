<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Store_owner;
use App\Models\Store;
use App\Models\User;
use App\Models\Reservation;
use App\Http\Requests\StoreRequest;

class StoreOwnerController extends Controller
{
    public function store_owner(){
        return view('store_owner.store_owner_all');
    }

    public function store_info(){
        $user = Auth::user();
        $store_owner_ids = Store_owner::where('user_id',$user->id)->pluck('store_id')->toArray();
        $stores = Store::whereIn('id', $store_owner_ids)->get();

        $counter = 1;
        foreach ($stores as $store){
            //各店舗情報にナンバリング用カウンターを追加
            $store->numbering = $counter;
            $counter++; //カウンター用のインクリメント
        }

        return view('store_owner.store_owner_info', compact('stores'));
    } 

    public function store_info_input(){
        return view('store_owner.store_owner_info_create');
    }

    public function store_info_create(StoreRequest $request){
        Store::create([
            'store_name' => $request->store_name,
            'store_area' => $request->store_area,
            'store_genre' => $request->store_genre,
            'store_introduction' => $request->store_introduction,
            'image' => $request->image,
            'open_time' => $request->open_time,
            'close_time' => $request->close_time,
            'regular_holiday' => $request->regular_holiday,
            'max_number_of_people' => $request->max_number_of_people,
        ]);
        $create_store_id = Store::where('store_name', $request->store_name)->value('id');
        Store_owner::create([
            'user_id' => Auth::id(),
            'store_id' => $create_store_id,
        ]);

        return redirect()->route('store.info');
    }





    public function store_info_update(Request $request){
        $store = Store::find($request->store_id);
        if($request->store_name){
            $store->store_name = $request->store_name;
        }
        if($request->store_area){
            $store->store_area = $request->store_area;
        }
        if($request->store_genre){
            $store->store_genre = $request->store_area;
        }
        if($request->store_introduction){
            $store->store_introduction = $request->store_introduction;
        }
        if($request->open_time){
            $store->open_time = $request->open_time;
        }
        if($request->close_time){
            $store->close_time = $request->close_time;
        }
        if($request->regular_holiday){
            $store->regular_holiday = $request->regular_holiday;
        }
        if($request->max_number_of_people){
            $store->max_number_of_people = $request->max_number_of_people;
        }
        $store->save();
        return redirect()->route('store.info');
    }

        public function store_reservation() {
            $store_owner_id = Auth::id();
            
            // 複数の store_id を取得する場合は pluck を使用
            $store_ids = Store_owner::where('user_id', $store_owner_id)->pluck('store_id');
            
            // store_id が $store_ids に含まれる reservation をすべて取得
            $reservations = Reservation::whereIn('store_id', $store_ids)
                                       ->with('user') // リレーションで user 情報を一緒に取得
                                       ->get();
        
            // 各 reservation に user_name を追加
            foreach ($reservations as $reservation) {
                // リレーション経由で user_name を取得して格納
                $reservation->user_name = $reservation->user->name;
            }
            return view('store_owner.store_owner_reservation', compact('reservations'));
    }

    public function reservation_show($id){
        $reservation = Reservation::find($id);
        if(!$reservation){
            return redirect()->back()->with('error','予約が見つかりません');
        }
        return view('qrcode.reservation_show', compact('reservation'));
    }
       
        public function reservation_checkIn(Request $request){
            $reservation = Reservation::find($request->id);
            if(!$reservation){
                return redirect()->back()->with('error','予約が見つかりませんでした');
            }

            $reservation->status = '1';
            $reservation->save();
            return view('qrcode.reservation_checkin');
    }
}
    

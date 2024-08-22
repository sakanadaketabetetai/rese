<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Store;
use App\Models\Favorite_store;
use App\Models\Reservation;
use Carbon\Carbon;

class StoreController extends Controller
{
    public function thanks(){
        return view('thanks');
    }
    public function index(){
        $stores = store::all();
        return view('index',compact('stores'));
    }
    
    public function register_menu(){
        return view('register_menu');
    }

    public function login_menu(){
        return view('login_menu');
    }

    public function user_menu(){
        return view('user_menu');
    }

    public function search(Request $request)
    {
        // クエリビルダを使って検索条件を設定します
        $query = Store::query();
        // store_area が指定された場合
        if ($request->filled('store_area')) {
            $query->where('store_area', $request->input('store_area'));
        }
        // store_genre が指定された場合
        if ($request->filled('store_genre')) {
            $query->where('store_genre', $request->input('store_genre'));
        }
        // keyword が指定された場合
        if ($request->filled('keyword')) {
            $keyword = $request->input('keyword');
            $query->where(function($q) use ($keyword) {
                $q->where('store_name', 'LIKE', "%{$keyword}%")
                  ->orWhere('open_time', 'LIKE', "%{$keyword}%");
            });
        }
        // 検索結果を取得
        $stores = $query->get();

        // 検索結果をビューに渡す
        return view('index', compact('stores'));
    }

    public function favorite(Request $request){
        // リクエストメソッドをログに出力
        \Log::info('Request Method:', ['method' => $request->method()]);
        $user_id = Auth::id();
        $store_id = $request->input('store_id');
        //userのお気に入りリストからストアを取得
        $favorite = Favorite_store::where('user_id', $user_id)
                                   ->where('store_id', $store_id)
                                   ->first();
        if($favorite){
            //すでにお気に入りに追加されている場合は削除
            $favorite->delete();
        }else{
            Favorite_store::create([
                'store_id' => $store_id,
                'user_id' => $user_id,
                'store_score' => 1, //お気に入りを示すスコア
            ]);
        }
        return redirect('/');
    }
    
    public function store_detail($id){
        $store = Store::find($id);
        $open_time = Carbon::parse($store->open_time);
        $close_time = Carbon::parse($store->close_time);

        //営業時間からドロップダウンを作成(30分毎)
        $times = [];
        for ( $time = $open_time; $time <= $close_time; $time->addMinutes(30)){
            $times[] = $time->format('H:i');
        }

        $number_of_peoples = [];
        for ($number_of_people = 1; $number_of_people <= $store->max_number_of_people; $number_of_people++) {
            $number_of_peoples[] = $number_of_people;
        }
        
        return view('store_detail', compact(['store','times','number_of_peoples'])); 
    }

    public function mypage($id){
        $user = Auth::user();
        $reservations = Reservation::where('user_id', $id)->get();
        $favorite_store_ids = Favorite_store::where('user_id', $id)->pluck('store_id')->toArray();
        $stores = Store::whereIn('id', $favorite_store_ids)->get();
    
        // Storeをstore_idをキーにして配列に変換
        $storesById = $stores->keyBy('id');
    
        // 各予約に対応するstore_nameを割り当てる
        foreach ($reservations as $reservation) {
            if (isset($storesById[$reservation->store_id])) {
                $reservation->store_name = $storesById[$reservation->store_id]->store_name;
            }
        }
    
        return view('mypage', compact(['user', 'reservations', 'stores']));
    }
}


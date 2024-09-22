<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Store;
use App\Models\Favorite_store;
use App\Models\Reservation;
use App\Models\StoreReview;
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
            ]);
        }
        // クエリパラメータからリダイレクト先を判別
        $from = $request->from;  // デフォルトは'mypage'
        if ($from === 'index') {
            return redirect('/')->with('success', 'お気に入りが更新されました');
        } else {
            return redirect('/mypage/' . Auth::id())->with('success', 'お気に入りが更新されました');
        }
    }
    
    public function store_detail($id){
        $store = Store::find($id);
        $open_time = Carbon::parse($store->open_time);
        $close_time = Carbon::parse($store->close_time);
        $store_reviews = StoreReview::where('store_id', $store->id)->get();

        //営業時間からドロップダウンを作成(30分毎)
        $times = [];
        for ( $time = $open_time; $time <= $close_time; $time->addMinutes(30)){
            $times[] = $time->format('H:i');
        }
        //最大予約人数からドロップダウンを作成
        $number_of_peoples = [];
        for ($number_of_people = 1; $number_of_people <= $store->max_number_of_people; $number_of_people++) {
            $number_of_peoples[] = $number_of_people;
        }
        //stars(数値)と同じ数の★を取得し$store_reviews->starsに保存
        if($store_reviews){
            $stars_map = [
                1 => '★',
                2 => '★★',
                3 => '★★★',
                4 => '★★★★',
                5 => '★★★★★'
            ];
        
            foreach($store_reviews as $store_review){
                $store_review->stars = $stars_map[$store_review->stars] ?? $store_review->stars;
            }
        }
        
        return view('store_detail', compact(['store','times','number_of_peoples','store_reviews'])); 
    }

    public function mypage($id) {
        $user = Auth::user();
    
        // ユーザの予約を取得
        $reservations = Reservation::where('user_id', $id)
                                    ->where('status',0) //statusが予約中のものだけを取得
                                    ->get();
        
        // 予約の店舗情報を取得
        $reservation_store_ids = $reservations->pluck('store_id')->unique();
        $reservation_stores = Store::whereIn('id', $reservation_store_ids)->get();
        
        // お気に入り店舗を取得
        $favorite_store_ids = Favorite_store::where('user_id', $id)->pluck('store_id')->toArray();
        $favorite_stores = Store::whereIn('id', $favorite_store_ids)->get();
        
        // 予約した店舗をIDでマップ化
        $reservation_storesById = $reservation_stores->keyBy('id');
    
        // 予約ごとのstore_idに基づいてstore_nameとドロップダウンデータを割り当てる
        $counter = 1;
       
        foreach ($reservations as $reservation) {
            //各予約にナンバリング用カウンターを追加
            $reservation->numbering = $counter;
            $counter++; //カウンターをインクリメント
            
            if (isset($reservation_storesById[$reservation->store_id])) {
                $store = $reservation_storesById[$reservation->store_id];
                $reservation->store_name = $store->store_name;
    
                // 営業時間に基づいた30分間隔のドロップダウンを生成
                $times = [];
                $open_time = Carbon::parse($store->open_time);
                $close_time = Carbon::parse($store->close_time);
                for ($time = $open_time; $time <= $close_time; $time->addMinutes(30)) {
                    $times[] = $time->format('H:i');
                }
                $reservation->times = $times;  // 予約ごとにtimesを設定
    
                // 最大予約人数に基づいたドロップダウンを生成
                $number_of_peoples = [];
                for ($number_of_people = 1; $number_of_people <= $store->max_number_of_people; $number_of_people++) {
                    $number_of_peoples[] = $number_of_people;
                }
                $reservation->number_of_peoples = $number_of_peoples;  // 予約ごとにnumber_of_peoplesを設定
            }
        }
        
        return view('mypage', compact(['user', 'reservations', 'favorite_stores']));
    }

    

}



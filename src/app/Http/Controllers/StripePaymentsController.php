<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use Exception;
use App\Models\Reservation;
use App\Models\Store;

class StripePaymentsController extends Controller
{

    public function updateReservationAmount(Request $request, $reservationId){
        $reservation = Reservation::findOrFail($reservationId);
        $reservation->update([
            'amount' => $request->amount, //入力された金額
            'payment_status' => 'pending'//支払いがまだ完了していない
        ]);

        return redirect()->route('store.reservation')->with('success', '金額が更新されました。');
    }




    public function stripe_index($id){
        $reservation = Reservation::find($id);
        $store_name = Store::find($reservation->store_id)->value('store_name');
        return view('stripe.stripe', compact(['reservation','store_name']));
    }

    public function stripe_payment(Request $request)
    {
        try {
            // Stripe APIキーを設定
            Stripe::setApiKey(env('STRIPE_SECRET'));
    
            // Stripeトークンを取得
            $token = $request->input('stripeToken');
    
            // Stripe顧客を作成
            $customer = Customer::create([
                'email' => $request->user()->email,
                'source' => $token, // トークンを使って支払いソースを指定
            ]);
    
            // チャージを作成
            $charge = Charge::create([
                'customer' => $customer->id,
                'amount' => (int) $request->input('amount'), // 金額を整数に変換し、セントに変換
                'currency' => 'jpy', // 通貨(日本円)
            ]);
    
            return redirect()->route('stripe.complete');
        } catch (\Exception $e) {
            return back()->withErrors(['message' => '支払いに失敗しました: ' . $e->getMessage()]);
        }
    }
    

}

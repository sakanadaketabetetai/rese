<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\StoreReview;
use Illuminate\Http\Request;

class StoreReviewController extends Controller
{
    public function store_review(Request $request){
        $user_id = Auth::user()->id;
        $request->validate([
            'content' => 'required'
        ]);

        $store_review = new StoreReview();
        $store_review->content = $request->input('content');
        $store_review->store_id = $request->input('store_id');
        $store_review->user_id = $user_id;
        $store_review->stars = $request->stars;
        $store_review->save();

        return back();
    }
}

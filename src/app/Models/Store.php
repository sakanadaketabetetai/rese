<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Store extends Model
{
    use HasFactory;
    protected $fillable = [
        'store_name','store_area','store_genre','store_introduction',
        'image','open_time','close_time','regular_holiday','max_number_of_people'
    ];

    public function isFavorite(){
        return Favorite_store::where('user_id', Auth::id())
                              ->where('store_id', $this->id)
                              ->exists();
    }
}

<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Store;
use App\Models\Store_owner;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function admin_index(){
        return view('admin.admin_all');
    }

    public function admin_users(){
        $users = User::all();
        $roles = Role::all();
        return view('admin.admin_users', compact(['users','roles']));
    }
    public function admin_stores(){
        $stores = Store::all();
        return view('admin.admin_stores', compact('stores'));
    }

    public function admin_user_delete(Request $request){
        $store_owner = Store_owner::where('user_id',$request->id);
        if($store_owner){
            Store_owner::where('user_id',$request->id)->delete();
        }
        $user = User::find($request->id)->delete();
        return redirect()->route('admin.users.index');
    }

    public function admin_user_assignRole(Request $request){
        // リクエストからロールとユーザーを取得
        $roleToAdd = Role::find($request->role_id);
        $user = User::find($request->user_id);

        if ($roleToAdd && $user) {
            // 現在のロールを取得
            $currentRoles = $user->roles->pluck('id')->toArray();

            if ($roleToAdd && $user) {
                // ユーザーの現在のロールをすべて削除
                $user->roles()->detach();
                // 新しいロールを付与
                $user->assignRole($roleToAdd);
            }
        }
        return redirect()->route('admin.users.index')->with('success', 'ロールが更新されました');
    }

    public function admin_store_owners(){
        $stores = Store::all();
        return view('admin.admin_store_owners', compact('stores'));
    }

    public function admin_add_store_owner(Request $request){
        // Validator::make($request->all(), [
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|string|email|max:255|unique:users', // emailの重複を防ぐ
        //     'password' => 'required|string|min:8|confirmed',
        // ])->validate();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Store_owner::create([
            'user_id' => $user->id,
            'store_id' => $request->store_id
        ]);

        //$userにRole "store_owner"を付与
        $user->assignRole('store_owner');

        return redirect()->route('admin.users.index');
    }
}
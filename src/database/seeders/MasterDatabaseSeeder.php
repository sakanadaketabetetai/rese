<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Notifications\TestNotification;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class MasterDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //ユーザー作成
        $president = User::create([
            'name' => '社長',
            'email' => 'president@sample.com',
            'password' => Hash::make('president12345')
            ]);
            
        $user = User::create([
            'name' => '社員1',
            'email' => 'gest@sample.com',
            'password' => Hash::make('gest12345')
        ]);


        //権限作成
        $adminPermissions = [
            'manage-users',
            'manage-stores',
            'view-reports',
            'manage-permissions',
        ];
        
        $storeOwnerPermissions = [
            'manage-own-store',
            'manage-reservations',
            'view-reports',
        ];
        
        $userPermissions = [
            'view-store-info',
            'edit-own-reservation',
        ];
        foreach ($adminPermissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
        
        foreach ($storeOwnerPermissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
        
        foreach ($userPermissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // ロールの作成または取得
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $storeOwnerRole = Role::firstOrCreate(['name' => 'store_owner']);
        $userRole = Role::firstOrCreate(['name' => 'user']);

        // ロールにパーミッションを付与
        $adminRole->givePermissionTo(Permission::whereIn('name', $adminPermissions)->pluck('id'));
        $storeOwnerRole->givePermissionTo(Permission::whereIn('name', $storeOwnerPermissions)->pluck('id'));
        $userRole->givePermissionTo(Permission::whereIn('name', $userPermissions)->pluck('id'));

        // ユーザーにロールを割り当て
        $president->assignRole($adminRole);
        $user->assignRole($userRole);
    }
}

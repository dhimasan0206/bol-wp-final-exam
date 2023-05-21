<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Membership;
use App\Models\Customer;
use App\Models\ExchangeRate;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'EXCHANGE_RATE:MANAGE']);
        Permission::create(['name' => 'CUSTOMER:MANAGE']);
        Permission::create(['name' => 'MEMBERSHIP:MANAGE']);
        Permission::create(['name' => 'TRANSACTION:MANAGE']);

        Role::create(['name' => 'superadmin'])->givePermissionTo(Permission::all());
        Role::create(['name' => 'admin'])->givePermissionTo(['EXCHANGE_RATE:MANAGE', 'CUSTOMER:MANAGE', 'TRANSACTION:MANAGE']);

        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@laravel.com',
            'password' => Hash::make('superadmin1234'),
        ])->assignRole('superadmin');

        User::create([
            'name' => 'Admin',
            'email' => 'admin@laravel.com',
            'password' => Hash::make('admin1234'),
        ])->assignRole('admin');

        Membership::create([
            'name' => 'Bronze',
            'discount' => 0,
            'minimum_profit' => 0,
        ]);

        Membership::create([
            'name' => 'Silver',
            'discount' => 5,
            'minimum_profit' => 0,
        ]);

        Membership::create([
            'name' => 'Gold',
            'discount' => 10,
            'minimum_profit' => 0,
        ]);

        Customer::create([
            'name' => 'Bronze Customer',
            'membership_id' => 1,
        ]);

        Customer::create([
            'name' => 'Silver Customer',
            'membership_id' => 2,
        ]);

        Customer::create([
            'name' => 'Gold Customer',
            'membership_id' => 3,
        ]);

        ExchangeRate::create([
            'currency' => 'USD',
            'sell' => 15000,
            'buy' => 14000,
            'date' => date('Y-m-d H:i:s'),
        ]);

        ExchangeRate::create([
            'currency' => 'SGD',
            'sell' => 12000,
            'buy' => 11000,
            'date' => date('Y-m-d H:i:s'),
        ]);

        ExchangeRate::create([
            'currency' => 'AUD',
            'sell' => 10000,
            'buy' => 9000,
            'date' => date('Y-m-d H:i:s'),
        ]);
    }
}

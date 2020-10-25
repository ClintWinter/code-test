<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Users
        factory(\App\User::class)->create([
            'is_admin' => true,
            'is_subscribed' => true,
        ]);
        factory(\App\User::class)->create([
            'is_admin' => true,
            'is_subscribed' => false,
        ]);
        factory(\App\User::class)->create([
            'is_admin' => false,
            'is_subscribed' => true,
        ]);
        factory(\App\User::class)->create([
            'is_admin' => false,
            'is_subscribed' => false,
        ]);
        factory(\App\User::class)->create();

        // Products
        factory(\App\Product::class, 20)->create();
    }
}

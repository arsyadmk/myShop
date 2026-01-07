<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Store;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@myshop.com',
            // 'password' => Hash::make('1'),
            'password' => '$2y$12$gPpK9eHa6Z.if1UkHul0BeNuYar4T5RJpjzh4EzPuw2iofVHB0DVK',
            'role' => 0,
            'store_id' => null,
        ]);
        User::factory(10)->create();
        
        Store::factory(10)->create();
        Product::factory(1)->create();
    }
}

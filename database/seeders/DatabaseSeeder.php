<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

/**
 * Class DatabaseSeeder
 *
 * @package Database\Seeders
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        if (env('APP_ENV') === 'test') {
             User::factory(10)->create();

             return;
        }

        // For local env, for the purpose of testing the app manuall, create 3 records.
        if (env('APP_ENV') === 'local') {
            $users = [
                [
                    'name' => 'First-1 Last-1',
                    'email' => 'user-1@mailinator.com',
                    'email_verified_at' => now(),
                    'password' => 'Password_001', // password
                    'remember_token' => Str::random(10),
                ],
                [
                    'name' => 'First-2 Last-2',
                    'email' => 'user-2@mailinator.com',
                    'email_verified_at' => now(),
                    'password' => 'Password_002', // password
                    'remember_token' => Str::random(10),
                ],
                [
                    'name' => 'First-3 Last-3',
                    'email' => 'user-3@mailinator.com',
                    'email_verified_at' => now(),
                    'password' => 'Password_003', // password
                    'remember_token' => Str::random(10),
                ]
            ];

            User::factory()->createMany($users);
        }
    }
}

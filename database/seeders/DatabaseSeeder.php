<?php

declare(strict_types=1);

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Tweet;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
            ->has(Tweet::factory()->count(5))
            ->create([
                'name' => 'Samuel Mwangi',
                'username' => 'mwangi',
                'email' => 'mwangithegreat@gmail.com',
                'password' => Hash::make('super-secret-thingy'),
            ]);

        User::factory()
            ->has(Tweet::factory()->count(50))
            ->count(30)
            ->create();
    }
}

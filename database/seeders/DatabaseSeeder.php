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
    public function run(): void
    {
        $adminUser = User::factory()
            ->has(Tweet::factory()->count(5))
            ->create([
                'name' => 'Samuel Mwangi',
                'username' => 'mwangi',
                'email' => 'mwangithegreat@gmail.com',
                'password' => Hash::make('super-secret-thingy'),
            ]);

        $users = User::factory()
            ->has(Tweet::factory()->count(50))
            ->count(30)
            ->create();

        $users
            ->each(
                fn (User $user) => $user->followers()->attach(
                    $users->where('id', '!=', $user->id)->random(10)->pluck('id')
                )
            )->each(
                fn (User $user) => $user->following()->attach(
                    $users->where('id', '!=', $user->id)->random(10)->pluck('id')
                )
            );
        $adminUser
            ->followers()->attach(
                $users->where('id', '!=', $adminUser->id)->random(20)->pluck('id')
            );

        $adminUser->following()->attach(
            $users->where('id', '!=', $adminUser->id)->random(10)->pluck('id')
        );
    }
}

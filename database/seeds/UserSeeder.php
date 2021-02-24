<?php

use Illuminate\Database\Seeder;

use App\User;
use App\Models\Admin;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
     
        for($i=0;$i<100;$i++){            
            $user = User::create([
                "name" => $faker->name,
                "email" => $faker->unique()->safeEmail,
                "email_verified_at" => now(),
                "password"  => Hash::make('password'),
                "remember_token" => Str::random(10),
                "mobile"    => $faker->phoneNumber
            ]);

            $user->ips()->create(['ip' => $faker->ipv4]);
        }

        //create admin

        $user = Admin::create([
            "name" => 'Safi Khan',
            "email" => 'safifalak@gmail.com',
            "password"  => Hash::make('password'),
            "remember_token" => Str::random(10),
            "mobile"    => $faker->phoneNumber
        ]);
    }
}

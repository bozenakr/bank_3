<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        {
        DB::table('users')->insert([
            'name' => 'Bebras',
            'email' => 'bebras@gmail.com',
            'password' => Hash::make('123'),
            // 'role' => 'manager'
        ]);
        DB::table('users')->insert([
            'name' => 'Briedis',
            'email' => 'briedis@gmail.com',
            'password' => Hash::make('123'),
            // 'role' => 'admin'
        ]);
        DB::table('customers')->insert([
            'name' => 'Zita',
            'surname' => 'Zitaitė',
            'iban' => 'LT825300000056845624',
            'personal_id' => '48801146584',
            'balance' => rand(100,10000),
        ]);
        DB::table('customers')->insert([
            'name' => 'Petras',
            'surname' => 'Petraitis',
            'iban' => 'LT' . rand(40,60) . 35000 . rand(10000000000,99999999999),
            'personal_id' => '39501271685',
            'balance' => rand(100,100000),
        ]);
            DB::table('customers')->insert([
            'name' => 'Jonas',
            'surname' => 'Jonaitis',
            'iban' => 'LT' . rand(40,60) . 35000 . rand(10000000000,99999999999),
            'personal_id' => '38502141545',
            'balance' => rand(100,100000),
        ]);
            DB::table('customers')->insert([
            'name' => 'Ona',
            'surname' => 'Onaitė',
            'iban' => 'LT' . rand(40,60) . 35000 . rand(10000000000,99999999999),
            'personal_id' => '38502141545',
            'balance' => rand(100,100000),
        ]);
            DB::table('customers')->insert([
            'name' => 'Saulius',
            'surname' => 'Bebraitis',
            'iban' => 'LT' . rand(40,60) . 35000 . rand(10000000000,99999999999),
            'personal_id' => '38012120000',
            'balance' => 0.00,
        ]);
            DB::table('customers')->insert([
            'name' => 'Bebras',
            'surname' => 'Bebraitis',
            'iban' => 'LT' . rand(40,60) . 35000 . rand(10000000000,99999999999),
            'personal_id' => '38502141500',
            'balance' => rand(100,100000),
        ]);
            DB::table('customers')->insert([
            'name' => 'Antanas',
            'surname' => 'Bebraitis',
            'iban' => 'LT' . rand(40,60) . 35000 . rand(10000000000,99999999999),
            'personal_id' => '38502141599',
            'balance' => rand(100,100000),
        ]);
            DB::table('customers')->insert([
            'name' => 'Tomas',
            'surname' => 'Bebraitis',
            'iban' => 'LT' . rand(40,60) . 35000 . rand(10000000000,99999999999),
            'personal_id' => '37501211694',
            'balance' => 0.00,
        ]);
            DB::table('customers')->insert([
            'name' => 'Rasa',
            'surname' => 'Rasaitė',
            'iban' => 'LT' . rand(40,60) . 35000 . rand(10000000000,99999999999),
            'personal_id' => '49506125111',
            'balance' => rand(100,100000),
        ]);
            DB::table('customers')->insert([
            'name' => 'Markas',
            'surname' => 'Markaitis',
            'iban' => 'LT' . rand(40,60) . 35000 . rand(10000000000,99999999999),
            'personal_id' => '37012120007',
            'balance' => 0.00,
        ]);
            DB::table('customers')->insert([
            'name' => 'Bebras',
            'surname' => 'Bebraitis',
            'iban' => 'LT' . rand(40,60) . 35000 . rand(10000000000,99999999999),
            'personal_id' => '38702141588',
            'balance' => rand(100,100000),
        ]);
            DB::table('customers')->insert([
            'name' => 'Bebras',
            'surname' => 'Bebraitis',
            'iban' => 'LT' . rand(40,60) . 35000 . rand(10000000000,99999999999),
            'personal_id' => '37502141522',
            'balance' => rand(100,100000),
        ]);
            DB::table('customers')->insert([
            'name' => 'Tomas',
            'surname' => 'Tomaitis',
            'iban' => 'LT' . rand(40,60) . 35000 . rand(10000000000,99999999999),
            'personal_id' => '38001211003',
            'balance' => 0.00,
        ]);
    }
}
}
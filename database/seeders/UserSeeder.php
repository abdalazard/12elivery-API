<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        User::truncate();

        User::create([
            'name' => 'testerson',
            'password' => bcrypt('123123'),
        ]);

        Schema::enableForeignKeyConstraints();
    }
}

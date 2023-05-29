<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SuperAdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('super_admins')->insert([
            [
                'name' => 'Pham Thanh Nam',
                'email' => 'namt68065@gmail.com',
                'password' => bcrypt('Namvui123'),
            ],
        ]);
    }
}

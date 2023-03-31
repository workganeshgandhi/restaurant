<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Modules\Manager\Entities\Category;
use Modules\Manager\Entities\MainCategory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        DB::table('branches')->insert([
            'number' => 1,
            'tables' => 45,
            'address' => Str::random(10),
            'open_date' => date('y-m-d'),
        ]);
        DB::table('salaries')->insert([
            'name' => 'cashier',
            'mount' => 4500,
        ]);
        DB::table('cashiers')->insert([
            'name' => 'mohamed',
            'email' => 'm@m.m',
            'address' => Str::random(10),
            'mobile' => '1279783447',
            'national_id' => '12345678912345',
            'salary_id' => 1,
            'branch_id' => 1,
            'join_date' => date('y-m-d'),
            'password' => Hash::make('123456789'),
        ]);
        DB::table('delivery_boys')->insert([
            'name' => 'delivery Mo ',
            'address' => Str::random(10),
            'mobile' => '1279783447',
            'national_id' => '12345678912345',
            'salary_id' => 1,
            'branch_id' => 1,
            'join_date' => date('y-m-d'),
        ]);
        DB::table('offers')->insert([
            'name' => 'new year',
            'code' => 'ABC',
            'discount' => 45,
            'percentage' => 0,
            'start_at' => date('y-m-d'),
            'end_at' => date('y-m-d'),
            'active' => 1,
        ]);

        $main_data = [
            'en' => [
                'name'       => 'main 1',
            ],
            'ar' => [
                'name'       => 'رئيسى 1',
            ],

        ];
        $main = MainCategory::create($main_data);
        $cat_data = [
            'en' => [
                'name'       => 'cat 1',
            ],
            'ar' => [
                'name'       => 'منتج 1',
            ],
            'main_category_id' => 1,
            'price' => 25.5,
        ];
        $cat = Category::create($cat_data);
    }
}

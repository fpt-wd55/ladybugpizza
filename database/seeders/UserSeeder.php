<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        // create roles
        DB::table('roles')->insert([
            [
                'name' => 'admin',
                'parent_id' => null,
                'created_at' => $faker->dateTimeThisYear(),
                'updated_at' => $faker->dateTimeThisYear(),
            ],
            [
                'name' => 'user',
                'parent_id' => null,
                'created_at' => $faker->dateTimeThisYear(),
                'updated_at' => $faker->dateTimeThisYear(),
            ],
            [
                'name' => 'super_admin',
                'parent_id' => 1,
                'created_at' => $faker->dateTimeThisYear(),
                'updated_at' => $faker->dateTimeThisYear(),
            ],
            [
                'name' => 'admin_chat',
                'parent_id' => 1,
                'created_at' => $faker->dateTimeThisYear(),
                'updated_at' => $faker->dateTimeThisYear(),
            ],
        ]);

        // create users
        // admin
        DB::table('users')->insert([
            [
                'username' => 'quandohong28',
                'role_id' => 3,
                'avatar' => 'admin-profile.jpg',
                'email' => 'quandohong28@gmail.com',
                'fullname' => 'Đỗ Hồng Quân',
                'phone' => '0362303364',
                'password' => bcrypt('quandohong28@gmail.com'),
                'google_id' => null,
                'date_of_birth' => '2004-04-28',
                'gender' => 1,
                'status' => 1,
                'created_at' => $faker->dateTimeThisYear(),
                'updated_at' => $faker->dateTimeThisYear(),
            ],
            [
                'username' => 'blackwhilee04',
                'role_id' => 3,
                'avatar' => 'admin-profile.jpg',
                'email' => 'blackwhilee04@gmail.com',
                'fullname' => 'Lê Văn Thành',
                'phone' => '0382606012',
                'password' => bcrypt('blackwhilee04@gmail.com'),
                'google_id' => null,
                'date_of_birth' => '2004-07-13',
                'gender' => 1,
                'status' => 1,
                'created_at' => $faker->dateTimeThisYear(),
                'updated_at' => $faker->dateTimeThisYear(),
            ],
            [
                'username' => 'duynguyenhuu2004',
                'role_id' => 3,
                'avatar' => 'admin-profile.jpg',
                'email' => 'duynguyenhuu2004@gmail.com',
                'fullname' => 'Nguyễn Hữu Duy',
                'phone' => '0372881768',
                'password' => bcrypt('duynguyenhuu2004@gmail.com'),
                'google_id' => null,
                'date_of_birth' => '2004-05-20',
                'gender' => 1,
                'status' => 1,
                'created_at' => $faker->dateTimeThisYear(),
                'updated_at' => $faker->dateTimeThisYear(),
            ],
            [
                'username' => 'trantrunghieu422',
                'role_id' => 3,
                'avatar' => 'admin-profile.jpg',
                'email' => 'trantrunghieu422@gmail.com',
                'fullname' => 'Trần Chung Hiếu',
                'phone' => '0326239019',
                'password' => bcrypt('Hieucoi1qaz@'),
                'google_id' => null,
                'date_of_birth' => '2004-04-22',
                'gender' => 1,
                'status' => 1,
                'created_at' => $faker->dateTimeThisYear(),
                'updated_at' => $faker->dateTimeThisYear(),
            ],
            [
                'username' => 'vohuutuan04',
                'role_id' => 3,
                'avatar' => 'admin-profile.jpg',
                'email' => 'vohuutuan04@gmail.com',
                'fullname' => 'Võ Hữu Tuấn',
                'phone' => '0799123089',
                'password' => bcrypt('vohuutuan04@gmail.com'),
                'google_id' => null,
                'date_of_birth' => '2004-04-04',
                'gender' => 1,
                'status' => 1,
                'created_at' => $faker->dateTimeThisYear(),
                'updated_at' => $faker->dateTimeThisYear(),
            ],
            [
                'username' => 'nguynhuyen111',
                'role_id' => 3,
                'avatar' => 'admin-profile.jpg',
                'email' => 'nguynhuyen111@gmail.com',
                'fullname' => 'Nguyễn Thị Huyền',
                'phone' => '0982381200',
                'password' => bcrypt('nguynhuyen111@gmail.com'),
                'google_id' => null,
                'date_of_birth' => '2004-11-11',
                'gender' => 2,
                'status' => 1,
                'created_at' => $faker->dateTimeThisYear(),
                'updated_at' => $faker->dateTimeThisYear(),
            ],
            [
                'username' => 'tranthihaaaa9423',
                'role_id' => 3,
                'avatar' => 'admin-profile.jpg',
                'email' => 'tranthihaaaa9423@gmail.com',
                'fullname' => 'Trần Thị Hà',
                'phone' => '0395730904',
                'password' => bcrypt('tranthihaaaa9423@gmail.com'),
                'google_id' => null,
                'date_of_birth' => '2004-07-13',
                'gender' => 2,
                'status' => 1,
                'created_at' => $faker->dateTimeThisYear(),
                'updated_at' => $faker->dateTimeThisYear(),
            ],
        ]);
        // user
        for ($i = 0; $i <= 50; $i++) {
            DB::table('users')->insert([
                'username' => $faker->userName,
                'role_id' => 2,
                'avatar' => 'user-profile.jpg',
                'email' => $faker->email,
                'fullname' => $faker->name,
                'phone' => $faker->phoneNumber,
                'password' => bcrypt('password'),
                'google_id' => null,
                'date_of_birth' => $faker->date,
                'gender' => $faker->numberBetween(1, 3),
                'status' => $faker->numberBetween(1, 2),
                'created_at' => $faker->dateTimeThisYear(),
                'updated_at' => $faker->dateTimeThisYear(),
            ]);
        }

        // create addresses
        $users = DB::table('users')->get();
        foreach ($users as $user) {
            DB::table('addresses')->insert([
                'user_id' => $user->id,
                'title' => $faker->name,
                'phone' => $user->phone,
                'province' => $faker->state,
                'district' => $faker->city,
                'ward' => $faker->city,
                'detail_address' => $faker->address,
                'lng' => $faker->longitude,
                'lat' => $faker->latitude,
                'is_default' => true,
                'created_at' => $faker->dateTimeThisYear(),
                'updated_at' => $faker->dateTimeThisYear(),
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\User;

use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('vi_VN');

        // Admin
        $dataAdmin = [
            [
                'username' => 'quandohong28',
                'email' => 'quandohong28@gmail.com',
                'fullname' => 'Đỗ Hồng Quân',
                'phone' => '0362303364',
                'password' => Hash::make('quandohong28@gmail.com'),
                'date_of_birth' => '2004-04-28',
                'gender' => 1,
            ],
            [
                'username' => 'lv.thanh137',
                'email' => 'lv.thanh137@gmail.com',
                'fullname' => 'Le Van Thanh',
                'phone' => '0382606012',
                'password' => Hash::make('lv.thanh137@gmail.com'),
                'date_of_birth' => '2004-07-13',
                'gender' => 1,
            ],
            [
                'username' => 'duynguyenhuu2004',
                'email' => 'duynguyenhuu2004@gmail.com',
                'fullname' => 'Nguyễn Hữu Duy',
                'phone' => '0372881768',
                'password' => Hash::make('duynguyenhuu2004@gmail.com'),
                'date_of_birth' => '2004-05-20',
                'gender' => 1,
            ],
            [
                'username' => 'trantrunghieu422',
                'email' => 'trantrunghieu422@gmail.com',
                'fullname' => 'Trần Chung Hiếu',
                'phone' => '0326239019',
                'password' => Hash::make('Hieucoi1qaz@'),
                'date_of_birth' => '2004-04-22',
                'gender' => 1,
            ],
            [
                'username' => 'vohuutuan04',
                'email' => 'vohuutuan04@gmail.com',
                'fullname' => 'Võ Hữu Tuấn',
                'phone' => '0799123089',
                'password' => Hash::make('vohuutuan04@gmail.com'),
                'date_of_birth' => '2004-04-04',
                'gender' => 1,
            ],
            [
                'username' => 'nguynhuyen111',
                'email' => 'nguynhuyen111@gmail.com',
                'fullname' => 'Nguyễn Thị Huyền',
                'phone' => '0982381200',
                'password' => Hash::make('nguynhuyen111@gmail.com'),
                'date_of_birth' => '2004-11-11',
                'gender' => 2,
            ],
            [
                'username' => 'tranthihaaaa9423',
                'email' => 'tranthihaaaa9423@gmail.com',
                'fullname' => 'Trần Thị Hà',
                'phone' => '0395730904',
                'password' => Hash::make('tranthihaaaa9423@gmail.com'),
                'date_of_birth' => '2004-07-13',
                'gender' => 2,
            ],
        ];
        foreach ($dataAdmin as $item) {
            User::create([
                'username' => $item['username'],
                'role_id' => 3,
                'email' => $item['email'],
                'fullname' => $item['fullname'],
                'phone' => $item['phone'],
                'password' => Hash::make($item['email']),
                'google_id' => null,
                'avatar' => 'admin-default.png',
                'date_of_birth' => $item['date_of_birth'],
                'gender' => $item['gender'],
                'status' => 1,
            ]);
        }

        // Client
        for ($i = 0; $i < 50; $i++) {
            $email = $faker->unique()->email;
            $phone = $faker->unique()->phoneNumber;

            // Tạo người dùng 
            User::create([
                'username' => $faker->unique()->userName,
                'role_id' => 2,
                'email' => $email,
                'fullname' => $faker->name,
                'phone' => $phone,
                'password' => Hash::make('password'),
                'google_id' => null,
                'avatar' => 'user-default-' . rand(1, 20) . '.png',
                'date_of_birth' => $faker->date(),
                'gender' => rand(1, 3),
                'status' => 1,
            ]);
        }
    }
}

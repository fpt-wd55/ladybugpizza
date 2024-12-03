<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\User;
use App\Models\Address;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Vanthao03596\HCVN\Models\Province;
use Vanthao03596\HCVN\Models\District;
use Vanthao03596\HCVN\Models\Ward;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        // Get data
        $province = Province::find(1);
        $districts = $province->districts;
        // Admin
        $data = [
            [
                'username' => 'quandohong28',
                'role_id' => 3,
                'email' => 'quandohong28@gmail.com',
                'fullname' => 'Đỗ Hồng Quân',
                'phone' => '0362303364',
                'password' => Hash::make('quandohong28@gmail.com'),
                'google_id' => null,
                'avatar' => 'admin-default.png',
                'date_of_birth' => '2004-04-28',
                'gender' => 1,
                'status' => 1,
            ],
            [
                'username' => 'lv.thanh137',
                'role_id' => 3,
                'email' => 'lv.thanh137@gmail.com',
                'fullname' => 'Le Van Thanh',
                'phone' => '0382606012',
                'password' => Hash::make('lv.thanh137@gmail.com'),
                'google_id' => null,
                'avatar' => 'admin-default.png',
                'date_of_birth' => '2004-07-13',
                'gender' => 1,
                'status' => 1,
            ],
            [
                'username' => 'duynguyenhuu2004',
                'role_id' => 3,
                'email' => 'duynguyenhuu2004@gmail.com',
                'fullname' => 'Nguyễn Hữu Duy',
                'phone' => '0372881768',
                'password' => Hash::make('duynguyenhuu2004@gmail.com'),
                'google_id' => null,
                'avatar' => 'admin-default.png',
                'date_of_birth' => '2004-05-20',
                'gender' => 1,
                'status' => 1,
            ],
            [
                'username' => 'trantrunghieu422',
                'role_id' => 3,
                'email' => 'trantrunghieu422@gmail.com',
                'fullname' => 'Trần Chung Hiếu',
                'phone' => '0326239019',
                'password' => Hash::make('Hieucoi1qaz@'),
                'google_id' => null,
                'avatar' => 'admin-default.png',
                'date_of_birth' => '2004-04-22',
                'gender' => 1,
                'status' => 1,
            ],
            [
                'username' => 'vohuutuan04',
                'role_id' => 3,
                'email' => 'vohuutuan04@gmail.com',
                'fullname' => 'Võ Hữu Tuấn',
                'phone' => '0799123089',
                'password' => Hash::make('vohuutuan04@gmail.com'),
                'google_id' => null,
                'avatar' => 'admin-default.png',
                'date_of_birth' => '2004-04-04',
                'gender' => 1,
                'status' => 1,
            ],
            [
                'username' => 'nguynhuyen111',
                'role_id' => 3,
                'email' => 'nguynhuyen111@gmail.com',
                'fullname' => 'Nguyễn Thị Huyền',
                'phone' => '0982381200',
                'password' => Hash::make('nguynhuyen111@gmail.com'),
                'google_id' => null,
                'avatar' => 'admin-default.png',
                'date_of_birth' => '2004-11-11',
                'gender' => 2,
                'status' => 1,
            ],
            [
                'username' => 'tranthihaaaa9423',
                'role_id' => 3,
                'email' => 'tranthihaaaa9423@gmail.com',
                'fullname' => 'Trần Thị Hà',
                'phone' => '0395730904',
                'password' => Hash::make('tranthihaaaa9423@gmail.com'),
                'google_id' => null,
                'avatar' => 'admin-default.png',
                'date_of_birth' => '2004-07-13',
                'gender' => 2,
                'status' => 1,
            ],
        ];
        foreach ($data as $item) {
            $user = User::create($item);
        }

        // Client
        for ($i = 0; $i < 50; $i++) {
            $data = [
                'username' => $faker->unique()->userName,
                'role_id' => 2,
                'email' => $faker->email,
                'fullname' => $faker->name,
                'phone' => $faker->phoneNumber,
                'password' => Hash::make('password'),
                'google_id' => null,
                'avatar' => 'user-default.png',
                'date_of_birth' => $faker->date,
                'gender' => rand(1, 3),
                'status' => 1,
            ];
            $user = User::create($data);

            $district = $districts->random();
            $ward = $district->wards->random();
            Address::create([
                'user_id' => $user->id,
                'title' => $faker->name,
                'province' => $province->code,
                'district' => $district->code,
                'ward'  => $ward->code,
                'detail_address' => $faker->address,
                'is_default' => true,
            ]);
        }
    }
}

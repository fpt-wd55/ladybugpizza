<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Vanthao03596\HCVN\Models\Province;
use Vanthao03596\HCVN\Models\District;
use Vanthao03596\HCVN\Models\Ward;
use App\Models\Address;
use Faker\Factory as Faker;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('vi_VN');

        $province = Province::find(1);
        $districts = $province->districts;
        $users = User::all();

        foreach ($users as $user) {
            $district = $districts->random();
            $ward = $district->wards->random();
            Address::create([
                'user_id' => $user->id,
                'title' => 'Địa chỉ mặc định',
                'province' => $province->code,
                'district' => $district->code,
                'ward'  => $ward->code,
                'detail_address' => $faker->streetAddress,
                'is_default' => true,
            ]);
        }
    }
}

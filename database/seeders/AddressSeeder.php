<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $now = Carbon::now();

        $users = User::all();

        $faker = Faker::create();

        $province = [
            'Thành phố Hồ Chí Minh' => [
                'Quận 1',
                'Quận 2',
                'Quận 3',
                'Quận 4',
                'Quận 5',
                'Quận 6',
                'Quận 7',
                'Quận 8',
                'Quận 9',
                'Quận 10',
                'Quận 11',
                'Quận 12',
                'Quận Bình Tân',
                'Quận Bình Thạnh',
                'Quận Gò Vấp',
                'Quận Phú Nhuận',
                'Quận Tân Bình',
                'Quận Tân Phú',
                'Quận Thủ Đức',
                'Huyện Bình Chánh',
                'Huyện Cần Giờ',
                'Huyện Củ Chi',
                'Huyện Hóc Môn',
                'Huyện Nhà Bè',
            ],
            'Hà Nội' => [
                'Quận Ba Đình',
                'Quận Hoàn Kiếm',
                'Quận Tây Hồ',
                'Quận Long Biên',
                'Quận Cầu Giấy',
                'Quận Đống Đa',
                'Quận Hai Bà Trưng',
                'Quận Hoàng Mai',
                'Quận Thanh Xuân',
                'Huyện Sóc Sơn',
                'Huyện Đông Anh',
                'Huyện Gia Lâm',
                'Huyện Thanh Trì',
                'Huyện Ba Vì',
                'Huyện Phúc Thọ',
                'Huyện Thạch Thất',
                'Huyện Quốc Oai',
                'Huyện Chương Mỹ',
                'Huyện Đan Phượng',
                'Huyện Hoài Đức',
                'Huyện Thanh Oai',
                'Huyện Mỹ Đức',
                'Huyện Ứng Hòa',
                'Huyện Thường Tín',
            ],
            'Đà Nẵng' => [
                'Quận Hải Châu',
                'Quận Thanh Khê',
                'Quận Sơn Trà',
                'Quận Ngũ Hành Sơn',
                'Quận Liên Chiểu',
                'Huyện Hòa Vang',
                'Huyện Hoàng Sa',
            ],
            'Hải Phòng' => [
                'Quận Hồng Bàng',
                'Quận Ngô Quyền',
                'Quận Lê Chân',
                'Quận Hải An',
                'Quận Kiến An',
                'Quận Đồ Sơn',
                'Huyện Thủy Nguyên',
                'Huyện An Dương',
                'Huyện An Lão',
                'Huyện Kiến Thuỵ',
                'Huyện Tiên Lãng',
                'Huyện Vĩnh Bảo',
                'Huyện Cát Hải',
            ],
            'Cần Thơ' => [
                'Quận Ninh Kiều',
                'Quận Bình Thủy',
                'Quận Cái Răng',
                'Quận Ô Môn',
                'Huyện Thốt Nốt',
                'Huyện Vĩnh Thạnh',
                'Huyện Cờ Đỏ',
                'Huyện Phong Điền',
                'Huyện Thới Lai',
            ],
            'An Giang' => [
                'Thành phố Long Xuyên',
                'Thành phố Châu Đốc',
                'Huyện An Phú',
                'Huyện Tân Châu',
                'Huyện Phú Tân',
                'Huyện Châu Phú',
                'Huyện Châu Thành',
                'Huyện Chợ Mới',
                'Huyện Thoại Sơn',
            ],
            'Bà Rịa - Vũng Tàu' => [
                'Thành phố Vũng Tàu',
                'Thành phố Bà Rịa',
                'Huyện Châu Đức',
                'Huyện Xuyên Mộc',
                'Huyện Long Điền',
                'Huyện Đất Đỏ',
                'Huyện Côn Đảo',
            ],
            'Bắc Giang' => [
                'Thành phố Bắc Giang',
                'Huyện Yên Thế',
                'Huyện Tân Yên',
                'Huyện Lạng Giang',
                'Huyện Lục Nam',
                'Huyện Lục Ngạn',
                'Huyện Sơn Động',
                'Huyện Yên Dũng',
                'Huyện Việt Yên',
                'Huyện Hiệp Hòa',
            ],
            'Bắc Kạn' => [
                'Thành phố Bắc Kạn',
                'Huyện Pác Nặm',
                'Huyện Ba Bể',
                'Huyện Ngân Sơn',
                'Huyện Chợ Đồn',
                'Huyện Bạch Thông',
                'Huyện Chợ Mới',
            ],
        ];

        foreach ($users as $user) {
            $user->addresses()->create([
                'title' => $faker->randomElement(['Nhà riêng', 'Công ty']),
                'province' => $faker->randomElement(array_keys($province)),
                'district' => $faker->randomElement($province[$faker->randomElement(array_keys($province))]),
                'ward' => $faker->city,
                'detail_address' => $faker->address,
                'is_default' => rand(0, 1),
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        // foreach ($users as $user) {
        //     Address::create([
        //         'user_id' => $user->id,
        //         'title' => $faker->randomElement(['Nhà riêng', 'Công ty']),
        //         'province' => $faker->state,
        //         'district' => $faker->city,
        //         'ward' => $faker->city,
        //         'detail_address' => $faker->address,
        //         'is_default' => true,
        //         'created_at' => $now,
        //         'updated_at' => $now,
        //     ]);
        // }
    }
}

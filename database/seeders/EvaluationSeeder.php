<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Evaluate;
use App\Models\Evaluation;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;

class EvaluationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        $faker = Faker::create();

        $products = Product::pluck('id')->toArray();
        $users = User::pluck('id')->toArray();

        $comments = [
            'Rất tốt! Tôi cảm thấy rất hài lòng với sản phẩm này, chất lượng tốt, giá cả hợp lý. Tôi sẽ tiếp tục ủng hộ cửa hàng.',
            'Tuyệt vời! Sản phẩm chất lượng, giá cả hợp lý, giao hàng nhanh chóng. Tôi rất hài lòng với sản phẩm này.',
            'Sản phẩm chất lượng! Tôi rất hài lòng với sản phẩm này, chất lượng tốt, giá cả hợp lý.',
            'Rất hài lòng! Sản phẩm chất lượng, giá cả hợp lý, giao hàng nhanh chóng. Tôi sẽ tiếp tục ủng hộ cửa hàng.',
            'Tốt! Sản phẩm chất lượng, giá cả hợp lý, giao hàng nhanh chóng. Tôi rất hài lòng với sản phẩm này.',
            'Không tốt! Sản phẩm không đúng như mô tả, chất lượng kém, giá cả không hợp lý. Tôi không hài lòng với sản phẩm này.',
            'Tệ! Sản phẩm không đúng như mô tả, chất lượng kém, giá cả không hợp lý. Tôi không hài lòng với sản phẩm này.',
            'Rất tệ! Sản phẩm không đúng như mô tả, chất lượng kém, giá cả không hợp lý. Tôi không hài lòng với sản phẩm này.',
            'Không hài lòng! Sản phẩm không đúng như mô tả, chất lượng kém, giá cả không hợp lý. Tôi không hài lòng với sản phẩm này.',
            'Tạm được! Sản phẩm chất lượng tạm ổn, giá cả hợp lý, giao hàng chậm. Tôi không hài lòng với sản phẩm này.',
            'Bình thường! Sản phẩm chất lượng tạm ổn, giá cả hợp lý, giao hàng chậm. Tôi không hài lòng với sản phẩm này.',
            'Chưa tốt! Sản phẩm chất lượng tạm ổn, giá cả hợp lý, giao hàng chậm. Tôi không hài lòng với sản phẩm này.',
            'Chưa hài lòng! Sản phẩm chất lượng tạm ổn, giá cả hợp lý, giao hàng chậm. Tôi không hài lòng với sản phẩm này.',
            'Chưa ổn! Sản phẩm chất lượng tạm ổn, giá cả hợp lý, giao hàng chậm. Tôi không hài lòng với sản phẩm này.',
            'Chưa tốt! Sản phẩm chất lượng tạm ổn, giá cả hợp lý, giao hàng chậm. Tôi không hài lòng với sản phẩm này.',
            'Chưa hài lòng! Sản phẩm chất lượng tạm ổn, giá cả hợp lý, giao hàng chậm. Tôi không hài lòng với sản phẩm này.',
        ];

        foreach ($products as $product) {
            for ($i = 0; $i < 3; $i++) {
                $user = $faker->randomElement($users);

                Evaluation::create([
                    'user_id' => $user,
                    'product_id' => $product,
                    'order_id' => rand(1, 100),
                    'rating' => rand(1, 5),
                    'comment' => $faker->randomElement($comments),
                    'status' => 1,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }
    }
}

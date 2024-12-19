<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Evaluate;
use App\Models\Evaluation;
use App\Models\Order;
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
        $faker = Faker::create('vi_VN');

        $products = Product::pluck('id')->toArray();
        $users = User::where('role_id', 2)->get();
        $orders = Order::all();

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

        foreach ($products as $productId) {
            for ($i = 0; $i <= 5; $i++) {
                $comment = $faker->randomElement($comments);

                Evaluation::insert([
                    'user_id' => $users->random()->id,
                    'product_id' => $productId,
                    'order_id' => $orders->random()->id,
                    'rating' => rand(3, 5),
                    'comment' => $comment,
                    'status' => 1,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);

                $product = Product::find($productId);
                $product->total_rating += 1;
                $product->avg_rating = $product->total_rating / $product->evaluations->count();
                $product->save();
            }
        }
    }
}

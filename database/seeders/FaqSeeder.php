<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'Điểm tích lũy là gì?',
                'answer' => 'Điểm tích lũy là một hệ thống thưởng mà khách hàng nhận được khi thực hiện giao dịch mua hàng. Điểm này có thể được sử dụng để đổi  voucher trong lần mua hàng tiếp theo.'
            ],
            [
                'question' => 'Làm thế nào để tôi có thể tích điểm?',
                'answer' => 'Bạn có thể tích điểm khi thực hiện giao dịch mua sắm tại cửa hàng hoặc trên trang web của chúng tôi. Mỗi đồng bạn chi tiêu sẽ được quy đổi thành điểm.'
            ],
            [
                'question' => 'Điểm tích lũy có hết hạn không?',
                'answer' => 'Điểm không hết hạn.'
            ],
            [
                'question' => 'Tôi có thể sử dụng điểm tích lũy như thế nào?',
                'answer' => 'Bạn có thể sử dụng điểm để đổi voucher tại cửa hàng  hoặc mua online của chúng tôi .'
            ],
            [
                'question' => 'Tôi có thể kiểm tra số điểm của mình ở đâu?',
                'answer' => 'Bạn có thể kiểm tra số điểm tích lũy của mình trong phần tài khoản trên trang web của chúng tôi.'
            ],
            [
                'question' => 'Tôi có thể chuyển điểm cho người khác không?',
                'answer' => 'Hiện tại, chương trình không cho phép chuyển nhượng điểm giữa các tài khoản.'
            ],
            [
                'question' => 'Chương trình tích điểm có thay đổi không?',
                'answer' => 'Có thể. Chúng tôi sẽ thông báo trước cho khách hàng về bất kỳ thay đổi nào trong chương trình tích điểm.'
            ],
            [
                'question' => 'Làm thế nào để biết điểm tích lũy của tôi đã được cập nhật chưa?',
                'answer' => 'Điểm tích lũy của bạn sẽ được cập nhật ngay lập tức sau khi giao dịch hoàn tất. Bạn có thể kiểm tra trong tài khoản của mình.'
            ],
            [
                'question' => 'Có cách nào để tôi có thể tăng tốc độ tích điểm không?',
                'answer' => 'Bạn có thể tăng tốc độ tích điểm bằng cách mua sắm nhiều bên chúng tôi.'
            ],
            [
                'question' => 'Tôi có thể lấy lại điểm đã sử dụng không?',
                'answer' => 'Một khi bạn đã sử dụng điểm để đổi voucher, điểm đó sẽ không được hoàn lại.'
            ]
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}

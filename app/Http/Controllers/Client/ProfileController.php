<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return view('clients.profile.index');
    }

    public function update(Request $request)
    {

    }

    public function postChangePassword(Request $request)
    {

    }

    public function membership()
    {
        $faqs = [
            [
            'question' => 'Điểm tích lũy là gì?',
            'answer' => 'Điểm tích lũy là một hệ thống thưởng mà khách hàng nhận được khi thực hiện giao dịch mua hàng. Điểm này có thể được sử dụng để đổi quà hoặc voucher trong tương lai.'
            ],
            ['question' => 'Làm thế nào để tôi có thể tích điểm?',
              'answer'=> 'Bạn có thể tích điểm khi thực hiện giao dịch mua sắm tại cửa hàng hoặc trên trang web của chúng tôi. Mỗi đồng bạn chi tiêu sẽ được quy đổi thành điểm.'
            ],
            ['question' => 'Điểm tích lũy có hết hạn không?',
              'answer'=> 'Vô hạn'
            ],
            ['question' => 'Điểm tích lũy có hết hạn không?',
              'answer'=> 'Điểm không hết hạn'
            ],
            ['question' => 'Tôi có thể sử dụng điểm tích lũy như thế nào?',
              'answer'=> 'ạn có thể sử dụng điểm để đổi voucher'
            ],
            ['question' => 'Tôi có thể sử dụng điểm tích lũy như thế nào?',
              'answer'=> 'Bạn có thể sử dụng điểm để đổi voucher'
            ],
            ['question' => 'Tôi có thể kiểm tra số điểm của mình ở đâu?',
              'answer'=> 'Bạn có thể kiểm tra số điểm tích lũy của mình trong phần tài khoản trên trang web của chúng tôi'
            ],
            ['question' => 'Tôi có thể kiểm tra số điểm của mình ở đâu?',
              'answer'=> 'Bạn có thể mua hàng nhiều để có nhiều điểm'
            ],
            ['question' => 'Tôi có thể chuyển điểm cho người khác không?',
              'answer'=> 'Hiện tại, chương trình không cho phép chuyển nhượng điểm giữa các tài khoản'
            ],
            ['question' => 'Chương trình tích điểm có thay đổi không?',
              'answer'=> 'Có thể. Chúng tôi sẽ thông báo trước cho khách hàng về bất kỳ thay đổi nào trong chương trình tích điểm.'
            ],
            [
            'question' => 'Làm thế nào để biết điểm tích lũy của tôi đã được cập nhật chưa?',
            'answer' => 'Điểm tích lũy của bạn sẽ được cập nhật ngay lập tức sau khi giao dịch hoàn tất. Bạn có thể kiểm tra trong tài khoản của mình.'
            ],
    ];
        return view('clients.profile.membership');
    }

    public function address()
    {
        return view('clients.profile.address');
    }

    public function settings()
    {
        return view('clients.profile.settings');
    }

    public function promotion()
    {
        return view('clients.profile.promotion');
    }

    public function updateLocation(Request $request)
    {

    }

    public function storeLocation(Request $request)
    {

    }

    public function destroyLocation(Request $request)
    {

    }
}

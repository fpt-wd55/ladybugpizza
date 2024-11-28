<?php

namespace App\Http\Controllers\Client;

use App\Models\User;
use App\Models\Order;
use App\Models\Invoice;
use App\Models\OrderItem;
use App\Models\OrderStatus;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\EvaluationRequest;
use App\Models\Evaluation;
use App\Models\EvaluationImage;
use App\Models\Membership;
use App\Models\MembershipRank;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $redirectHome = $this->checkUser();
        if ($redirectHome) {
            return $redirectHome;
        }
        $status = $request->get('tab');
        $userId = Auth::id();
        $orders = Order::when($status, function ($query, $status) {
            return $query->whereHas('orderStatus', function ($q) use ($status) {
                $q->where('slug', $status);
            });
        })
            ->where('user_id', $userId)
            ->orderByDesc('created_at')
            ->get();
        // đếm số lượng order trong tab
        $orderStatuses = OrderStatus::withCount(['orders' => function ($query) use ($userId) {
            $query->where('user_id', $userId);
        }])->get();

        $invoices = Invoice::all();
        return view('clients.order.index', [
            'orderStatuses' => $orderStatuses,
            'invoices' => $invoices,
            'orders' => $orders,
        ]);
    } 

    public function postCancel(Order $order, Request $request)
    {
        $order = Order::query()->findOrFail($order['id']);
        $reasons = [
            1 => 'Muốn thay đổi địa chỉ giao hàng',
            2 => 'Muốn nhập/thay đổi mã Voucher',
            3 => 'Muốn thay đổi sản phẩm trong đơn hàng (size, topping, số lượng,...)',
            4 => 'Thủ tục thanh toán quá rắc rối',
            5 => 'Tìm thấy giá rẻ hơn ở chỗ khác',
            6 => 'Đổi ý, không muốn mua nữa',
            7 => $request->input('reason'), // lý do khác
        ];
        if ($order) {
            $selectedReason = $request->input('canceled_reason');
            $order->canceled_reason = isset($reasons[$selectedReason]) ? $reasons[$selectedReason] : null;
            $order->order_status_id = 6;
            $order->canceled_at = now();
            $order->save();

            return redirect()->back()->with('success', 'Hủy đơn hàng thành công');
        }

        return redirect()->back()->with('error', 'Hủy đơn hàng thất bại');
    }

    public function evaluation(EvaluationRequest $request, Order $order)
    {
        $ratings = $request->input('ratings', []);
        $comments = $request->input('comments', []);

        $order = Order::findOrFail($order->id);
        $orderItems = $order->orderItems;
        $productIds = $orderItems->pluck('product_id')->toArray();
        $products = Product::whereIn('id', $productIds)->get();

        foreach ($products as $product) {
            if (array_key_exists($product->id, $ratings) && array_key_exists($product->id, $comments)) {
                $rating = $ratings[$product->id];
                $comment = $comments[$product->id];

                $evaluation = Evaluation::where('user_id', Auth::id())
                    ->where('product_id', $product->id)
                    ->where('order_id', $order->id)
                    ->first();

                if (!$evaluation) {
                    $data = [
                        'user_id' => Auth::id(),
                        'product_id' => $product->id,
                        'order_id' => $order->id,
                        'rating' => $rating,
                        'comment' => $comment,
                        'status' => 1,
                    ];

                    if (Evaluation::create($data)) {
                        // Xử lý cộng điểm
                        $membership = Membership::where('user_id', Auth::id())->first();
                        $membership->points = $membership->points + 50;
                        $membership->total_spent = $membership->total_spent + 50;
                        // Cập nhật rank
                        $ranks = MembershipRank::all();
                        $currentRank = $this->updateRank($ranks, $membership->total_spent);
                        $membership->rank_id = $currentRank->id;
                        $membership->save();
                    }
                }
            }
        }

        return redirect()->back()->with('success', 'Đánh giá sản phẩm thành công');
    }
}

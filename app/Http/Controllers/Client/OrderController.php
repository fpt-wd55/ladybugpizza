<?php

namespace App\Http\Controllers\Client;

use App\Models\Order;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Topping;
use App\Models\OrderItem;
use App\Models\Evaluation;
use App\Models\Membership;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use App\Models\AttributeValue;
use App\Models\MembershipRank;
use App\Models\OrderItemTopping;
use App\Models\OrderItemAttribute;
use Vanthao03596\HCVN\Models\Ward;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Vanthao03596\HCVN\Models\District;
use Vanthao03596\HCVN\Models\Province;
use App\Http\Requests\EvaluationRequest;
use App\Http\Requests\CancelOrderRequest;
use Illuminate\Support\Facades\Validator;

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

        // get address order
        $orders->map(function ($order) {
            $order->province =  Province::find($order->address->province);
            $order->district = District::find($order->address->district);
            $order->ward = Ward::find($order->address->ward);
            return $order;
        });

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
        $validator = Validator::make($request->all(), [
            'canceled_reason' => 'required',
        ]);

        if ($validator->fails()) {
            // Xử lý khi validate thất bại
            return redirect()->back()->with('error', 'Bạn chưa chọn lý do hủy đơn hàng!');
        }

        $order = Order::query()->findOrFail($order['id']);

        if ($order->orderStatus->id != 1 || isset($order)) {
            return redirect()->back()->with('error', 'Đơn hàng đã xác nhận không thể hủy');
        }

        $orderItems = OrderItem::where('order_id', $order->id)->get();
        foreach ($orderItems as $orderItem) {
            $orderItem->attributes = OrderItemAttribute::where('order_item_id', $orderItem->id)->get();
            $orderItem->toppings = OrderItemTopping::where('order_item_id', $orderItem->id)->get();
        }

        $reasons = [
            1 => 'Muốn thay đổi địa chỉ giao hàng',
            2 => 'Muốn nhập/thay đổi mã Voucher',
            3 => 'Muốn thay đổi sản phẩm trong đơn hàng (size, topping, số lượng,...)',
            4 => 'Thủ tục thanh toán quá rắc rối',
            5 => 'Tìm thấy giá rẻ hơn ở chỗ khác',
            6 => 'Đổi ý, không muốn mua nữa',
            7 => $request->input('reason'),
        ];
        $selectedReason = $request->input('canceled_reason');
        $order->canceled_reason = isset($reasons[$selectedReason]) ? $reasons[$selectedReason] : null;
        $order->order_status_id = 6;
        $order->canceled_at = now();
        $order->save();

        // Trả lại số lượng sản phẩm
        foreach ($orderItems as $orderItem) {
            if ($orderItem->attributes && count($orderItem->attributes) > 0) {
                foreach ($orderItem->attributes as $attribute) {
                    $attributeValue = AttributeValue::find($attribute->attribute_value_id);
                    $attributeValue->quantity += $orderItem->quantity;
                    $attributeValue->save();
                }
            } else {
                $product = Product::find($orderItem->product_id);
                $product->quantity += $orderItem->quantity;
                $product->save();
            }

            if ($orderItem->toppings && count($orderItem->toppings) > 0) {
                foreach ($orderItem->toppings as $topping) {
                    $topping = Topping::find($topping->topping_id);
                    $topping->quantity += $orderItem->quantity;
                    $topping->save();
                }
            }
        }

        return redirect()->back()->with('success', 'Hủy đơn hàng thành công');
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
                    Evaluation::create([
                        'user_id' => Auth::id(),
                        'product_id' => $product->id,
                        'order_id' => $order->id,
                        'rating' => $rating,
                        'comment' => $comment,
                        'status' => 1,
                    ]);
                }
            }
        }
        // Xử lý cộng điểm
        $points = round((int)($order->amount + $order->shipping_fee - $order->discount_amount) / 1000);
        $membership = Membership::where('user_id', Auth::id())->first();
        $membership->points = $membership->points + $points;
        $membership->total_spent = $membership->total_spent + $points;
        // Cập nhật rank
        $ranks = MembershipRank::all();
        $currentRank = $this->updateRank($ranks, $membership->total_spent);
        $membership->rank_id = $currentRank->id;
        if ($membership->save()) {
            return redirect()->back()->with('success', 'Đánh giá sản phẩm thành công');
        }

        return redirect()->back()->with('error', 'Đánh giá sản phẩm thất bại');
    }
}

<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutRequest;
use App\Mail\Order as MailOrder;
use App\Models\Address;
use App\Models\AttributeValue;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\CartItemAttribute;
use App\Models\CartItemTopping;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderItemAttribute;
use App\Models\OrderItemTopping;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\Promotion;
use App\Models\PromotionUser;
use App\Models\Topping;
use App\Models\UserSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Vanthao03596\HCVN\Models\Province;
use Vanthao03596\HCVN\Models\District;
use Vanthao03596\HCVN\Models\Ward;

class CheckoutController extends Controller
{
    private $vnp_TmnCode = 'AK72QHWH'; // Mã Website
    private $vnp_HashSecret = 'SDRMIJ3OV1WDCATPVIMOVDA4LB7S1IQF';

    public function checkout()
    {
        if (session('promotion')) {
            session()->forget('promotion');
        }
        $cart = Cart::where('user_id', Auth::id())->first();

        if ($cart) {
            $cartController = new CartController();
            $cartController->updateCart($cart);
        }

        if ($cart) {
            $cartItems = CartItem::where('cart_id', $cart->id)->get();
        } else {
            $cartItems = collect();
        }

        foreach ($cartItems as $cartItem) {
            $cartItem->attributes = CartItemAttribute::where('cart_item_id', $cartItem->id)->get();
            $cartItem->toppings = CartItemTopping::where('cart_item_id', $cartItem->id)->get();
        }

        $addresses = Auth::user()->addresses;
        $paymentMethods = PaymentMethod::all();

        return view('clients.cart.checkout', [
            'cart' => $cart,
            'cartItems' => $cartItems,
            'addresses' => $addresses,
            'paymentMethods' => $paymentMethods,
        ]);
    }

    public function postCheckout(CheckoutRequest $request)
    {
        $cart = Cart::where('user_id', Auth::id())->first();

        // Kiểm tra địa chỉ
        if ($request->old_address == -1) {
            $address = Address::create([
                'user_id' => Auth::id(),
                'title' => 'Địa chỉ ' . Auth::user()->addresses->count() + 1,
                'province' => $request->province,
                'district' => $request->district,
                'ward' => $request->ward,
                'detail_address' => $request->detail_address,
                'is_default' => 0,
            ]);
        } else {
            $address = Address::find($request->old_address);

            // Kiểm tra địa chỉ cũ và địa chỉ mới có giống nhau không
            if ($address->province != $request->province || $address->district != $request->district || $address->ward != $request->ward || $address->detail_address != $request->detail_address) {
                $address = Address::create([
                    'user_id' => Auth::id(),
                    'title' => 'Địa chỉ gần đây' . Auth::user()->addresses->count() + 1,
                    'province' => $request->province,
                    'district' => $request->district,
                    'ward' => $request->ward,
                    'detail_address' => $request->detail_address,
                    'is_default' => 0,
                ]);
            }
        }

        // Kiem tra ma giam gia

        if (session('promotion')) {
            $promotion = Promotion::find(session('promotion')['id']);

            if (!$promotion || !$this->isValidPromotion($promotion) || ($promotion->quantity <= 0) || ($promotion->min_order_total > $cart->total)) {
                return redirect()->route('client.order.index')->with('error', 'Thanh toán đơn hàng thất bại');
                session()->forget('promotion');
            }

            if ($promotion->discount_type == 1) {
                $discount = $cart->total * $promotion->discount_value / 100;
            } else {
                $discount = $promotion->discount_value;
            }

            if ($promotion->max_discount && $discount > $promotion->max_discount) {
                $discount = $promotion->max_discount;
            }
        }

        $data = [
            'code' => 'LDB' . time(),
            'user_id' => Auth::id(),
            'promotion_id' => session('promotion') ? session('promotion')['id'] : null,
            'amount' => (int)$cart->total,
            'address_id' => $address->id,
            'order_status_id' => 1,
            'discount_amount' => session('promotion') ? (int)$discount : 0,
            'shipping_fee' => (int)30000,
            'notes' => $request->notes ?? null,
            'payment_method_id' => $request->payment_method_id,
            'canceled_at' => null,
            'cancelled_reason' => null,
            'fullname' => $request->fullname,
            'phone' => $request->phone,
            'email' => $request->email,
        ];

        // save data to session
        session()->put('orderData', $data);

        // Thanh toán
        if ($request->payment_method_id == 1) {
            /*// Start Momo
            $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
            $partnerCode = 'MOMOBKUN20180529';
            $accessKey = 'klm05TvNBzhg7h7j';
            $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';

            $orderInfo = "Thanh toán online qua MoMo";
            $amount = (int)($data['amount'] + $data['shipping_fee'] - $data['discount_amount']);
            $orderId = $data['code'];
            $redirectUrl = route('return_momo');
            $ipnUrl = route('return_momo');
            $extraData = "";

            $requestId = time() . "";
            $requestType = "payWithATM";
            //before sign HMAC SHA256 signature
            $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
            $signature = hash_hmac("sha256", $rawHash, $secretKey);
            $data = array(
                'partnerCode' => $partnerCode,
                'partnerName' => "Test",
                "storeId" => "MomoTestStore",
                'requestId' => $requestId,
                'amount' => $amount,
                'orderId' => $orderId,
                'orderInfo' => $orderInfo,
                'redirectUrl' => $redirectUrl,
                'ipnUrl' => $ipnUrl,
                'lang' => 'vi',
                'extraData' => $extraData,
                'requestType' => $requestType,
                'signature' => $signature
            );
            $result = $this->execPostRequest($endpoint, json_encode($data));
            $jsonResult = json_decode($result, true);  // decode json

            return redirect($jsonResult['payUrl']);
            //End Momo*/

            // get key from env
            $vnp_TmnCode = $this->vnp_TmnCode;
            $vnp_HashSecret = $this->vnp_HashSecret;
            $vnp_Url = 'https://sandbox.vnpayment.vn/paymentv2/vpcpay.html'; // URL thanh toán của VNPAY
            $vnp_ReturnUrl = route('return_vnpay'); // URL nhận kết quả trả về

            // Thông tin đơn hàng, thanh toán
            $vnp_TxnRef = $data['code'];
            $vnp_OrderInfo = 'Thanh toán đơn hàng ' . $data['code'];
            $vnp_Amount = $data['amount'] + $data['shipping_fee'] - $data['discount_amount'];
            $vnp_Locale = 'vn';
            $vnp_BankCode = 'NCB';  // Mã ngân hàng

            // Tạo input data để gửi sang VNPay server
            $inputData = array(
                "vnp_Version" => "2.1.0",
                "vnp_TmnCode" => $vnp_TmnCode,
                "vnp_Amount" => (int)$vnp_Amount * 100,
                "vnp_Command" => "pay",
                "vnp_CreateDate" => date('YmdHis'),
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => $request->ip(),
                "vnp_Locale" => $vnp_Locale,
                "vnp_OrderInfo" => $vnp_OrderInfo,
                "vnp_OrderType" => 'billpayment',
                "vnp_ReturnUrl" => $vnp_ReturnUrl,
                "vnp_TxnRef" => $vnp_TxnRef,
            );

            // Kiểm tra nếu mã ngân hàng đã được thiết lập và không rỗng
            if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                $inputData['vnp_BankCode'] = $vnp_BankCode;
            }

            // Kiểm tra nếu thông tin tỉnh/thành phố hóa đơn đã được thiết lập và không rỗng
            if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
                $inputData['vnp_Bill_State'] = $vnp_Bill_State; // Gán thông tin tỉnh/thành phố hóa đơn vào mảng dữ liệu input
            }

            ksort($inputData);

            $query = ""; // Biến lưu trữ chuỗi truy vấn (query string)
            $i = 0; // Biến đếm để kiểm tra lần đầu tiên
            $hashdata = ""; // Biến lưu trữ dữ liệu để tạo mã băm (hash data)

            // Duyệt qua từng phần tử trong mảng dữ liệu input
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    // Nếu không phải lần đầu tiên, thêm ký tự '&' trước mỗi cặp key=value
                    $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                } else {
                    // Nếu là lần đầu tiên, không thêm ký tự '&'
                    $hashdata .= urlencode($key) . "=" . urlencode($value);
                    $i = 1; // Đánh dấu đã qua lần đầu tiên
                }
                // Xây dựng chuỗi truy vấn
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }

            // Gán chuỗi truy vấn vào URL của VNPay
            $vnp_Url = $vnp_Url . "?" . $query;

            // Kiểm tra nếu chuỗi bí mật hash secret đã được thiết lập
            if (isset($vnp_HashSecret)) {
                // Tạo mã băm bảo mật (Secure Hash) bằng cách sử dụng thuật toán SHA-512 với hash secret
                $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
                // Thêm mã băm bảo mật vào URL để đảm bảo tính toàn vẹn của dữ liệu
                $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
            }

            return redirect($vnp_Url);
        } else {
            // Tạo đơn hàng
            $order = $this->createOrder(session('orderData'));
            // Gửi mail thông báo đặt hàng
            $this->sendPaymentConfirmationEmail($order);

            return redirect()->route('thank_you', $order->code);
        }
    }

    public function returnVnPay(Request $request)
    {
        $vnp_SecureHash = $request->vnp_SecureHash;
        $inputData = $request->all();

        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $hashData = "";
        foreach ($inputData as $key => $value) {
            $hashData .= urlencode($key) . "=" . urlencode($value) . '&';
        }
        $hashData = rtrim($hashData, '&');

        $secureHash = hash_hmac('sha512', $hashData, $this->vnp_HashSecret);

        if ($secureHash === $vnp_SecureHash) {
            if ($request->vnp_ResponseCode == '00') {
                // Tạo đơn hàng
                $order = $this->createOrder(session('orderData'));
                // Gửi mail thông báo đặt hàng
                $this->sendPaymentConfirmationEmail($order);

                return redirect()->route('thank_you', $order->code);
            } else {
                return redirect()->route('client.order.index')->with('error', 'Thanh toán đơn hàng thất bại');
            }
        } else {
            // Dữ liệu không hợp lệ
            return redirect()->route('client.order.index')->with('error', 'Dữ liệu không hợp lệ');
        }
    }

    private
    function isValidPromotion($promotion)
    {
        $check = PromotionUser::where('promotion_id', $promotion->id)->where('user_id', Auth::id())->first();

        return $check && $promotion->status == 1 && $promotion->start_date <= now() && $promotion->end_date >= now();
    }

    private
    function createOrder($orderData)
    {
        $order = Order::create($orderData);
        if ($order) {
            $cart = Cart::where('user_id', Auth::id())->first();
            $cartItems = CartItem::where('cart_id', $cart->id)->get();
            foreach ($cartItems as $cartItem) {
                $cartItem->attributes = CartItemAttribute::where('cart_item_id', $cartItem->id)->get();
                $cartItem->toppings = CartItemTopping::where('cart_item_id', $cartItem->id)->get();
            }

            foreach ($cartItems as $cartItem) {
                $orderItem = OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->price,
                ]);

                if ($cartItem->attributes && count($cartItem->attributes) > 0) {
                    foreach ($cartItem->attributes as $attribute) {
                        OrderItemAttribute::create([
                            'order_item_id' => $orderItem->id,
                            'attribute_value_id' => $attribute->attribute_value_id,
                        ]);

                        // Trừ số lượng thuộc tính
                        $attributeValue = AttributeValue::find($attribute->attribute_value_id);
                        $attributeValue->quantity -= $cartItem->quantity;
                        $attributeValue->save();
                    }
                } else {
                    // Trừ số lượng sản phẩm
                    $product = Product::find($cartItem->product_id);
                    $product->quantity -= $cartItem->quantity;
                    $product->save();
                }

                if ($cartItem->toppings && count($cartItem->toppings) > 0) {
                    foreach ($cartItem->toppings as $topping) {
                        OrderItemTopping::create([
                            'order_item_id' => $orderItem->id,
                            'topping_id' => $topping->topping_id,
                        ]);

                        // Trừ số lượng topping
                        $topping = Topping::find($topping->topping_id);
                        $topping->quantity -= $cartItem->quantity;
                        $topping->save();
                    }
                }
            }

            // Xóa sản phẩm khỏi giỏ hàng
            CartItem::where('cart_id', $cart->id)->delete();

            // Xóa mã giảm giá khỏi bảng promotion_users nếu tồn tại mã giảm giá
            if (session('promotion')) {
                $promotion = PromotionUser::where('promotion_id', session('promotion')['id'])->where('user_id', Auth::id())->first();
                if ($promotion) {
                    $promotion->delete();
                }
                session()->forget('promotion');
            }

            session()->forget('orderData');
        }

        return $order;
    }

    public
    function returnMomo(Request $request)
    {
        // Kiểm tra nếu yêu cầu đến từ IPN (callback server)
        if ($request->has('transId')) {
            $resultCode = $request->get('resultCode');

            // Xử lý dữ liệu nhận được từ MoMo
            if ($resultCode == 0) {
                // Tạo đơn hàng
                $order = $this->createOrder(session('orderData'));
                // Cập nhật trạng thái thanh toán của đơn hàng thành công
                $order->order_status_id = 1;
                $order->save();

                $this->sendPaymentConfirmationEmail($order);

                return redirect()->route('thank_you', $order->code);
            } else {
                return redirect()->route('client.order.index')->with('error', 'Thanh toán thất bại');
            }
        }

        return redirect()->route('client.order.index');
    }

    public
    function thankYou($order)
    {
        $order = Order::where('code', $order)->first();
        // Lấy thông tin địa chỉ
        $order->province = Province::find($order->address->province);
        $order->district = District::find($order->address->district);
        $order->ward = Ward::find($order->address->ward);

        return view('clients.cart.thank_you', [
            'order' => $order,
        ]);
    }

    private
    function sendPaymentConfirmationEmail($order)
    {
        $userSetting = UserSetting::where('user_id', $order->user_id)->first();
        dd($userSetting);
        if ($userSetting->email_order) {
            // Lấy thông tin địa chỉ
            $order->province = Province::find($order->address->province);
            $order->district = District::find($order->address->district);
            $order->ward = Ward::find($order->address->ward);
            $subject = 'Thông báo xác nhận đơn hàng #' . $order->code;
            Mail::to($order->email)->send(new MailOrder($order, $subject, 'mails.orders.waiting'));
        }
    }

    public
    function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        // Bỏ qua xác thực chứng chỉ SSL
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // Thực hiện yêu cầu POST
        $result = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        // Kiểm tra lỗi cURL và mã HTTP
        if ($result === false || $httpCode !== 200) {
            $error = curl_error($ch);
            curl_close($ch);
            error_log("Lỗi cURL: $error, Mã HTTP: $httpCode");
            return false;
        }

        // Đóng kết nối
        curl_close($ch);
        return $result;
    }
}

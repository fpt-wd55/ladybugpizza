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
use App\Models\Topping;
use App\Models\Transaction;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Vanthao03596\HCVN\Models\Province;
use Vanthao03596\HCVN\Models\District;
use Vanthao03596\HCVN\Models\Ward;

class CheckoutController extends Controller
{
    public function checkout()
    {
        $cart = Cart::where('user_id', Auth::id())->first();

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
        $cartItems = CartItem::where('cart_id', $cart->id)->get();
        foreach ($cartItems as $cartItem) {
            $cartItem->attributes = CartItemAttribute::where('cart_item_id', $cartItem->id)->get();
            $cartItem->toppings = CartItemTopping::where('cart_item_id', $cartItem->id)->get();
        }

        // Check address_id
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
                    'title' => 'Địa chỉ ' . Auth::user()->addresses->count() + 1,
                    'province' => $request->province,
                    'district' => $request->district,
                    'ward' => $request->ward,
                    'detail_address' => $request->detail_address,
                    'is_default' => 0,
                ]);
            }
        }

        $data = [
            'user_id' => Auth::id(),
            'promotion_id' => session('promotion') ? session('promotion')['id'] : null,
            'amount' => $cart->total,
            'address_id' => $address->id,
            'order_status_id' => 1,
            'discount_amount' => session('promotion') ? session('promotion')['discount'] : 0,
            'shipping_fee' => 30000,
            'notes' => $request->notes ?? null,
            'payment_method_id' => $request->payment_method_id,
            'canceled_at' => null,
            'canceled_reason' => null,
            'fullname' => $request->fullname,
            'phone' => $request->phone,
            'email' => $request->email,
        ];

        $order = Order::create($data);
        if ($order) {
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

            $cart->delete();
            session()->forget('promotion');

            // Create transaction
            $transaction_code = '';
            if ($request->payment_method_id == 1) {
                $transaction_code = 'MOMO_' . $order->id;
            } else if ($request->payment_method_id == 2) {
                $transaction_code = 'VNPAY_' . $order->id;
            } else {
                $transaction_code = 'COD_' . $order->id;
            }
            Transaction::create([
                'user_id' => Auth::id(),
                'order_id' => $order->id,
                'transaction_code' => $transaction_code,
                'transaction_date' => now(),
                'payment_method_id' => $order->payment_method_id,
                'amount' => $order->amount + $order->shipping_fee - $order->discount_amount,
                'status' => 1,
            ]);

            // Thanh toán
            if ($request->payment_method_id == 1) {
                $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
                $partnerCode = 'MOMOBKUN20180529';
                $accessKey = 'klm05TvNBzhg7h7j';
                $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';

                $orderInfo = "Thanh toán online qua MoMo";
                $amount = $order->amount + $order->shipping_fee - $order->discount_amount;
                $orderId = $order->id;
                $redirectUrl = route('thank_you');
                $ipnUrl = route('thank_you');
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
            } else if ($request->payment_method_id == 2) {
                // Lấy tổng số tiền cần thanh toán
                $total_amount = $order->amount + $order->shipping_fee - $order->discount_amount;

                $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
                $vnp_Returnurl = route('vnpay_return');
                $vnp_TmnCode = "K6CG97BJ"; //Mã website tại VNPAY 
                $vnp_HashSecret = "WVB1NO7WLF8BYLTDE4OO6A88CVKQ3NSX"; //Chuỗi bí mật

                $vnp_TxnRef = $order->id; //Mã đơn hàng.  
                $vnp_OrderInfo = 'Thanh toán đơn hàng' . $order->id;
                $vnp_OrderType = 'Ladybug Pizza';
                $vnp_Amount = $total_amount * 100;
                $vnp_Locale = 'VN';
                $vnp_BankCode = 'NCB';
                $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

                $inputData = array(
                    "vnp_Version" => "2.1.0",
                    "vnp_TmnCode" => $vnp_TmnCode,
                    "vnp_Amount" => $vnp_Amount,
                    "vnp_Command" => "pay",
                    "vnp_CreateDate" => date('YmdHis'),
                    "vnp_CurrCode" => "VND",
                    "vnp_IpAddr" => $vnp_IpAddr,
                    "vnp_Locale" => $vnp_Locale,
                    "vnp_OrderInfo" => $vnp_OrderInfo,
                    "vnp_OrderType" => $vnp_OrderType,
                    "vnp_ReturnUrl" => $vnp_Returnurl,
                    "vnp_TxnRef" => $vnp_TxnRef,

                );

                if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                    $inputData['vnp_BankCode'] = $vnp_BankCode;
                }
                if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
                    $inputData['vnp_Bill_State'] = $vnp_Bill_State;
                }

                ksort($inputData);
                $query = "";
                $i = 0;
                $hashdata = "";
                foreach ($inputData as $key => $value) {
                    if ($i == 1) {
                        $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                    } else {
                        $hashdata .= urlencode($key) . "=" . urlencode($value);
                        $i = 1;
                    }
                    $query .= urlencode($key) . "=" . urlencode($value) . '&';
                }

                $vnp_Url = $vnp_Url . "?" . $query;
                if (isset($vnp_HashSecret)) {
                    $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
                    $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
                }
                $returnData = array(
                    'code' => '00',
                    'message' => 'success',
                    'data' => $vnp_Url
                );
                return redirect($vnp_Url);
            } else {
                // Gửi mail thông báo đặt hàng 
                $this->sendPaymentConfirmationEmail($order);

                return view('clients.cart.thank_you', [
                    'order' => $order,
                ]);
            }
        } else {
            return redirect()->back()->with('error', 'Đặt hàng thất bại');
        }
    }

    private function sendPaymentConfirmationEmail($order)
    {
        // Lấy thông tin địa chỉ
        $order->province =  Province::find($order->address->province);
        $order->district = District::find($order->address->district);
        $order->ward = Ward::find($order->address->ward);

        // Gửi email xác nhận đặt hàng
        $data = [
            'order' => $order,
        ];

        Mail::to($order->email)->send(new MailOrder($data));
    }

    public function execPostRequest($url, $data)
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

    public function thankYou(Request $request)
    {
        // Kiểm tra nếu yêu cầu đến từ IPN (callback server)
        if ($request->has('transId')) {
            $transId = $request->get('transId');
            $orderId = $request->get('orderId');
            $message = $request->get('message');
            $resultCode = $request->get('resultCode');
            $order = Order::find($orderId);

            // Xử lý dữ liệu nhận được từ MoMo
            if ($resultCode == 0) {
                // Cập nhật trạng thái thanh toán của đơn hàng thành công
                $order->order_status_id = 2;
                $order->save();

                // Lấy thông tin địa chỉ
                $order->province =  Province::find($order->address->province);
                $order->district = District::find($order->address->district);
                $order->ward = Ward::find($order->address->ward);

                $this->sendPaymentConfirmationEmail($order);

                return view('clients.cart.thank_you', [
                    'order' => $order,
                ]);
            } else {
                $order->order_status_id = 6;
                $order->save();

                return redirect()->route('client.order.index')->with('error', 'Thanh toán thất bại');
            }
        }

        return redirect()->route('client.order.index');
    }

    public function vnpayReturn(Request $request)
    {
        // Kiểm tra xác thực phản hồi từ VNPAY (nếu cần)
        // Xử lý dữ liệu nhận được từ VNPAY
        $vnp_ResponseCode = $request->get('vnp_ResponseCode');
        $vnp_TxnRef = $request->get('vnp_TxnRef'); // Mã đơn hàng trong hệ thống
        $vnp_Amount = $request->get('vnp_Amount');

        // Tìm đơn hàng tương ứng trong cơ sở dữ liệu
        $order = Order::where('id', $vnp_TxnRef)->first();

        if (!$order) {
            return redirect()->route('client.order.index')->with('error', 'Đơn hàng không tồn tại');
        }

        if ($vnp_ResponseCode == '00') {
            $order->order_status_id = 2;
            $order->save();

            $this->sendPaymentConfirmationEmail($order);

            return view('clients.cart.thank_you', [
                'order' => $order,
            ]);
        } else {
            $order->order_status_id = 6;
            $order->save();

            return redirect()->route('client.order.index')->with('error', 'Thanh toán thất bại');
        }
    }
}

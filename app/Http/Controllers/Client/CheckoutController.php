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

        $data = [
            'code' => 'LDB' . time(),
            'user_id' => Auth::id(),
            'promotion_id' => session('promotion') ? session('promotion')['id'] : null,
            'amount' => (int)$cart->total,
            'address_id' => $address->id,
            'order_status_id' => 1,
            'discount_amount' => session('promotion') ? (int)session('promotion')['discount'] : (int)0,
            'shipping_fee' => (int)30000,
            'notes' => $request->notes ?? null,
            'payment_method_id' => $request->payment_method_id,
            'canceled_at' => null,
            'canceled_reason' => null,
            'fullname' => $request->fullname,
            'phone' => $request->phone,
            'email' => $request->email,
        ];

        // save data to session
        session()->put('orderData', $data);

        // Thanh toán
        if ($request->payment_method_id == 1) {
            $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
            $partnerCode = 'MOMOBKUN20180529';
            $accessKey = 'klm05TvNBzhg7h7j';
            $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';

            $orderInfo = "Thanh toán online qua MoMo";
            $amount = (int) ($data['amount'] + $data['shipping_fee'] - $data['discount_amount']);
            $orderId = $data['code'];
            // $amount = 10000;
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
        } else {
            // Tạo đơn hàng
            $order = $this->createOrder(session('orderData'));
            // Gửi mail thông báo đặt hàng 
            $this->sendPaymentConfirmationEmail($order);

            return view('clients.cart.thank_you', [
                'order' => $order,
            ]);
        }
    }

    private function createOrder($orderData)
    {
        $order = Order::create($orderData);
        if ($order) {
            $cart = Cart::where('user_id', Auth::id())->first();
            $cartItems = CartItem::where('cart_id', $cart->id)->get();
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
            session()->forget('orderData');
        }

        return $order;
    }

    public function thankYou(Request $request)
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

                // Lấy thông tin địa chỉ
                $order->province =  Province::find($order->address->province);
                $order->district = District::find($order->address->district);
                $order->ward = Ward::find($order->address->ward);

                $this->sendPaymentConfirmationEmail($order);

                return view('clients.cart.thank_you', [
                    'order' => $order,
                ]);
            } else {
                return redirect()->route('client.order.index')->with('error', 'Thanh toán thất bại');
            }
        }

        return redirect()->route('client.order.index');
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
}

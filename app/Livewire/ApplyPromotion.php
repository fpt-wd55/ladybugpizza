<?php

namespace App\Livewire;

use App\Models\Cart;
use App\Models\Promotion;
use App\Models\PromotionUser;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ApplyPromotion extends Component
{
    public $cart;
    public $promotion_code;
    public $discount = 0;

    public function applyPromotion()
    {
        $this->validate([
            'promotion_code' => 'required|string',
        ], [
            'promotion_code.required' => 'Vui lòng nhập mã giảm giá',
            'promotion_code.string' => 'Mã giảm giá không hợp lệ',
        ]);

        $promotion = Promotion::where('code', $this->promotion_code)->first();

        if (!$promotion || !$this->isValidPromotion($promotion)) {
            session()->flash('promotion_code', 'Mã giảm giá không hợp lệ');
            return;
        }

        if ($promotion->quantity <= 0) {
            session()->flash('promotion_code', 'Mã giảm giá đã hết lượt sử dụng');
            return;
        }

        // Check min order total
        if ($promotion->min_order_total > $this->cart->total) {
            session()->flash('promotion_code', 'Đơn hàng của bạn chưa đạt giá trị tối thiểu để sử dụng mã giảm giá');
            return;
        }

        $this->applyDiscount($promotion);
    }

    private function isValidPromotion($promotion)
    {
        $check = PromotionUser::where('promotion_id', $promotion->id)->where('user_id', Auth::id())->first();

        return $check && $promotion->status == 1 && $promotion->start_date <= now() && $promotion->end_date >= now();
    }

    private function applyDiscount($promotion)
    {
        if ($promotion->discount_type == 1) {
            $this->discount = $this->cart->total * $promotion->discount_value / 100;
        } else {
            $this->discount = $promotion->discount_value;
        }

        if ($promotion->max_discount && $this->discount > $promotion->max_discount) {
            $this->discount = $promotion->max_discount;
        }

        // save promotion to session
        session()->put('promotion', [
            'id' => $promotion->id,
        ]);
    }

    public function render()
    {
        $this->cart = Cart::where('user_id', Auth::id())->first();
        $shipping_fee = 30000;

        return view('livewire.apply-promotion', [
            'cart' => $this->cart,
            'shipping_fee' => $shipping_fee,
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // ── KROK 2: Zobraz formulár doručenia ──────────────────────────────────
    public function showDelivery()
    {
        $cartItems = $this->getCartItems();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        return view('checkout', [
            'old' => session('checkout_delivery', []),
        ]);
    }

    // ── KROK 2: Ulož adresu do session → krok 3 ───────────────────────────
    public function storeDelivery(Request $request)
    {
        $data = $request->validate([
            'delivery_type'    => 'required|in:delivery,store',
            'name_and_surname' => 'required|string|max:255',
            'street_name'      => 'required|string|max:255',
            'street_number'    => 'required|string|max:50',
            'city'             => 'required|string|max:255',
            'postal_code'      => 'required|string|max:20',
            'country'          => 'required|string|max:255',
            'email'            => 'required|email|max:255',
            'phone_number'     => 'required|string|max:30',
        ]);

        session(['checkout_delivery' => $data]);

        return redirect()->route('checkout.payment');
    }

    // ── KROK 3: Zobraz platbu + súhrn ─────────────────────────────────────
    public function showPayment()
    {
        if (!session('checkout_delivery')) {
            return redirect()->route('checkout.delivery');
        }

        $cartItems = $this->getCartItems();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index');
        }

        $total = $cartItems->sum(fn($i) => $i->price * $i->quantity);

        return view('payment', compact('cartItems', 'total'));
    }

    // ── KROK 3: Vytvor objednávku → krok 4 ────────────────────────────────
    public function placeOrder(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|string',
        ]);

        $delivery = session('checkout_delivery');

        if (!$delivery) {
            return redirect()->route('checkout.delivery');
        }

        $cartItems = $this->getCartItems();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index');
        }

        $total = $cartItems->sum(fn($i) => $i->price * $i->quantity);

        // 1. Vytvor objednávku
        $orderId = DB::table('orders')->insertGetId([
            'user_id'          => auth()->id(),
            'name_and_surname' => $delivery['name_and_surname'],
            'street_name'      => $delivery['street_name'],
            'street_number'    => $delivery['street_number'],
            'city'             => $delivery['city'],
            'postal_code'      => $delivery['postal_code'],
            'country'          => $delivery['country'],
            'email'            => $delivery['email'],
            'phone_number'     => $delivery['phone_number'],
            'total_price'      => $total,
            'status'           => 'pending',
            'created_at'       => now(),
            'updated_at'       => now(),
        ]);

        // 2. Vlož položky objednávky
        foreach ($cartItems as $item) {
            DB::table('order_items')->insert([
                'order_id'           => $orderId,
                'product_variant_id' => $item->variant_id,
                'quantity'           => $item->quantity,
                'price'              => $item->price,
                'created_at'         => now(),
                'updated_at'         => now(),
            ]);

            // Zníž sklad
            DB::table('product_variants')
                ->where('id', $item->variant_id)
                ->decrement('stock', $item->quantity);
        }

        // 3. Zmaž košík
        $cartId = $this->getCartId();
        DB::table('cart_items')->where('cart_id', $cartId)->delete();

        // 4. Vyčisti session
        session()->forget('checkout_delivery');

        return redirect()->route('checkout.confirmation', $orderId);
    }

    // ── KROK 4: Potvrdenie objednávky ─────────────────────────────────────
    public function confirmation($orderId)
    {
        $order = DB::table('orders')->where('id', $orderId)->first();
        abort_if(!$order, 404);

        // Bezpečnosť: len vlastné objednávky
        if (auth()->check() && $order->user_id && $order->user_id !== auth()->id()) {
            abort(403);
        }

        $orderItems = DB::table('order_items')
            ->join('product_variants', 'product_variants.id', '=', 'order_items.product_variant_id')
            ->join('products', 'products.id', '=', 'product_variants.product_id')
            ->where('order_items.order_id', $orderId)
            ->select(
                'products.name',
                'product_variants.color',
                'product_variants.size',
                'order_items.quantity',
                'order_items.price'
            )
            ->get();

        return view('confirmation', compact('order', 'orderItems'));
    }

    // ── Pomocné metódy ─────────────────────────────────────────────────────
    private function getCartId()
    {
        if (auth()->check()) {
            $cart = DB::table('carts')->where('user_id', auth()->id())->first();
            return $cart?->id;
        }

        $cart = DB::table('carts')
            ->where('session_id', session()->getId())
            ->whereNull('user_id')
            ->first();

        return $cart?->id;
    }

    private function getCartItems()
    {
        $cartId = $this->getCartId();

        if (!$cartId) return collect();

        return DB::table('cart_items')
            ->join('product_variants', 'product_variants.id', '=', 'cart_items.product_variant_id')
            ->join('products', 'products.id', '=', 'product_variants.product_id')
            ->where('cart_items.cart_id', $cartId)
            ->select(
                'product_variants.id as variant_id',
                'products.name',
                'product_variants.color',
                'product_variants.size',
                'product_variants.price',
                'cart_items.quantity'
            )
            ->get();
    }
}
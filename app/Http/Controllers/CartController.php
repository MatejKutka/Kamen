<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    private function getCartId()
    {
        if (auth()->check()) {
            $cart = DB::table('carts')->where('user_id', auth()->id())->first();

            if ($cart) return $cart->id;

            return DB::table('carts')->insertGetId([
                'user_id' => auth()->id(),
                'session_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $cart = DB::table('carts')
            ->where('session_id', session()->getId())
            ->whereNull('user_id')
            ->first();

        if ($cart) return $cart->id;

        return DB::table('carts')->insertGetId([
            'user_id' => null,
            'session_id' => session()->getId(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
    
    public function index()
    {
        $cartId = $this->getCartId();

        $cartItems = DB::table('cart_items')
            ->join('product_variants', 'product_variants.id', '=', 'cart_items.product_variant_id')
            ->join('products', 'products.id', '=', 'product_variants.product_id')
            ->leftJoin('product_images', function ($join) {
                $join->on('products.id', '=', 'product_images.product_id')
                    ->on('product_variants.color', '=', 'product_images.color')
                    ->where('product_images.is_main', true);
            })
            ->where('cart_items.cart_id', $cartId)
            ->select(
                'cart_items.id as cart_item_id',
                'cart_items.quantity',
                'product_variants.id as variant_id',
                'product_variants.color',
                'product_variants.size',
                'product_variants.price',
                'products.name',
                'products.description',
                'product_images.image_path'
            )
            ->get();
                        
            $total = $cartItems->sum(function ($item) {
                return $item->quantity * $item->price;
            });

            return view('cart', compact('cartItems', 'total'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'variant_id' => 'required|exists:product_variants,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $variant = DB::table('product_variants')
            ->where('id', $request->variant_id)
            ->first();

        if (!$variant) {
            return redirect()->back()->with('error', 'Product variant not found.');
        }

        if ($variant->stock < $request->quantity) {
            return redirect()->back()->with('error', 'Not enough stock available.');
        }

        $cartId = $this->getCartId();

        $item = DB::table('cart_items')
            ->where('cart_id', $cartId)
            ->where('product_variant_id', $request->variant_id)
            ->first();

        if ($item) {
            $newQuantity = $item->quantity + $request->quantity;

            if ($newQuantity > $variant->stock) {
                return redirect()->back()->with('error', 'Not enough stock available.');
            }

            DB::table('cart_items')->where('id', $item->id)->update([
                'quantity' => $newQuantity,
                'updated_at' => now(),
            ]);
        } else {
            DB::table('cart_items')->insert([
                'cart_id' => $cartId,
                'product_variant_id' => $request->variant_id,
                'quantity' => $request->quantity,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $item = DB::table('cart_items')
            ->where('id', $id)
            ->first();

        if (!$item) {
            return redirect()->back()->with('error', 'Cart item not found.');
        }

        $variant = DB::table('product_variants')
            ->where('id', $item->product_variant_id)
            ->first();

        if (!$variant) {
            return redirect()->back()->with('error', 'Product variant not found.');
        }

        if ($request->quantity > $variant->stock) {
            return redirect()->back()->with('error', 'Not enough stock available.');
        }

        DB::table('cart_items')
            ->where('id', $id)
            ->update([
                'quantity' => $request->quantity,
                'updated_at' => now(),
            ]);

        return redirect()->back();
    }

    public function remove($id)
    {
        DB::table('cart_items')
            ->where('id', $id)
            ->delete();

        return redirect()->back();
    }
}
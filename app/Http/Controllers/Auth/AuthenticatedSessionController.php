<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {   
        $oldSessionId = session()->getId();

        $request->authenticate();   

        $request->session()->regenerate();

        $this->mergeGuestCart($oldSessionId);

        return redirect()->intended(route('home', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    private function mergeGuestCart(string $oldSessionId): void
    {
        $guestCart = DB::table('carts')
            ->where('session_id', $oldSessionId)
            ->whereNull('user_id')
            ->first();

        if (!$guestCart || !auth()->check()) {
            return;
        }

        $userCart = DB::table('carts')
            ->where('user_id', auth()->id())
            ->first();

        if (!$userCart) {
            DB::table('carts')
                ->where('id', $guestCart->id)
                ->update([
                    'user_id' => auth()->id(),
                    'session_id' => null,
                    'updated_at' => now(),
                ]);

            return;
        }

        $guestItems = DB::table('cart_items')
            ->where('cart_id', $guestCart->id)
            ->get();

        foreach ($guestItems as $guestItem) {
            $existingItem = DB::table('cart_items')
                ->where('cart_id', $userCart->id)
                ->where('product_variant_id', $guestItem->product_variant_id)
                ->first();

            if ($existingItem) {
                DB::table('cart_items')
                    ->where('id', $existingItem->id)
                    ->update([
                        'quantity' => $existingItem->quantity + $guestItem->quantity,
                        'updated_at' => now(),
                    ]);
            } else {
                DB::table('cart_items')
                    ->where('id', $guestItem->id)
                    ->update([
                        'cart_id' => $userCart->id,
                        'updated_at' => now(),
                    ]);
            }
        }

        DB::table('carts')->where('id', $guestCart->id)->delete();
    }
}

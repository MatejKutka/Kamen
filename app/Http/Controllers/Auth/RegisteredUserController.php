<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $oldSessionId = session()->getId();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        $request->session()->regenerate();

        $this->mergeGuestCart($oldSessionId);

        return redirect(route('profile.edit', absolute: false));
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

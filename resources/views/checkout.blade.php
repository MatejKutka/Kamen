<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Checkout – Delivery</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    @vite([
        'resources/css/reset.css',
        'resources/css/newnav.css',
        'resources/css/cart1.css',
        'resources/css/footer.css'
    ])
</head>
<body>

@include('partials.nav')

<section class="cart-steps step-2">
    <div class="steps-line"></div>
    <div class="step"><a href="{{ route('cart.index') }}" class="step-circle step-link">1</a></div>
    <div class="step"><span class="step-circle">2</span></div>
    <div class="step"><span class="step-circle">3</span></div>
    <div class="step"><span class="step-circle">4</span></div>
</section>

<section class="checkout">
    <div class="delivery-box">

        @if($errors->any())
            <div style="background:#fff0f0;border:1px solid #f5c0c0;color:#d94040;padding:12px 16px;border-radius:10px;margin-bottom:16px;font-size:14px;">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('checkout.delivery.store') }}">
            @csrf

            <div class="delivery-toggle">
                <input type="radio" name="delivery_type" id="delivery" value="delivery"
                       {{ old('delivery_type', $old['delivery_type'] ?? 'delivery') === 'delivery' ? 'checked' : '' }}>
                <label for="delivery">Delivery</label>

                <input type="radio" name="delivery_type" id="store" value="store"
                       {{ old('delivery_type', $old['delivery_type'] ?? '') === 'store' ? 'checked' : '' }}>
                <label for="store">Order to store</label>
            </div>

            <div class="delivery-form">
                <label for="name_and_surname">Name and surname</label>
                <input type="text" id="name_and_surname" name="name_and_surname"
                       value="{{ old('name_and_surname', $old['name_and_surname'] ?? '') }}" required>

                <div class="row">
                    <div>
                        <label for="street_name">Street name</label>
                        <input type="text" id="street_name" name="street_name"
                               value="{{ old('street_name', $old['street_name'] ?? '') }}" required>
                    </div>
                    <div>
                        <label for="street_number">Street number</label>
                        <input type="text" id="street_number" name="street_number"
                               value="{{ old('street_number', $old['street_number'] ?? '') }}" required>
                    </div>
                </div>

                <div class="row">
                    <div>
                        <label for="city">City</label>
                        <input type="text" id="city" name="city"
                               value="{{ old('city', $old['city'] ?? '') }}" required>
                    </div>
                    <div>
                        <label for="postal_code">Postal code</label>
                        <input type="text" id="postal_code" name="postal_code"
                               value="{{ old('postal_code', $old['postal_code'] ?? '') }}" required>
                    </div>
                </div>

                <label for="country">Country</label>
                <input type="text" id="country" name="country"
                       value="{{ old('country', $old['country'] ?? '') }}" required>

                <div class="row">
                    <div>
                        <label for="email">Mail address</label>
                        <input type="email" id="email" name="email"
                               value="{{ old('email', $old['email'] ?? (auth()->user()?->email ?? '')) }}" required>
                    </div>
                    <div>
                        <label for="phone_number">Phone number</label>
                        <input type="text" id="phone_number" name="phone_number"
                               value="{{ old('phone_number', $old['phone_number'] ?? (auth()->user()?->phone_number ?? '')) }}" required>
                    </div>
                </div>
            </div>

            <button type="submit" class="continue-btn">Continue</button>
        </form>
    </div>
</section>

@include('partials.footer')

</body>
</html>
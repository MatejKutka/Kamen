<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Checkout – Payment</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    @vite([
        'resources/css/reset.css',
        'resources/css/newnav.css',
        'resources/css/cart2.css',
        'resources/css/footer.css'
    ])
</head>
<body>

@include('partials.nav')

<section class="cart-steps step-3">
    <div class="steps-line"></div>
    <div class="step"><a href="{{ route('cart.index') }}" class="step-circle step-link">1</a></div>
    <div class="step"><a href="{{ route('checkout.delivery') }}" class="step-circle step-link">2</a></div>
    <div class="step"><span class="step-circle">3</span></div>
    <div class="step"><span class="step-circle">4</span></div>
</section>

<form method="POST" action="{{ route('checkout.order') }}">
@csrf

<section class="checkout">

    {{-- LEFT: Order summary --}}
    <div class="summary-box">
        <h3 class="summary-title">Order summary</h3>

        @foreach($cartItems as $item)
        <div class="summary-row">
            <span>{{ $item->name }} – {{ ucfirst($item->color) }}, {{ $item->size }}</span>
            <span>{{ $item->quantity }}</span>
            <span>{{ number_format($item->price * $item->quantity, 2, ',', ' ') }} €</span>
        </div>
        @endforeach

        <div class="summary-total">
            <span>Total: {{ number_format($total, 2, ',', ' ') }} €</span>
        </div>
    </div>

    {{-- RIGHT: Payment --}}
    <div class="payment-box">
        <h3 class="payment-title">Payment</h3>

        <div class="payment-options">
            <input type="radio" name="payment_method" id="card-online" value="Card online">
            <label for="card-online">Card online</label>

            <input type="radio" name="payment_method" id="card-delivery" value="Card after delivery">
            <label for="card-delivery">Card after delivery</label>

            <input type="radio" name="payment_method" id="paypal" value="PayPal">
            <label for="paypal">PayPal</label>

            <input type="radio" name="payment_method" id="google" value="Google Pay" checked>
            <label for="google">Google Pay</label>

            <input type="radio" name="payment_method" id="apple" value="Apple Pay">
            <label for="apple">Apple Pay</label>

            <input type="radio" name="payment_method" id="bank" value="Bank transfer">
            <label for="bank">Bank transfer</label>
        </div>

        <button type="submit" class="continue-btn">Continue</button>
    </div>

</section>
</form>

@include('partials.footer')

</body>
</html>
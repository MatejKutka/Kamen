<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Order Confirmed</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    @vite([
        'resources/css/reset.css',
        'resources/css/newnav.css',
        'resources/css/cart3.css',
        'resources/css/footer.css'
    ])
</head>
<body>

@include('partials.nav')

<section class="cart-steps step-4">
    <div class="steps-line"></div>
    <div class="step"><span class="step-circle step-link">1</span></div>
    <div class="step"><span class="step-circle step-link">2</span></div>
    <div class="step"><span class="step-circle step-link">3</span></div>
    <div class="step"><span class="step-circle step-link">4</span></div>
</section>

<section class="summary-section">
    <div class="delivery-summary">

        <div class="summary-message summary-message-small">Order #{{ $order->id }} accepted!</div>
        <div class="summary-message">Thank you for your order!</div>

        <div class="summary-row">
            <div class="summary-pill">Delivery</div>
            <div class="summary-pill">Payment: {{ $order->payment_method ?? '–' }}</div>
        </div>

        <div class="summary-field">
            <label>Name and surname</label>
            <div class="summary-value">{{ $order->name_and_surname }}</div>
        </div>

        <div class="summary-row">
            <div class="summary-field">
                <label>Street name</label>
                <div class="summary-value">{{ $order->street_name }}</div>
            </div>
            <div class="summary-field">
                <label>Street number</label>
                <div class="summary-value">{{ $order->street_number }}</div>
            </div>
        </div>

        <div class="summary-row">
            <div class="summary-field">
                <label>City</label>
                <div class="summary-value">{{ $order->city }}</div>
            </div>
            <div class="summary-field">
                <label>Postal code</label>
                <div class="summary-value">{{ $order->postal_code }}</div>
            </div>
        </div>

        <div class="summary-field">
            <label>Country</label>
            <div class="summary-value">{{ $order->country }}</div>
        </div>

        <div class="summary-row">
            <div class="summary-field">
                <label>Mail address</label>
                <div class="summary-value">{{ $order->email }}</div>
            </div>
            <div class="summary-field">
                <label>Phone number</label>
                <div class="summary-value">{{ $order->phone_number }}</div>
            </div>
        </div>

        <a class="continue-btn continue-link" href="{{ route('home') }}">Back to homepage</a>
    </div>
</section>

<section class="summary-checkout">
    <div class="summary-checkout-box">
        <h3 class="summary-title">Order summary</h3>

        @foreach($orderItems as $item)
        <div class="summary-row-cart">
            <span>{{ $item->name }} – {{ ucfirst($item->color) }}, {{ $item->size }}</span>
            <span>{{ $item->quantity }}</span>
            <span>{{ number_format($item->price * $item->quantity, 2, ',', ' ') }} €</span>
        </div>
        @endforeach

        <div class="summary-total-cart">
            <span>Total: {{ number_format($order->total_price, 2, ',', ' ') }} €</span>
        </div>
    </div>
</section>

@include('partials.footer')

</body>
</html>
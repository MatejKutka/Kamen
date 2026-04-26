<!DOCTYPE html>
<html lang="sk">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Prihlásenie</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">

    @vite(['resources/css/reset.css', 'resources/css/login.css'])
</head>

<body>
    <main style="background-image: url('{{ asset('images/bg.png') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
        <article aria-labelledby="login-heading">
            <a href="{{ url('/') }}" class="btn-home">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    aria-hidden="true">
                    <path d="M3 9.5L12 3l9 6.5V20a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V9.5z" />
                    <polyline points="9 21 9 12 15 12 15 21" />
                </svg>
                Home
            </a>

            <div class="login-avatar">
                <img src="{{ asset('images/profile.jpg') }}" alt="Avatar">
            </div>

            <h1 id="login-heading">Login</h1>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="field-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="yourname@gmail.com" value="{{ old('email') }}" required>
                    @error('email')
                        <p>{{ $message }}</p>
                    @enderror
                </div>

                <div class="field-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="password" required>
                    @error('password')
                        <p>{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="btn-login">Login</button>
            </form>

            <p class="switch-link">
                Don't have an account?
                <a href="{{ route('register') }}">Register</a>
            </p>
        </article>
    </main>
</body>

</html>
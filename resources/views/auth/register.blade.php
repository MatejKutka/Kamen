<!DOCTYPE html>
<html lang="sk">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registrácia</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">

    @vite(['resources/css/reset.css', 'resources/css/register.css'])
</head>

<body>
    <main class="register-page" style="background-image: url('{{ asset('images/bg.png') }}');">
        <article aria-labelledby="register-heading">
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

            <h1 id="register-heading">Register</h1>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="field-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter your name" value="{{ old('name') }}" required>
                    @error('name')
                        <p>{{ $message }}</p>
                    @enderror
                </div>

                <div class="field-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="yourname@gmail.com" value="{{ old('email') }}" required>
                    @error('email')
                        <p>{{ $message }}</p>
                    @enderror
                </div>

                <div class="field-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="••••••••" required>
                    @error('password')
                        <p>{{ $message }}</p>
                    @enderror
                </div>

                <div class="field-group">
                    <label for="password_confirmation">Confirm password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="••••••••" required>
                </div>

                <button type="submit" class="btn-register">Sign up</button>
            </form>

            <p class="switch-link">
                Do you already have an account?
                <a href="{{ route('login') }}">Log in</a>
            </p>
        </article>
    </main>
</body>

</html>
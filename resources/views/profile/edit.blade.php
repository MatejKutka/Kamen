<!DOCTYPE html>
<html lang="sk">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">

    @vite(['resources/css/reset.css', 'resources/css/profile.css'])
</head>

<body>
    <main class="profile-page" style="background-image: url('{{ asset('images/bg.png') }}');">

        <section class="profile-card" aria-labelledby="profile-heading">

            <header class="profile-card-header">
                <a href="{{ url('/') }}" class="btn-home">
                    Home
                </a>

                <img src="{{ asset('images/profile.jpg') }}" alt="Profilová fotka" class="avatar">

                <div class="profile-info">
                    <h1 id="profile-heading">{{ auth()->user()->name }}</h1>
                    <p>{{ auth()->user()->email }}</p>
                </div>

                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-logout">Log out</button>
                </form>
            </header>

            <hr>

            <!-- Update profile -->
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PATCH')

                <fieldset>

                    <div class="form-row">
                        <label for="first-name">First name</label>
                        <input type="text" id="first-name" name="first_name"
                               value="{{ old('first_name', auth()->user()->first_name ?? '') }}"
                               placeholder="Your first name">
                    </div>

                    <div class="form-row">
                        <label for="last-name">Last name</label>
                        <input type="text" id="last-name" name="last_name"
                               value="{{ old('last_name', auth()->user()->last_name ?? '') }}"
                               placeholder="Your last name">
                    </div>

                    <div class="form-row">
                        <label for="email">E-mail</label>
                        <input type="email" id="email" name="email"
                               value="{{ old('email', auth()->user()->email) }}"
                               placeholder="yourname@gmail.com">
                    </div>

                    <div class="form-row">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password"
                               placeholder="Leave empty to keep current password">
                    </div>

                    <div class="form-row">
                        <label for="phone">Phone number</label>
                        <input type="tel" id="phone" name="phone"
                               value="{{ old('phone', auth()->user()->phone ?? '') }}"
                               placeholder="+421 900 000 000">
                    </div>

                </fieldset>

                <div class="form-actions">
                    <button type="submit" class="btn-save">Save changes</button>
                </div>
            </form>

        </section>
    </main>
</body>

</html>
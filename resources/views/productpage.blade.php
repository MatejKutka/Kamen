<!DOCTYPE html>
<html lang="sk">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $product->name }} - {{ ucfirst($variant->color) }}</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  @vite([
    'resources/css/reset.css',
    'resources/css/newnav.css',
    'resources/css/productpage.css',
    'resources/css/footer.css'
  ])
</head>

<body>
  <!-- MOBILNÉ OVERLAY PANELY -->

  <dialog id="mobile-menu" class="mobile-panel">
    <header class="mobile-panel-header">
      <a href="{{ route('home') }}" class="navbar-logo">
        <img src="{{ asset('images/Logo.png') }}" alt="Logo e-shopu">
      </a>
      <a href="#" class="mobile-btn-close" aria-label="Close menu">✕</a>
    </header>

    <nav aria-label="Mobile menu">
      <ul role="list">
        <li><a href="{{ route('home') }}" class="mobile-main-link">Home</a></li>
        <li><a href="#mobile-men" class="mobile-cat-link">Men <span aria-hidden="true">›</span></a></li>
        <li><a href="#mobile-women" class="mobile-cat-link">Women <span aria-hidden="true">›</span></a></li>
        <li><a href="#mobile-accessories" class="mobile-cat-link">Accessories <span aria-hidden="true">›</span></a></li>
      </ul>
    </nav>

    <footer class="mobile-panel-footer">
      <ul class="mobile-actions" role="list">
        <li><a href="{{ route('register') }}" class="btn-login">Sign up</a></li>

        <li>
          <a href="{{ route('profile.edit') }}" class="mobile-profile" aria-label="My profile">
            <img src="{{ asset('images/profile.png') }}" alt="" aria-hidden="true">
          </a>
        </li>

        <li>
          <a href="{{ route('cart.index') }}" class="mobile-cart" aria-label="Shopping cart">
            <img src="{{ asset('images/shoping-cart.png') }}" alt="" aria-hidden="true">
          </a>
        </li>
      </ul>
    </footer>
  </dialog>

  <dialog id="mobile-men" class="mobile-panel">
    <header class="mobile-panel-header">
      <a href="#mobile-menu" class="mobile-btn-back" aria-label="Back to menu">‹ Back</a>
      <span class="mobile-panel-title">Men</span>
      <a href="#" class="mobile-btn-close" aria-label="Close menu">✕</a>
    </header>

    <nav aria-label="Men categories">
      <ul role="list">
        <li><a href="#mobile-men-clothes" class="mobile-cat-link">Clothes <span aria-hidden="true">›</span></a></li>
        <li><a href="#mobile-men-shoes" class="mobile-cat-link">Shoes <span aria-hidden="true">›</span></a></li>
        <li><a href="#mobile-men-sports" class="mobile-cat-link">Sports <span aria-hidden="true">›</span></a></li>
        <li><a href="#mobile-men-accessories" class="mobile-cat-link">Accessories <span aria-hidden="true">›</span></a></li>
      </ul>
    </nav>
  </dialog>

  <dialog id="mobile-men-clothes" class="mobile-panel">
    <header class="mobile-panel-header">
      <a href="#mobile-men" class="mobile-btn-back" aria-label="Back to Men">‹ Back</a>
      <span class="mobile-panel-title">Clothes</span>
      <a href="#" class="mobile-btn-close" aria-label="Close menu">✕</a>
    </header>

    <nav aria-label="Men clothes">
      <ul role="list">
        <li><a href="{{ route('products.index', ['gender' => 'men', 'category' => 'Clothes', 'subcategory' => 'T-shirt']) }}" class="mobile-sub-link">T-shirt</a></li>
        <li><a href="{{ route('products.index', ['gender' => 'men', 'category' => 'Clothes', 'subcategory' => 'Pants']) }}" class="mobile-sub-link">Pants</a></li>
        <li><a href="{{ route('products.index', ['gender' => 'men', 'category' => 'Clothes', 'subcategory' => 'Hoodies']) }}" class="mobile-sub-link">Hoodies</a></li>
        <li><a href="{{ route('products.index', ['gender' => 'men', 'category' => 'Clothes', 'subcategory' => 'Underwear']) }}" class="mobile-sub-link">Underwear</a></li>
      </ul>
    </nav>
  </dialog>

  <dialog id="mobile-men-shoes" class="mobile-panel">
    <header class="mobile-panel-header">
      <a href="#mobile-men" class="mobile-btn-back" aria-label="Back to Men">‹ Back</a>
      <span class="mobile-panel-title">Shoes</span>
      <a href="#" class="mobile-btn-close" aria-label="Close menu">✕</a>
    </header>

    <nav aria-label="Men shoes">
      <ul role="list">
        <li><a href="{{ route('products.index', ['gender' => 'men', 'category' => 'Shoes', 'subcategory' => 'Running shoes']) }}" class="mobile-sub-link">Running shoes</a></li>
        <li><a href="{{ route('products.index', ['gender' => 'men', 'category' => 'Shoes', 'subcategory' => 'Sport shoes']) }}" class="mobile-sub-link">Sport shoes</a></li>
        <li><a href="{{ route('products.index', ['gender' => 'men', 'category' => 'Shoes', 'subcategory' => 'Climbing shoes']) }}" class="mobile-sub-link">Climbing shoes</a></li>
        <li><a href="{{ route('products.index', ['gender' => 'men', 'category' => 'Shoes', 'subcategory' => 'Open shoes']) }}" class="mobile-sub-link">Open shoes</a></li>
      </ul>
    </nav>
  </dialog>

  <dialog id="mobile-men-sports" class="mobile-panel">
    <header class="mobile-panel-header">
      <a href="#mobile-men" class="mobile-btn-back" aria-label="Back to Men">‹ Back</a>
      <span class="mobile-panel-title">Sports</span>
      <a href="#" class="mobile-btn-close" aria-label="Close menu">✕</a>
    </header>

    <nav aria-label="Men sports">
      <ul role="list">
        <li><a href="{{ route('products.index', ['gender' => 'men', 'sport' => 'climbing']) }}" class="mobile-sub-link">Climbing</a></li>
        <li><a href="{{ route('products.index', ['gender' => 'men', 'sport' => 'running']) }}" class="mobile-sub-link">Running</a></li>
        <li><a href="{{ route('products.index', ['gender' => 'men', 'sport' => 'football']) }}" class="mobile-sub-link">Football</a></li>
        <li><a href="{{ route('products.index', ['gender' => 'men', 'sport' => 'basketball']) }}" class="mobile-sub-link">Basketball</a></li>
      </ul>
    </nav>
  </dialog>

  <dialog id="mobile-men-accessories" class="mobile-panel">
    <header class="mobile-panel-header">
      <a href="#mobile-men" class="mobile-btn-back" aria-label="Back to Men">‹ Back</a>
      <span class="mobile-panel-title">Accessories</span>
      <a href="#" class="mobile-btn-close" aria-label="Close menu">✕</a>
    </header>

    <nav aria-label="Men accessories">
      <ul role="list">
        <li><a href="{{ route('products.index', ['gender' => 'men', 'category' => 'Accessories']) }}" class="mobile-sub-link">All accessories</a></li>
        <li><a href="{{ route('products.index', ['gender' => 'men', 'category' => 'Accessories', 'subcategory' => 'Caps & hats']) }}" class="mobile-sub-link">Caps & hats</a></li>
        <li><a href="{{ route('products.index', ['gender' => 'men', 'category' => 'Accessories', 'subcategory' => 'Bags & backpacks']) }}" class="mobile-sub-link">Bags & backpacks</a></li>
        <li><a href="{{ route('products.index', ['gender' => 'men', 'category' => 'Accessories', 'subcategory' => 'Socks']) }}" class="mobile-sub-link">Socks</a></li>
        <li><a href="{{ route('products.index', ['gender' => 'men', 'category' => 'Accessories', 'subcategory' => 'Watches']) }}" class="mobile-sub-link">Watches</a></li>
      </ul>
    </nav>
  </dialog>

  <dialog id="mobile-women" class="mobile-panel">
    <header class="mobile-panel-header">
      <a href="#mobile-menu" class="mobile-btn-back" aria-label="Back to menu">‹ Back</a>
      <span class="mobile-panel-title">Women</span>
      <a href="#" class="mobile-btn-close" aria-label="Close menu">✕</a>
    </header>

    <nav aria-label="Women categories">
      <ul role="list">
        <li><a href="#mobile-women-clothes" class="mobile-cat-link">Clothes <span aria-hidden="true">›</span></a></li>
        <li><a href="#mobile-women-shoes" class="mobile-cat-link">Shoes <span aria-hidden="true">›</span></a></li>
        <li><a href="#mobile-women-sports" class="mobile-cat-link">Sports <span aria-hidden="true">›</span></a></li>
        <li><a href="#mobile-women-accessories" class="mobile-cat-link">Accessories <span aria-hidden="true">›</span></a></li>
      </ul>
    </nav>
  </dialog>

  <dialog id="mobile-women-clothes" class="mobile-panel">
    <header class="mobile-panel-header">
      <a href="#mobile-women" class="mobile-btn-back" aria-label="Back to Women">‹ Back</a>
      <span class="mobile-panel-title">Clothes</span>
      <a href="#" class="mobile-btn-close" aria-label="Close menu">✕</a>
    </header>

    <nav aria-label="Women clothes">
      <ul role="list">
        <li><a href="{{ route('products.index', ['gender' => 'women', 'category' => 'Clothes', 'subcategory' => 'T-shirt']) }}" class="mobile-sub-link">T-shirt</a></li>
        <li><a href="{{ route('products.index', ['gender' => 'women', 'category' => 'Clothes', 'subcategory' => 'Pants']) }}" class="mobile-sub-link">Pants</a></li>
        <li><a href="{{ route('products.index', ['gender' => 'women', 'category' => 'Clothes', 'subcategory' => 'Jackets']) }}" class="mobile-sub-link">Jackets</a></li>
        <li><a href="{{ route('products.index', ['gender' => 'women', 'category' => 'Clothes', 'subcategory' => 'Underwear']) }}" class="mobile-sub-link">Underwear</a></li>
      </ul>
    </nav>
  </dialog>

  <dialog id="mobile-women-shoes" class="mobile-panel">
    <header class="mobile-panel-header">
      <a href="#mobile-women" class="mobile-btn-back" aria-label="Back to Women">‹ Back</a>
      <span class="mobile-panel-title">Shoes</span>
      <a href="#" class="mobile-btn-close" aria-label="Close menu">✕</a>
    </header>

    <nav aria-label="Women shoes">
      <ul role="list">
        <li><a href="{{ route('products.index', ['gender' => 'women', 'category' => 'Shoes', 'subcategory' => 'Running shoes']) }}" class="mobile-sub-link">Running shoes</a></li>
        <li><a href="{{ route('products.index', ['gender' => 'women', 'category' => 'Shoes', 'subcategory' => 'Sport shoes']) }}" class="mobile-sub-link">Sport shoes</a></li>
        <li><a href="{{ route('products.index', ['gender' => 'women', 'category' => 'Shoes', 'subcategory' => 'Climbing shoes']) }}" class="mobile-sub-link">Climbing shoes</a></li>
        <li><a href="{{ route('products.index', ['gender' => 'women', 'category' => 'Shoes', 'subcategory' => 'Open shoes']) }}" class="mobile-sub-link">Open shoes</a></li>
      </ul>
    </nav>
  </dialog>

  <dialog id="mobile-women-sports" class="mobile-panel">
    <header class="mobile-panel-header">
      <a href="#mobile-women" class="mobile-btn-back" aria-label="Back to Women">‹ Back</a>
      <span class="mobile-panel-title">Sports</span>
      <a href="#" class="mobile-btn-close" aria-label="Close menu">✕</a>
    </header>

    <nav aria-label="Women sports">
      <ul role="list">
        <li><a href="{{ route('products.index', ['gender' => 'women', 'sport' => 'climbing']) }}" class="mobile-sub-link">Climbing</a></li>
        <li><a href="{{ route('products.index', ['gender' => 'women', 'sport' => 'running']) }}" class="mobile-sub-link">Running</a></li>
        <li><a href="{{ route('products.index', ['gender' => 'women', 'sport' => 'volleyball']) }}" class="mobile-sub-link">Volleyball</a></li>
        <li><a href="{{ route('products.index', ['gender' => 'women', 'sport' => 'basketball']) }}" class="mobile-sub-link">Basketball</a></li>
      </ul>
    </nav>
  </dialog>

  <dialog id="mobile-women-accessories" class="mobile-panel">
    <header class="mobile-panel-header">
      <a href="#mobile-women" class="mobile-btn-back" aria-label="Back to Women">‹ Back</a>
      <span class="mobile-panel-title">Accessories</span>
      <a href="#" class="mobile-btn-close" aria-label="Close menu">✕</a>
    </header>

    <nav aria-label="Women accessories">
      <ul role="list">
        <li><a href="{{ route('products.index', ['gender' => 'women', 'category' => 'Accessories']) }}" class="mobile-sub-link">All accessories</a></li>
        <li><a href="{{ route('products.index', ['gender' => 'women', 'category' => 'Accessories', 'subcategory' => 'Caps & hats']) }}" class="mobile-sub-link">Caps & hats</a></li>
        <li><a href="{{ route('products.index', ['gender' => 'women', 'category' => 'Accessories', 'subcategory' => 'Bags & backpacks']) }}" class="mobile-sub-link">Bags & backpacks</a></li>
        <li><a href="{{ route('products.index', ['gender' => 'women', 'category' => 'Accessories', 'subcategory' => 'Socks']) }}" class="mobile-sub-link">Socks</a></li>
        <li><a href="{{ route('products.index', ['gender' => 'women', 'category' => 'Accessories', 'subcategory' => 'Watches']) }}" class="mobile-sub-link">Watches</a></li>
      </ul>
    </nav>
  </dialog>

  <dialog id="mobile-accessories" class="mobile-panel">
    <header class="mobile-panel-header">
      <a href="#mobile-menu" class="mobile-btn-back" aria-label="Back to menu">‹ Back</a>
      <span class="mobile-panel-title">Accessories</span>
      <a href="#" class="mobile-btn-close" aria-label="Close menu">✕</a>
    </header>

    <nav aria-label="Accessories">
      <ul role="list">
        <li><a href="{{ route('products.index', ['category' => 'Accessories']) }}" class="mobile-sub-link">All accessories</a></li>
        <li><a href="{{ route('products.index', ['category' => 'Accessories', 'subcategory' => 'Bags & backpacks']) }}" class="mobile-sub-link">Bags & backpacks</a></li>
        <li><a href="{{ route('products.index', ['category' => 'Accessories', 'subcategory' => 'Sunglasses']) }}" class="mobile-sub-link">Sunglasses</a></li>
        <li><a href="{{ route('products.index', ['category' => 'Accessories', 'subcategory' => 'Gloves']) }}" class="mobile-sub-link">Gloves</a></li>
        <li><a href="{{ route('products.index', ['category' => 'Accessories', 'subcategory' => 'Hats & caps']) }}" class="mobile-sub-link">Hats & caps</a></li>
        <li><a href="{{ route('products.index', ['category' => 'Accessories', 'subcategory' => 'Water bottles']) }}" class="mobile-sub-link">Water bottles</a></li>
      </ul>
    </nav>
  </dialog>

  <header class="site-header">
    <nav class="site-navbar" aria-label="Hlavná navigácia">
      <a href="{{ route('home') }}" class="navbar-logo">
        <img src="{{ asset('images/Logo.png') }}" alt="Logo e-shopu">
      </a>

      <input type="checkbox" id="nav-toggle" class="nav-toggle" aria-hidden="true">

      <label for="nav-toggle" class="nav-toggle-label desktop-hamburger" aria-label="Open menu">
        <span></span>
        <span></span>
        <span></span>
      </label>

      <a href="#mobile-menu" class="mobile-hamburger" aria-label="Otvoriť menu">
        <span></span>
        <span></span>
        <span></span>
      </a>

      <ul class="menu">
        <li><a href="{{ route('home') }}" class="menu-link">Home</a></li>

        <li class="menu-item">
          <a href="{{ route('products.index', ['gender' => 'men']) }}" class="menu-link">Men</a>

          <ul class="submenu">
            <li class="submenu-title">
              <a href="{{ route('products.index', ['gender' => 'men']) }}">Men</a>
            </li>

            <li class="submenu-item">
              <a href="{{ route('products.index', ['gender' => 'men', 'category' => 'Clothes']) }}">Clothes</a>

              <ul class="sub-submenu">
                <li><a href="{{ route('products.index', ['gender' => 'men', 'category' => 'Clothes', 'subcategory' => 'T-shirt']) }}">T-shirt</a></li>
                <li><a href="{{ route('products.index', ['gender' => 'men', 'category' => 'Clothes', 'subcategory' => 'Pants']) }}">Pants</a></li>
                <li><a href="{{ route('products.index', ['gender' => 'men', 'category' => 'Clothes', 'subcategory' => 'Hoodies']) }}">Hoodies</a></li>
                <li><a href="{{ route('products.index', ['gender' => 'men', 'category' => 'Clothes', 'subcategory' => 'Underwear']) }}">Underwear</a></li>
              </ul>
            </li>

            <li class="submenu-item">
              <a href="{{ route('products.index', ['gender' => 'men', 'category' => 'Shoes']) }}">Shoes</a>

              <ul class="sub-submenu">
                <li><a href="{{ route('products.index', ['gender' => 'men', 'category' => 'Shoes', 'subcategory' => 'Running shoes']) }}">Running shoes</a></li>
                <li><a href="{{ route('products.index', ['gender' => 'men', 'category' => 'Shoes', 'subcategory' => 'Sport shoes']) }}">Sport shoes</a></li>
                <li><a href="{{ route('products.index', ['gender' => 'men', 'category' => 'Shoes', 'subcategory' => 'Climbing shoes']) }}">Climbing shoes</a></li>
                <li><a href="{{ route('products.index', ['gender' => 'men', 'category' => 'Shoes', 'subcategory' => 'Open shoes']) }}">Open shoes</a></li>
              </ul>
            </li>

            <li class="submenu-item">
              <a href="{{ route('products.index', ['gender' => 'men']) }}">Sports</a>

              <ul class="sub-submenu">
                <li><a href="{{ route('products.index', ['gender' => 'men', 'sport' => 'climbing']) }}">Climbing</a></li>
                <li><a href="{{ route('products.index', ['gender' => 'men', 'sport' => 'running']) }}">Running</a></li>
                <li><a href="{{ route('products.index', ['gender' => 'men', 'sport' => 'football']) }}">Football</a></li>
                <li><a href="{{ route('products.index', ['gender' => 'men', 'sport' => 'basketball']) }}">Basketball</a></li>
              </ul>
            </li>

            <li class="submenu-item">
              <a href="{{ route('products.index', ['gender' => 'men', 'category' => 'Accessories']) }}">Accessories</a>

              <ul class="sub-submenu">
                <li><a href="{{ route('products.index', ['gender' => 'men', 'category' => 'Accessories', 'subcategory' => 'Caps & hats']) }}">Caps & hats</a></li>
                <li><a href="{{ route('products.index', ['gender' => 'men', 'category' => 'Accessories', 'subcategory' => 'Bags & backpacks']) }}">Bags & backpacks</a></li>
                <li><a href="{{ route('products.index', ['gender' => 'men', 'category' => 'Accessories', 'subcategory' => 'Socks']) }}">Socks</a></li>
                <li><a href="{{ route('products.index', ['gender' => 'men', 'category' => 'Accessories', 'subcategory' => 'Watches']) }}">Watches</a></li>
              </ul>
            </li>
          </ul>
        </li>

        <li class="menu-item">
          <a href="{{ route('products.index', ['gender' => 'women']) }}" class="menu-link">Women</a>

          <ul class="submenu">
            <li class="submenu-title">
              <a href="{{ route('products.index', ['gender' => 'women']) }}">Women</a>
            </li>

            <li class="submenu-item">
              <a href="{{ route('products.index', ['gender' => 'women', 'category' => 'Clothes']) }}">Clothes</a>

              <ul class="sub-submenu">
                <li><a href="{{ route('products.index', ['gender' => 'women', 'category' => 'Clothes', 'subcategory' => 'T-shirt']) }}">T-shirt</a></li>
                <li><a href="{{ route('products.index', ['gender' => 'women', 'category' => 'Clothes', 'subcategory' => 'Pants']) }}">Pants</a></li>
                <li><a href="{{ route('products.index', ['gender' => 'women', 'category' => 'Clothes', 'subcategory' => 'Jackets']) }}">Jackets</a></li>
                <li><a href="{{ route('products.index', ['gender' => 'women', 'category' => 'Clothes', 'subcategory' => 'Underwear']) }}">Underwear</a></li>
              </ul>
            </li>

            <li class="submenu-item">
              <a href="{{ route('products.index', ['gender' => 'women', 'category' => 'Shoes']) }}">Shoes</a>

              <ul class="sub-submenu">
                <li><a href="{{ route('products.index', ['gender' => 'women', 'category' => 'Shoes', 'subcategory' => 'Running shoes']) }}">Running shoes</a></li>
                <li><a href="{{ route('products.index', ['gender' => 'women', 'category' => 'Shoes', 'subcategory' => 'Sport shoes']) }}">Sport shoes</a></li>
                <li><a href="{{ route('products.index', ['gender' => 'women', 'category' => 'Shoes', 'subcategory' => 'Climbing shoes']) }}">Climbing shoes</a></li>
                <li><a href="{{ route('products.index', ['gender' => 'women', 'category' => 'Shoes', 'subcategory' => 'Open shoes']) }}">Open shoes</a></li>
              </ul>
            </li>

            <li class="submenu-item">
              <a href="{{ route('products.index', ['gender' => 'women']) }}">Sports</a>

              <ul class="sub-submenu">
                <li><a href="{{ route('products.index', ['gender' => 'women', 'sport' => 'climbing']) }}">Climbing</a></li>
                <li><a href="{{ route('products.index', ['gender' => 'women', 'sport' => 'running']) }}">Running</a></li>
                <li><a href="{{ route('products.index', ['gender' => 'women', 'sport' => 'volleyball']) }}">Volleyball</a></li>
                <li><a href="{{ route('products.index', ['gender' => 'women', 'sport' => 'basketball']) }}">Basketball</a></li>
              </ul>
            </li>

            <li class="submenu-item">
              <a href="{{ route('products.index', ['gender' => 'women', 'category' => 'Accessories']) }}">Accessories</a>

              <ul class="sub-submenu">
                <li><a href="{{ route('products.index', ['gender' => 'women', 'category' => 'Accessories', 'subcategory' => 'Caps & hats']) }}">Caps & hats</a></li>
                <li><a href="{{ route('products.index', ['gender' => 'women', 'category' => 'Accessories', 'subcategory' => 'Bags & backpacks']) }}">Bags & backpacks</a></li>
                <li><a href="{{ route('products.index', ['gender' => 'women', 'category' => 'Accessories', 'subcategory' => 'Socks']) }}">Socks</a></li>
                <li><a href="{{ route('products.index', ['gender' => 'women', 'category' => 'Accessories', 'subcategory' => 'Watches']) }}">Watches</a></li>
              </ul>
            </li>
          </ul>
        </li>

        <li class="menu-item">
          <a href="{{ route('products.index', ['category' => 'Accessories']) }}" class="menu-link">Accessories</a>

          <ul class="submenu">
            <li class="submenu-title">
              <a href="{{ route('products.index', ['category' => 'Accessories']) }}">Accessories</a>
            </li>

            <li class="submenu-item">
              <ul class="sub-submenu">
                <li><a href="{{ route('products.index', ['category' => 'Accessories', 'subcategory' => 'Bags & backpacks']) }}">Bags & backpacks</a></li>
                <li><a href="{{ route('products.index', ['category' => 'Accessories', 'subcategory' => 'Sunglasses']) }}">Sunglasses</a></li>
                <li><a href="{{ route('products.index', ['category' => 'Accessories', 'subcategory' => 'Gloves']) }}">Gloves</a></li>
                <li><a href="{{ route('products.index', ['category' => 'Accessories', 'subcategory' => 'Hats & caps']) }}">Hats & caps</a></li>
                <li><a href="{{ route('products.index', ['category' => 'Accessories', 'subcategory' => 'Water bottles']) }}">Water bottles</a></li>
              </ul>
            </li>
          </ul>
        </li>
      </ul>

      <form method="GET" action="{{ route('products.index') }}" class="navbar-search" role="search">
        <img src="{{ asset('images/magnifying-glass.png') }}"
             alt=""
             class="navbar-search-icon"
             aria-hidden="true">

        <input
          type="search"
          id="site-search"
          name="search"
          class="navbar-search-input"
          placeholder="Search"
          value="{{ request('search') }}"
          autocomplete="off"
        >
      </form>

      <ul class="navbar-actions">
        <li><a href="{{ route('register') }}" class="btn-login">Sign up</a></li>

        <li>
          <a href="{{ route('profile.edit') }}" class="profile-link" aria-label="My profile">
            <img src="{{ asset('images/profile.jpg') }}" alt="" aria-hidden="true">
          </a>
        </li>

        <li>
          <a href="{{ route('cart.index') }}" class="cart-link" aria-label="Shopping cart">
            <img src="{{ asset('images/shoping-cart.png') }}" alt="" aria-hidden="true">
          </a>
        </li>
      </ul>
    </nav>
  </header>

  <main>
    <section class="product-detail-section">
      <div class="product-detail-container">
        <div class="product-left">
          <img
            id="mainProductImage"
            src="{{ asset($images->first()->image_path ?? 'images/no-image.png') }}"
            alt="{{ $product->name }}"
            class="product-detail-image"
          >

          <div class="image-controls">
            <button type="button" class="arrow-btn" id="prevImage">←</button>
            <button type="button" class="arrow-btn" id="nextImage">→</button>
          </div>
        </div>

        <div class="product-right">
          <h1 class="product-detail-title">
            {{ ucfirst($variant->color) }} {{ $product->name }}
          </h1>

          <p class="product-detail-description">
            {{ $product->description }}
          </p>

          <hr>

          <p class="product-detail-price">
            {{ number_format($variant->price, 2, ',', ' ') }} €
          </p>

          <form method="POST" action="{{ route('cart.add') }}" class="product-buttons">
            @csrf

            @php
              $hasRealSize = $sizes->contains(fn ($sizeVariant) => $sizeVariant->size !== 'one-size');
            @endphp

            @if($hasRealSize)
              <label class="size-select-wrap">
                <span class="visually-hidden">Select size</span>

                <select class="size-select" name="variant_id" aria-label="Select size" required>
                  <option value="" disabled>Size</option>

                  @foreach ($sizes as $sizeVariant)
                    <option value="{{ $sizeVariant->id }}" @selected($sizeVariant->id === $variant->id)>
                      {{ $sizeVariant->size }}
                    </option>
                  @endforeach
                </select>
              </label>
            @else
              <input type="hidden" name="variant_id" value="{{ $variant->id }}">
            @endif

            <input type="hidden" name="quantity" id="cartQuantity" value="1">

            <div class="quantity-box">
              <button type="button" class="arrow-btn" id="minusQty">-</button>
              <p class="product-amount" id="amountText">1</p>
              <button type="button" class="arrow-btn" id="plusQty">+</button>
            </div>

            <button type="submit" class="tocart-btn">Add to cart</button>
          </form>
        </div>
      </div>
    </section>

    <section class="details-section">
      <h2 class="details-title">Detailed description</h2>

      @php
        $availableSizes = $sizes
            ->pluck('size')
            ->filter(fn ($size) => $size !== 'one-size')
            ->unique()
            ->values();

        $details = [
            'Category' => $product->category_name ?? null,
            'Subcategory' => $product->subcategory_name ?? null,
            'Color' => $variant->color ? ucfirst($variant->color) : null,
            'Gender' => $product->gender ? ucfirst($product->gender) : null,
            'Sport' => $product->sport ? ucfirst($product->sport) : null,
            'Size' => $variant->size !== 'one-size' ? $variant->size : null,
            'Available sizes' => $availableSizes->isNotEmpty() ? $availableSizes->implode(', ') : null,
            'Stock' => $variant->stock !== null ? $variant->stock . ' ks' : null,
            'Availability' => $variant->stock > 0 ? 'In stock' : 'Out of stock',
          ];

        $details = collect($details)
            ->filter(fn ($value) => filled($value))
            ->toArray();

        $detailRows = array_chunk($details, 2, true);
      @endphp

      <div class="table-wrapper">
        <table class="details-table">
          @foreach($detailRows as $row)
            <tr>
              @foreach($row as $label => $value)
                <td>{{ $label }}</td>
                <td>{{ $value }}</td>
              @endforeach

              @if(count($row) === 1)
                <td></td>
                <td></td>
              @endif
            </tr>
          @endforeach
        </table>
      </div>
    </section>

    <section class="others-section" id="others">
      <h2 class="others-title">Other like this</h2>

      <div class="others-grid">
        @forelse($relatedProducts as $related)
          <a href="{{ route('productpage', $related->variant_id) }}" class="others-card">
            <img
              src="{{ $related->image_path ? asset($related->image_path) : asset('images/no-image.png') }}"
              class="others-image img-fluid"
              alt="{{ $related->name }}"
              loading="lazy"
            >

            <p class="others-text">
              {{ $related->name }} - {{ $related->color }}
            </p>

            <p class="others-text">
              {{ number_format($related->price, 2, ',', ' ') }} €
            </p>
          </a>
        @empty
          <p class="others-empty">No similar products found.</p>
        @endforelse
      </div>
    </section>
  </main>

  <footer class="footer-section">
    <ul class="footer-container">
      <li class="footer-left">
        <h4>Kamen</h4>
        <p>Small company description</p>
      </li>

      <li class="footer-right">
        <address>
          <p><strong>Contact us</strong></p>
          <p>Mail - <a href="mailto:kamen@gmail.com">kamen@gmail.com</a></p>
          <p>Phone - <a href="tel:+421xxxxxxxxx">+421 xxx xxx xxx</a></p>
        </address>
      </li>
    </ul>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    const images = @json(
      $images->map(fn($image) => asset($image->image_path))->values()
    );

    let currentImageIndex = 0;

    const mainImage = document.getElementById("mainProductImage");
    const prevButton = document.getElementById("prevImage");
    const nextButton = document.getElementById("nextImage");

    if (nextButton && prevButton && mainImage) {
      nextButton.addEventListener("click", function () {
        if (images.length === 0) return;

        currentImageIndex++;

        if (currentImageIndex >= images.length) {
          currentImageIndex = 0;
        }

        mainImage.src = images[currentImageIndex];
      });

      prevButton.addEventListener("click", function () {
        if (images.length === 0) return;

        currentImageIndex--;

        if (currentImageIndex < 0) {
          currentImageIndex = images.length - 1;
        }

        mainImage.src = images[currentImageIndex];
      });
    }
  </script>

  <script>
    const minusBtn = document.getElementById("minusQty");
    const plusBtn = document.getElementById("plusQty");
    const amountText = document.getElementById("amountText");
    const quantityInput = document.getElementById("cartQuantity");

    let amount = 1;

    function updateQuantity() {
      amountText.textContent = amount;
      quantityInput.value = amount;
    }

    if (minusBtn && plusBtn && amountText && quantityInput) {
      minusBtn.addEventListener("click", function () {
        if (amount > 1) {
          amount--;
          updateQuantity();
        }
      });

      plusBtn.addEventListener("click", function () {
        amount++;
        updateQuantity();
      });
    }
  </script>
</body>
</html>
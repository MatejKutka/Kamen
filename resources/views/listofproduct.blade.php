<!doctype html>
<html lang="sk">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>List of products</title>

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet" />
  @vite([
    'resources/css/reset.css',
    'resources/css/newnav.css',
    'resources/css/listofproduct.css',
    'resources/css/footer.css'
  ])
</head>

<body>
  <!--
     MOBILNÉ OVERLAY PANELY
     Vrstva 1 - Vrstva 2 - Vrstva 3
    -->

  <!-- VRSTVA 1: Hlavné menu -->
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
          <a href="cart.html" class="mobile-cart" aria-label="Shopping cart">
            <img src="{{ asset('images/shoping-cart.png') }}" alt="" aria-hidden="true">
          </a>
        </li>
      </ul>
    </footer>
  </dialog>

  <!-- VRSTVA 2: Men -->
  <dialog id="mobile-men" class="mobile-panel">
    <header class="mobile-panel-header">
      <a href="#mobile-menu" class="mobile-btn-back" aria-label="Back to menu">‹ Back</a>
      <span class="mobile-panel-title">Men</span>
      <a href="#" class="mobile-btn-close" aria-label="Close menu">✕</a>
    </header>
    <nav aria-label="Men categories">
      <ul role="list">
        <li><a href="#mobile-men-clothes" class="mobile-cat-link">Clothes <span aria-hidden="true">›</span></a>
        </li>
        <li><a href="#mobile-men-shoes" class="mobile-cat-link">Shoes <span aria-hidden="true">›</span></a></li>
        <li><a href="#mobile-men-sports" class="mobile-cat-link">Sports <span aria-hidden="true">›</span></a>
        </li>
        <li><a href="#mobile-men-accessories" class="mobile-cat-link">Accessories <span aria-hidden="true">›</span></a>
        </li>
      </ul>
    </nav>
  </dialog>

  <!-- VRSTVA 3: Men: Clothes -->
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

  <!-- VRSTVA 3: Men: Shoes -->
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

  <!-- VRSTVA 3: Men: Sports -->
  <dialog id="mobile-men-sports" class="mobile-panel">
    <header class="mobile-panel-header">
        <a href="#mobile-men" class="mobile-btn-back" aria-label="Back to Men">‹ Back</a>
        <span class="mobile-panel-title">Sports</span>
        <a href="#" class="mobile-btn-close" aria-label="Close menu">✕</a>
    </header>
    <nav aria-label="Men sports">
        <ul role="list">
        <li><a href="{{ route('products.index', ['gender' => 'men', 'category' => 'Sports', 'subcategory' => 'Climbing']) }}" class="mobile-sub-link">Climbing</a></li>
        <li><a href="{{ route('products.index', ['gender' => 'men', 'category' => 'Sports', 'subcategory' => 'Running']) }}" class="mobile-sub-link">Running</a></li>
        <li><a href="{{ route('products.index', ['gender' => 'men', 'category' => 'Sports', 'subcategory' => 'Football']) }}" class="mobile-sub-link">Football</a></li>
        <li><a href="{{ route('products.index', ['gender' => 'men', 'category' => 'Sports', 'subcategory' => 'Basketball']) }}" class="mobile-sub-link">Basketball</a></li>
        </ul>
    </nav>
    </dialog>

  <!-- VRSTVA 3: Men: Accessories -->
  <dialog id="mobile-men-accessories" class="mobile-panel">
    <header class="mobile-panel-header">
        <a href="#mobile-men" class="mobile-btn-back" aria-label="Back to Men">‹ Back</a>
        <span class="mobile-panel-title">Accessories</span>
        <a href="#" class="mobile-btn-close" aria-label="Close menu">✕</a>
    </header>
    <nav aria-label="Men accessories">
        <ul role="list">
        <li><a href="{{ route('products.index', ['gender' => 'men', 'category' => 'Accessories', 'subcategory' => 'Caps & hats']) }}" class="mobile-sub-link">Caps & hats</a></li>
        <li><a href="{{ route('products.index', ['gender' => 'men', 'category' => 'Accessories', 'subcategory' => 'Bags & backpacks']) }}" class="mobile-sub-link">Bags & backpacks</a></li>
        <li><a href="{{ route('products.index', ['gender' => 'men', 'category' => 'Accessories', 'subcategory' => 'Socks']) }}" class="mobile-sub-link">Socks</a></li>
        <li><a href="{{ route('products.index', ['gender' => 'men', 'category' => 'Accessories', 'subcategory' => 'Watches']) }}" class="mobile-sub-link">Watches</a></li>
        </ul>
    </nav>
    </dialog>

  <!-- VRSTVA 2: Women -->
  <dialog id="mobile-women" class="mobile-panel">
    <header class="mobile-panel-header">
      <a href="#mobile-menu" class="mobile-btn-back" aria-label="Back to menu">‹ Back</a>
      <span class="mobile-panel-title">Women</span>
      <a href="#" class="mobile-btn-close" aria-label="Close menu">✕</a>
    </header>
    <nav aria-label="Women categories">
      <ul role="list">
        <li><a href="#mobile-women-clothes" class="mobile-cat-link">Clothes <span aria-hidden="true">›</span></a></li>
        <li><a href="#mobile-women-shoes" class="mobile-cat-link">Shoes <span aria-hidden="true">›</span></a>
        </li>
        <li><a href="#mobile-women-sports" class="mobile-cat-link">Sports <span aria-hidden="true">›</span></a>
        </li>
        <li><a href="#mobile-women-accessories" class="mobile-cat-link">Accessories <span
              aria-hidden="true">›</span></a></li>
      </ul>
    </nav>
  </dialog>

  <!-- VRSTVA 3: Women: Clothes -->
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

  <!-- VRSTVA 3: Women: Shoes -->
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

  <!-- VRSTVA 3: Women: Sports -->
  <dialog id="mobile-women-sports" class="mobile-panel">
    <header class="mobile-panel-header">
        <a href="#mobile-women" class="mobile-btn-back" aria-label="Back to Women">‹ Back</a>
        <span class="mobile-panel-title">Sports</span>
        <a href="#" class="mobile-btn-close" aria-label="Close menu">✕</a>
    </header>
    <nav aria-label="Women sports">
        <ul role="list">
        <li><a href="{{ route('products.index', ['gender' => 'women', 'category' => 'Sports', 'subcategory' => 'Climbing']) }}" class="mobile-sub-link">Climbing</a></li>
        <li><a href="{{ route('products.index', ['gender' => 'women', 'category' => 'Sports', 'subcategory' => 'Running']) }}" class="mobile-sub-link">Running</a></li>
        <li><a href="{{ route('products.index', ['gender' => 'women', 'category' => 'Sports', 'subcategory' => 'Volleyball']) }}" class="mobile-sub-link">Volleyball</a></li>
        <li><a href="{{ route('products.index', ['gender' => 'women', 'category' => 'Sports', 'subcategory' => 'Basketball']) }}" class="mobile-sub-link">Basketball</a></li>
        </ul>
    </nav>
    </dialog>

  <!-- VRSTVA 3: Women: Accessories -->
  <dialog id="mobile-women-accessories" class="mobile-panel">
    <header class="mobile-panel-header">
        <a href="#mobile-women" class="mobile-btn-back" aria-label="Back to Women">‹ Back</a>
        <span class="mobile-panel-title">Accessories</span>
        <a href="#" class="mobile-btn-close" aria-label="Close menu">✕</a>
    </header>
    <nav aria-label="Women accessories">
        <ul role="list">
        <li><a href="{{ route('products.index', ['gender' => 'women', 'category' => 'Accessories', 'subcategory' => 'Caps & hats']) }}" class="mobile-sub-link">Caps & hats</a></li>
        <li><a href="{{ route('products.index', ['gender' => 'women', 'category' => 'Accessories', 'subcategory' => 'Bags & backpacks']) }}" class="mobile-sub-link">Bags & backpacks</a></li>
        <li><a href="{{ route('products.index', ['gender' => 'women', 'category' => 'Accessories', 'subcategory' => 'Socks']) }}" class="mobile-sub-link">Socks</a></li>
        <li><a href="{{ route('products.index', ['gender' => 'women', 'category' => 'Accessories', 'subcategory' => 'Watches']) }}" class="mobile-sub-link">Watches</a></li>
        </ul>
    </nav>
    </dialog>

  <!-- VRSTVA 2: Accessories -->
  <dialog id="mobile-accessories" class="mobile-panel">
    <header class="mobile-panel-header">
        <a href="#mobile-menu" class="mobile-btn-back" aria-label="Back to menu">‹ Back</a>
        <span class="mobile-panel-title">Accessories</span>
        <a href="#" class="mobile-btn-close" aria-label="Close menu">✕</a>
    </header>
    <nav aria-label="Accessories">
        <ul role="list">
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

      <!-- desktop -->
      <ul class="menu">
        <li><a href="{{ route('home') }}" class="menu-link">Home</a></li>

        <!-- Men category menu -->
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
            <a href="{{ route('products.index', ['gender' => 'men', 'category' => 'Sports']) }}">Sports</a>
            <ul class="sub-submenu">
                <li><a href="{{ route('products.index', ['gender' => 'men', 'category' => 'Sports', 'subcategory' => 'Climbing']) }}">Climbing</a></li>
                <li><a href="{{ route('products.index', ['gender' => 'men', 'category' => 'Sports', 'subcategory' => 'Running']) }}">Running</a></li>
                <li><a href="{{ route('products.index', ['gender' => 'men', 'category' => 'Sports', 'subcategory' => 'Football']) }}">Football</a></li>
                <li><a href="{{ route('products.index', ['gender' => 'men', 'category' => 'Sports', 'subcategory' => 'Basketball']) }}">Basketball</a></li>
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

        <!-- Women category menu -->
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
            <a href="{{ route('products.index', ['gender' => 'women', 'category' => 'Sports']) }}">Sports</a>
            <ul class="sub-submenu">
                <li><a href="{{ route('products.index', ['gender' => 'women', 'category' => 'Sports', 'subcategory' => 'Climbing']) }}">Climbing</a></li>
                <li><a href="{{ route('products.index', ['gender' => 'women', 'category' => 'Sports', 'subcategory' => 'Running']) }}">Running</a></li>
                <li><a href="{{ route('products.index', ['gender' => 'women', 'category' => 'Sports', 'subcategory' => 'Volleyball']) }}">Volleyball</a></li>
                <li><a href="{{ route('products.index', ['gender' => 'women', 'category' => 'Sports', 'subcategory' => 'Basketball']) }}">Basketball</a></li>
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

        <!-- Accessories category menu -->
        <li class="menu-item">
        <a href="#" class="menu-link">Accessories</a>
        <ul class="submenu">
            <li class="submenu-title"><a href="{{ route('products.index', ['category' => 'Accessories']) }}">Accessories</a></li>
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



      <!-- search -->
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

      <!-- right navbar actions -->
      <ul class="navbar-actions">
        <li><a href="{{ route('register') }}" class="btn-login">Sign up</a></li>
        <li><a href="{{ route('profile.edit') }}" class="profile-link" aria-label="My profile"><img src="{{ asset('images/profile.jpg') }}" alt=""
              aria-hidden="true"></a></li>
        <li><a href="{{ route('cart.index') }}" class="cart-link" aria-label="Shopping cart"><img src="{{ asset('images/shoping-cart.png') }}" alt=""
              aria-hidden="true"></a></li>
      </ul>

    </nav>
  </header>

  <!-- ASIDE – FILTRE -->
  <aside aria-label="Filtrovanie produktov">
  <form method="GET" action="{{ route('products.index') }}">
    <section>
      <h2>Categories</h2>

      @if(request('gender'))
        <input type="hidden" name="gender" value="{{ request('gender') }}">
      @endif

      @if(request('category'))
        <input type="hidden" name="category" value="{{ request('category') }}">
      @endif

      @if(request('subcategory'))
        <input type="hidden" name="subcategory" value="{{ request('subcategory') }}">
      @endif
      
      <details open>
        <summary>Sports</summary>
        <fieldset>
          <legend class="sr-only">Typ športu</legend>
          <label class="filter-check">
            <input type="checkbox" name="sport[]" value="Tennis" {{ in_array('Tennis', request('sport', [])) ? 'checked' : '' }} />
            tennis
          </label>
          <label class="filter-check">
            <input type="checkbox" name="sport[]" value="Football" {{ in_array('Football', request('sport', [])) ? 'checked' : '' }} />
            football
          </label>
          <label class="filter-check">
            <input type="checkbox" name="sport[]" value="Basketball" {{ in_array('Basketball', request('sport', [])) ? 'checked' : '' }} />
            basketball
          </label>
          <label class="filter-check">
            <input type="checkbox" name="sport[]" value="Running" {{ in_array('Running', request('sport', [])) ? 'checked' : '' }} />
            running
          </label>
          <label class="filter-check">
            <input type="checkbox" name="sport[]" value="Cycling" {{ in_array('Cycling', request('sport', [])) ? 'checked' : '' }} />
            cycling
          </label>
        </fieldset>
      </details>
    </section>

    <section>
      <h2>Price range</h2>
      <fieldset class="price-range">
        <legend class="sr-only">Cenový rozsah</legend>

        <label for="price-from">From</label>
        <input
          type="number"
          id="price-from"
          name="price_from"
          min="0"
          placeholder="€ 0"
          value="{{ request('price_from') }}"
        />

        <label for="price-to">To</label>
        <input
          type="number"
          id="price-to"
          name="price_to"
          max="9999"
          placeholder="€ 250"
          value="{{ request('price_to') }}"
        />
      </fieldset>
    </section>

    <section>
      <h2>Colors</h2>

      <fieldset class="filter-colors">
        <legend class="sr-only">Product color</legend>

        @php
          $selectedColors = request('color', []);

          if (!is_array($selectedColors)) {
              $selectedColors = [$selectedColors];
          }

          $colors = [
              'black' => ['#2a2a2a', 'Black'],
              'darkgray' => ['#666666', 'Dark gray'],
              'gray' => ['#b0b0b0', 'Gray'],
              'lightgray' => ['#d9d9d9', 'Light gray'],
              'white' => ['#ffffff', 'White'],
              'blue' => ['#3b6fd4', 'Blue'],
              'red' => ['#d43b3b', 'Red'],
              'green' => ['#3b9e5e', 'Green'],
          ];
        @endphp

        @foreach ($colors as $value => [$hex, $label])
          <label
            class="color-swatch"
            style="--c: {{ $hex }}; --border: {{ $value === 'white' ? '#d0d0d0' : 'transparent' }};"
            title="{{ $label }}"
            aria-label="{{ $label }}"
          >
            <input
              type="checkbox"
              name="color[]"
              value="{{ $value }}"
              {{ in_array($value, $selectedColors) ? 'checked' : '' }}
            >
          </label>
        @endforeach
      </fieldset>
    </section>

    <section>
      <h2>Size</h2>

      <fieldset class="filter-sizes">
        <legend class="sr-only">Size</legend>

        @php
          $selectedSizes = request('size', []);

          if (!is_array($selectedSizes)) {
              $selectedSizes = [$selectedSizes];
          }

          $sizes = ['XS', 'S', 'M', 'L', 'XL', 'XXL'];
        @endphp

        @foreach ($sizes as $size)
          <label class="size-option">
            <input
              type="checkbox"
              name="size[]"
              value="{{ $size }}"
              {{ in_array($size, $selectedSizes) ? 'checked' : '' }}
            >
            {{ $size }}
          </label>
        @endforeach

      </fieldset>
    </section>

        <button type="submit" class="btn-filter">Apply filters</button>
    </form>
  </aside>

  <!-- MAIN – PRODUKTY -->
  <main>
    <header>
      <h1>All products</h1>

      <p class="product-count">
        <strong>{{ $products->count() }}</strong> products
      </p>

      <label for="sort-by" class="sr-only">Sort by</label>
      <form id="product-filters" method="GET" action="{{ route('products.index') }}">

        {{-- keep existing filters --}}
        @foreach(request()->except('sort') as $key => $value)
            @if(is_array($value))
                @foreach($value as $v)
                    <input type="hidden" name="{{ $key }}[]" value="{{ $v }}">
                @endforeach
            @else
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endif
        @endforeach

        <select id="sort-by" name="sort" onchange="this.form.submit()">
          <option value="popular" {{ request('sort', 'popular') === 'popular' ? 'selected' : '' }}>
            Most popular
          </option>

          <option value="price-asc" {{ request('sort') === 'price-asc' ? 'selected' : '' }}>
            Price: Low to High
          </option>

          <option value="price-desc" {{ request('sort') === 'price-desc' ? 'selected' : '' }}>
            Price: High to Low
          </option>

          <option value="newest" {{ request('sort') === 'newest' ? 'selected' : '' }}>
            Newest
          </option>
        </select>
      </form>
    </header>
    <section class="product-grid" aria-label="Zoznam produktov">
        @forelse ($products as $product)
            <article class="card">
                <a href="{{ route('productpage', $product->variant_id) }}">
                    <figure>
                        <img
                            src="{{ $product->image_path ? asset($product->image_path) : asset('images/no-image.png') }}"
                            alt="{{ $product->name }}"
                            loading="lazy"
                        />
                    </figure>
                </a>

                <h3>
                    <a href="{{ route('productpage', $product->variant_id) }}">
                        {{ $product->name }} - {{ $product->color }}
                    </a>
                </h3>

                <footer>
                    <p class="price">
                        {{ number_format($product->price, 2, ',', ' ') }} €
                    </p>
                </footer>
            </article>
        @empty
            <p>No products found.</p>
        @endforelse
    </section>

    <nav class="pagination" aria-label="Stránkovanie">
      <a href="#" class="page-arrow" aria-label="Predchádzajúca strana" aria-disabled="true">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
          stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true">
          <polyline points="15 18 9 12 15 6" />
        </svg>
      </a>
      <ol>
        <li><a href="#" class="page-num" aria-current="page">1</a></li>
        <li><a href="#" class="page-num">2</a></li>
        <li><a href="#" class="page-num">3</a></li>
        <li><a href="#" class="page-num">4</a></li>
        <li><a href="#" class="page-num">5</a></li>
        <li><a href="#" class="page-num">6</a></li>
        <li><a href="#" class="page-num">7</a></li>
        <li><a href="#" class="page-num">8</a></li>
        <li><a href="#" class="page-num">9</a></li>
        <li><a href="#" class="page-num">10</a></li>
      </ol>
      <a href="#" class="page-arrow" aria-label="Nasledujúca strana">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
          stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true">
          <polyline points="9 18 15 12 9 6" />
        </svg>
      </a>
    </nav>
  </main>

  <!-- FOOTER -->
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
</body>

</html>
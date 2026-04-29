<!DOCTYPE html>
<html>

<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  @vite([
    'resources/css/reset.css',
    'resources/css/newnav.css',
    'resources/css/productpage.css',
    'resources/css/footer.css'
  ])
</head>

<body>
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
          <a href="#" class="menu-link">Men</a>
          <ul class="submenu">
            <li class="submenu-title"><a href="listofproduct.html">Men</a></li>
            <li class="submenu-item"><a href="listofproduct.html">Clothes</a>
              <ul class="sub-submenu">
                <li><a href="listofproduct.html">T-shirt</a></li>
                <li><a href="listofproduct.html">Pants</a></li>
                <li><a href="listofproduct.html">Hoodies</a></li>
                <li><a href="listofproduct.html">Underwear</a></li>
              </ul>
            </li>
            <li class="submenu-item"><a href="listofproduct.html">Shoes</a>
              <ul class="sub-submenu">
                <li><a href="listofproduct.html">Running shoes</a></li>
                <li><a href="listofproduct.html">Sport shoes</a></li>
                <li><a href="listofproduct.html">Climbing shoes</a></li>
                <li><a href="listofproduct.html">Open shoes</a></li>
              </ul>
            </li>
            <li class="submenu-item"><a href="listofproduct.html">Sports</a>
              <ul class="sub-submenu">
                <li><a href="listofproduct.html">Climbing</a></li>
                <li><a href="listofproduct.html">Running</a></li>
                <li><a href="listofproduct.html">Football</a></li>
                <li><a href="listofproduct.html">Basketball</a></li>
              </ul>
            </li>
            <li class="submenu-item"><a href="listofproduct.html">Accessories</a>
              <ul class="sub-submenu">
                <li><a href="listofproduct.html">Caps & hats</a></li>
                <li><a href="listofproduct.html">Bags & backpacks</a></li>
                <li><a href="listofproduct.html">Socks</a></li>
                <li><a href="listofproduct.html">Watches</a></li>
              </ul>
            </li>
          </ul>
        </li>

        <!-- Women category menu -->
        <li class="menu-item">
          <a href="#" class="menu-link">Women</a>
          <ul class="submenu">
            <li class="submenu-title"><a href="listofproduct.html">Women</a></li>
            <li class="submenu-item"><a href="listofproduct.html">Clothes</a>
              <ul class="sub-submenu">
                <li><a href="listofproduct.html">Tops</a></li>
                <li><a href="listofproduct.html">Pants</a></li>
                <li><a href="listofproduct.html">Jackets</a></li>
                <li><a href="listofproduct.html">Underwear</a></li>
              </ul>
            </li>
            <li class="submenu-item"><a href="listofproduct.html">Shoes</a>
              <ul class="sub-submenu">
                <li><a href="listofproduct.html">Running shoes</a></li>
                <li><a href="listofproduct.html">Sport shoes</a></li>
                <li><a href="listofproduct.html">Climbing shoes</a></li>
                <li><a href="listofproduct.html">Open shoes</a></li>
              </ul>
            </li>
            <li class="submenu-item"><a href="listofproduct.html">Sports</a>
              <ul class="sub-submenu">
                <li><a href="listofproduct.html">Climbing</a></li>
                <li><a href="listofproduct.html">Running</a></li>
                <li><a href="listofproduct.html">Volleyball</a></li>
                <li><a href="listofproduct.html">Basketball</a></li>
              </ul>
            </li>
            <li class="submenu-item"><a href="listofproduct.html">Accessories</a>
              <ul class="sub-submenu">
                <li><a href="listofproduct.html">Caps & hats</a></li>
                <li><a href="listofproduct.html">Bags & backpacks</a></li>
                <li><a href="listofproduct.html">Socks</a></li>
                <li><a href="listofproduct.html">Watches</a></li>
              </ul>
            </li>
          </ul>
        </li>

        <!-- Accessories category menu -->
        <li class="menu-item">
          <a href="#" class="menu-link">Accessories</a>
          <ul class="submenu">
            <li class="submenu-title"><a href="listofproduct.html">Accessories</a></li>
            <li class="submenu-item">
              <ul class="sub-submenu">
                <li><a href="listofproduct.html">Bags & backpacks</a></li>
                <li><a href="listofproduct.html">Sunglasses</a></li>
                <li><a href="listofproduct.html">Gloves</a></li>
                <li><a href="listofproduct.html">Hats & caps</a></li>
                <li><a href="listofproduct.html">Water bottles</a></li>
              </ul>
            </li>
          </ul>
        </li>
      </ul>

      <!-- search -->
      <search class="navbar-search" role="search">
        <img src="{{ asset('images/magnifying-glass.png') }}" alt="" class="navbar-search-icon" aria-hidden="true">
        <input type="search" id="site-search" class="navbar-search-input" placeholder="Search" autocomplete="off">
      </search>

      <!-- right navbar actions -->
      <ul class="navbar-actions">
        <li><a href="{{ route('register') }}" class="btn-login">Sign up</a></li>
        <li><a href="{{ route('profile.edit') }}" class="profile-link" aria-label="My profile"><img src="{{ asset('images/profile.jpg') }}" alt=""
              aria-hidden="true"></a></li>
        <li><a href="cart.html" class="cart-link" aria-label="Shopping cart"><img src="{{ asset('images/shoping-cart.png') }}" alt=""
              aria-hidden="true"></a></li>
      </ul>

    </nav>
  </header>


  <section class="product-detail-section">
    <div class="product-detail-container">

      <div class="product-left">
        <img id="mainProductImage" src="{{ asset('images/Homepage/SALE-1.png') }}" alt="Product" class="product-detail-image">

        <div class="image-controls">
          <button type="button" class="arrow-btn" id="prevImage">←</button>
          <button type="button" class="arrow-btn" id="nextImage">→</button>
        </div>
      </div>

      <div class="product-right">
        <h1 class="product-detail-title">La Sportiva Theory</h1>

        <p class="product-detail-description">
          Extreme sensitivity combined with high dynamism allows the Theory to have unprecedented pedidextarity and
          reactivity on holds.
          Climbers looking to take their comp style to the next level need look no further.
          An aggressive yet ultra-sensitive slipper with a single hook and loop closure locks the heel in.
          They offer top to bottom sticky rubber and an all-new hybrid sole that combines No-Edge features to adapt to
          the futuristic footwork required for modern competition climbing.
        </p>

        <hr>

        <p class="product-detail-price">100,50 $</p>

        <div class="product-buttons">
          <label class="size-select-wrap">
            <span class="visually-hidden">Select size</span>
            <select class="size-select" name="size" aria-label="Select size">
              <option value="" selected disabled>Size</option>
              <option value="s">S</option>
              <option value="m">M</option>
              <option value="l">L</option>
              <option value="xl">XL</option>
              <option value="xxl">XXL</option>
            </select>
          </label>

          <div class="quantity-box">
            <button type="button" class="arrow-btn">-</button>
            <p class="product-amount">10</p>
            <button type="button" class="arrow-btn">+</button>
          </div>

          <button type="button" class="tocart-btn">Add to cart</button>
        </div>

      </div>
  </section>



  <section class="details-section">
    <h2 class="details-title">Detailed description</h2>

    <div class="table-wrapper">
      <table class="details-table">
        <tr>
          <td>Material</td>
          <td>Rubber</td>
          <td>Weight</td>
          <td>200g</td>
        </tr>
        <tr>
          <td>Color</td>
          <td>Black/Yellow/Red</td>
          <td>Brand</td>
          <td>La Sportiva</td>
        </tr>
        <tr>
          <td>Type</td>
          <td>Climbing shoes</td>
          <td>Closure</td>
          <td>Velcro</td>
        </tr>
        <tr>
          <td>Usage</td>
          <td>Indoor/Outdoor</td>
          <td>Level</td>
          <td>Advanced</td>
        </tr>
      </table>
    </div>
  </section>

  <section class="others-section" id="others">

    <h2 class="others-title">Other like this</h2>

    <div class="others-grid">
      <a href="#" class="others-card">
        <img src="src/Homepage/SALE-1.png" class="others-image img-fluid">
        <p class="others-text">La Sportiva Theory</p>
        <p class="others-text">100,50 $</p>
      </a>

      <a href="#" class="others-card">
        <img src="src/Homepage/SALE-1.png" class="others-image img-fluid">
        <p class="others-text">La Sportiva Theory</p>
        <p class="others-text">100,50 $</p>
      </a>

      <a href="#" class="others-card">
        <img src="src/Homepage/SALE-1.png" class="others-image img-fluid">
        <p class="others-text">La Sportiva Theory</p>
        <p class="others-text">100,50 $</p>
      </a>

      <a href="#" class="others-card">
        <img src="src/Homepage/SALE-1.png" class="others-image img-fluid">
        <p class="others-text">La Sportiva Theory</p>
        <p class="others-text">100,50 $</p>
      </a>

      <a href="#" class="others-card">
        <img src="src/Homepage/SALE-1.png" class="others-image img-fluid">
        <p class="others-text">La Sportiva Theory</p>
        <p class="others-text">100,50 $</p>
      </a>
    </div>
  </section>

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
    const images = [
      "{{ asset('images/Homepage/SALE-1.png') }}",
      "{{ asset('images/Homepage/intro-image.png') }}",
      "{{ asset('images/Logo.png') }}"
    ];

    let currentImageIndex = 0;

    const mainImage = document.getElementById("mainProductImage");
    const prevButton = document.getElementById("prevImage");
    const nextButton = document.getElementById("nextImage");

    nextButton.addEventListener("click", function () {
      currentImageIndex++;

      if (currentImageIndex >= images.length) {
        currentImageIndex = 0;
      }

      mainImage.src = images[currentImageIndex];
    });

    prevButton.addEventListener("click", function () {
      currentImageIndex--;

      if (currentImageIndex < 0) {
        currentImageIndex = images.length - 1;
      }

      mainImage.src = images[currentImageIndex];
    });
  </script>
</body>
</html>

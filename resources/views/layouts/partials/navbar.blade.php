<nav class="navbar {{ request()->is('/') ? 'transparent' : 'solid' }}" id="navbar" data-transparent="{{ request()->is('/') ? 'true' : 'false' }}">
  <div class="container">
    <div class="navbar-inner">

      <!-- Logo -->
      <a href="{{ route('home') }}" class="navbar-logo">
        <div class="logo-icon">🍩</div>
        <div>
          <div class="logo-text">Do<span>Fren</span></div>
          <div class="logo-tagline">Premium Donut</div>
        </div>
      </a>

      <!-- Desktop Nav -->
      <ul class="navbar-nav">
        <li>
          <a href="{{ route('home') }}"
             class="nav-link {{ request()->is('/') ? 'active' : '' }}">Home</a>
        </li>
        <li>
          <a href="{{ route('menu.index') }}"
             class="nav-link {{ request()->is('menu*') ? 'active' : '' }}">Menu</a>
        </li>
        <li>
          <a href="{{ route('order.index') }}"
             class="nav-link {{ request()->is('pesan*') ? 'active' : '' }}">Pesan</a>
        </li>
        <li>
          <a href="{{ route('location.index') }}"
             class="nav-link {{ request()->is('lokasi*') ? 'active' : '' }}">Lokasi</a>
        </li>
      </ul>

      <!-- Actions -->
      <div class="navbar-actions">
        <!-- Cart Button -->
        <button class="cart-btn" data-open-cart aria-label="Keranjang belanja">
          <i class="ri-shopping-basket-line"></i>
          <span class="cart-count" id="navCartCount">0</span>
        </button>
        <a href="{{ route('order.index') }}" class="btn btn-primary btn-sm">
          <i class="ri-shopping-cart-line"></i> Pesan Sekarang
        </a>
        <!-- Hamburger -->
        <button class="hamburger" id="hamburger" aria-label="Menu">
          <span></span>
          <span></span>
          <span></span>
        </button>
      </div>

    </div>
  </div>
</nav>

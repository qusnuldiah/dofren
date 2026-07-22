<div class="mobile-menu" id="mobileMenu">
  <nav class="mobile-nav">
    <a href="{{ route('home') }}" class="mobile-nav-link {{ request()->is('/') ? 'active' : '' }}">
      <i class="ri-home-4-line" style="margin-right:8px"></i> Home
    </a>
    <a href="{{ route('menu.index') }}" class="mobile-nav-link {{ request()->is('menu*') ? 'active' : '' }}">
      <i class="ri-restaurant-line" style="margin-right:8px"></i> Menu
    </a>
    <a href="{{ route('order.index') }}" class="mobile-nav-link {{ request()->is('pesan*') ? 'active' : '' }}">
      <i class="ri-shopping-cart-line" style="margin-right:8px"></i> Pesan Online
    </a>
    <a href="{{ route('location.index') }}" class="mobile-nav-link {{ request()->is('lokasi*') ? 'active' : '' }}">
      <i class="ri-map-pin-line" style="margin-right:8px"></i> Lokasi
    </a>
    <a href="{{ route('order.track') }}" class="mobile-nav-link">
      <i class="ri-file-search-line" style="margin-right:8px"></i> Lacak Pesanan
    </a>
  </nav>
  <a href="{{ route('order.index') }}" class="btn btn-primary" style="width:100%;justify-content:center">
    <i class="ri-shopping-basket-line"></i> Pesan Sekarang
  </a>
</div>

<aside class="cart-sidebar" id="cartSidebar">
  <div class="sidebar-header">
    <h2>🍩 Keranjang</h2>
    <button class="close-btn" onclick="DoFren.closeCart()" aria-label="Tutup keranjang">
      <i class="ri-close-line"></i>
    </button>
  </div>

  <div class="sidebar-body" id="sidebarCartBody">
    <div class="cart-empty">
      <div class="cart-empty-icon">🍩</div>
      <p style="font-weight:600;color:var(--dark);margin-bottom:8px">Keranjang Kosong</p>
      <p style="font-size:13px">Yuk tambahkan donat favoritmu!</p>
      <a href="/menu" class="btn btn-primary btn-sm" style="margin-top:16px">Lihat Menu</a>
    </div>
  </div>

  <div class="sidebar-footer">
    <div class="cart-total" style="margin-bottom:16px">
      <span style="font-size:14px;color:var(--text-muted)">Total Belanja</span>
      <span style="font-size:22px;font-weight:700;color:var(--primary);font-family:var(--font-heading)" id="sidebarTotal">Rp 0</span>
    </div>
    <a href="{{ route('order.index') }}" class="btn btn-primary" style="width:100%;justify-content:center">
      <i class="ri-shopping-cart-check-line"></i> Lanjut Checkout
    </a>
    <button onclick="DoFren.closeCart()" class="btn btn-secondary" style="width:100%;justify-content:center;margin-top:10px">
      Lanjut Belanja
    </button>
  </div>
</aside>

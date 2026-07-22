<footer class="footer">
  <div class="container">
    <div class="footer-grid">

      <!-- Brand -->
      <div class="footer-brand">
        <a href="{{ route('home') }}" class="navbar-logo" style="margin-bottom:16px;display:inline-flex">
          <div class="logo-icon">🍩</div>
          <div style="margin-left:10px">
            <div class="logo-text" style="color:white">Do<span>Fren</span></div>
            <div class="logo-tagline">Premium Donut</div>
          </div>
        </a>
        <p class="footer-desc">
          Donat handcrafted premium dengan bahan pilihan. Dibuat dengan cinta setiap hari,
          dikirim langsung ke tangan Anda.
        </p>
        <div class="social-links">
          <a href="#" class="social-link" aria-label="Instagram">
            <i class="ri-instagram-line"></i>
          </a>
          <a href="#" class="social-link" aria-label="TikTok">
            <i class="ri-tiktok-line"></i>
          </a>
          <a href="#" class="social-link" aria-label="Facebook">
            <i class="ri-facebook-fill"></i>
          </a>
          <a href="#" class="social-link" aria-label="WhatsApp">
            <i class="ri-whatsapp-line"></i>
          </a>
        </div>
      </div>

      <!-- Menu Links -->
      <div>
        <h4 class="footer-col-title">Menu</h4>
        <ul class="footer-links">
          <li><a href="{{ route('menu.index') }}?kategori=original" class="footer-link"><i class="ri-arrow-right-s-line"></i>Original</a></li>
          <li><a href="{{ route('menu.index') }}?kategori=glazed" class="footer-link"><i class="ri-arrow-right-s-line"></i>Glazed</a></li>
          <li><a href="{{ route('menu.index') }}?kategori=premium" class="footer-link"><i class="ri-arrow-right-s-line"></i>Premium</a></li>
          <li><a href="{{ route('menu.index') }}?kategori=minuman" class="footer-link"><i class="ri-arrow-right-s-line"></i>Minuman</a></li>
        </ul>
      </div>

      <!-- Info -->
      <div>
        <h4 class="footer-col-title">Informasi</h4>
        <ul class="footer-links">
          <li><a href="{{ route('order.index') }}" class="footer-link"><i class="ri-arrow-right-s-line"></i>Pesan Online</a></li>
          <li><a href="{{ route('location.index') }}" class="footer-link"><i class="ri-arrow-right-s-line"></i>Lokasi Kami</a></li>
          <li><a href="{{ route('order.track') }}" class="footer-link"><i class="ri-arrow-right-s-line"></i>Lacak Pesanan</a></li>
          <li><a href="#" class="footer-link"><i class="ri-arrow-right-s-line"></i>Promo & Diskon</a></li>
        </ul>
      </div>

      <!-- Contact -->
      <div>
        <h4 class="footer-col-title">Kontak</h4>
        <ul class="footer-links">
          <li>
            <a href="tel:021-5678-1234" class="footer-link">
              <i class="ri-phone-line" style="color:var(--primary)"></i>021-5678-1234
            </a>
          </li>
          <li>
            <a href="https://wa.me/628111234567" class="footer-link" target="_blank">
              <i class="ri-whatsapp-line" style="color:#25D366"></i>0811-1234-567
            </a>
          </li>
          <li>
            <a href="mailto:halo@dofren.id" class="footer-link">
              <i class="ri-mail-line" style="color:var(--primary)"></i>halo@dofren.id
            </a>
          </li>
          <li style="color:rgba(255,255,255,0.5);font-size:13px;margin-top:4px">
            <i class="ri-time-line" style="margin-right:6px;color:var(--accent)"></i>Buka 07:00 – 23:00
          </li>
        </ul>
      </div>

    </div><!-- /footer-grid -->

    <div class="footer-bottom">
      <p class="footer-copy">
        &copy; {{ date('Y') }} <span>DoFren Donut</span>. Dibuat dengan 🍩 untuk para pencinta donat.
      </p>
      <div style="display:flex;gap:16px;font-size:13px;color:rgba(255,255,255,0.4)">
        <a href="#" style="color:rgba(255,255,255,0.4)">Privacy Policy</a>
        <a href="#" style="color:rgba(255,255,255,0.4)">Terms of Service</a>
      </div>
    </div>
  </div>
</footer>

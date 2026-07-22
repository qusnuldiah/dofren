@extends('layouts.app')

@section('title', $product->name)
@section('meta_desc', Str::limit($product->description, 160))

@section('content')

<div class="page-header" style="padding-bottom:48px">
  <div class="container page-header-inner">
    <h1>{{ $product->name }}</h1>
    <nav class="breadcrumb">
      <a href="{{ route('home') }}">Home</a>
      <i class="ri-arrow-right-s-line"></i>
      <a href="{{ route('menu.index') }}">Menu</a>
      <i class="ri-arrow-right-s-line"></i>
      <a href="{{ route('menu.index') }}?kategori={{ $product->category->slug }}">{{ $product->category->name }}</a>
      <i class="ri-arrow-right-s-line"></i>
      <span>{{ $product->name }}</span>
    </nav>
  </div>
</div>

<section class="section" style="background:var(--light)">
  <div class="container">
    <div class="product-detail-grid">

      {{-- Image --}}
      <div data-aos="fade-right">
        <div class="product-detail-img-wrap">
          <img
            src="https://images.unsplash.com/photo-1551024601-bec78aea704b?w=800&q=80"
            alt="{{ $product->name }}"
            class="product-detail-img"
            id="productMainImg"
          >
        </div>
        {{-- Thumbnail row --}}
        <div style="display:flex;gap:12px;margin-top:16px">
          @foreach(['1551024601-bec78aea704b','1565299585323-38d6b0865b47','1578985545062-69928b1d9587'] as $photo)
          <img
            src="https://images.unsplash.com/photo-{{ $photo }}?w=120&q=70"
            alt="thumbnail"
            style="width:80px;height:80px;border-radius:12px;object-fit:cover;cursor:pointer;border:2px solid var(--gray-200);transition:var(--transition)"
            onclick="document.getElementById('productMainImg').src='https://images.unsplash.com/photo-{{ $photo }}?w=800&q=80';this.style.borderColor='var(--primary)'"
          >
          @endforeach
        </div>
      </div>

      {{-- Content --}}
      <div data-aos="fade-left">
        {{-- Badges --}}
        <div style="display:flex;gap:8px;flex-wrap:wrap;margin-bottom:16px">
          <span class="badge" style="background:var(--light-warm);color:var(--primary);font-size:13px;padding:6px 14px">
            {{ $product->category->icon }} {{ $product->category->name }}
          </span>
          @if($product->is_bestseller)
            <span class="badge badge-bestseller">🔥 Bestseller</span>
          @endif
          @if($product->is_new)
            <span class="badge badge-new">✨ Produk Baru</span>
          @endif
          @if(!$product->is_available)
            <span class="badge badge-discount">Habis</span>
          @endif
        </div>

        <h1 style="font-size:clamp(24px,4vw,36px);font-weight:800;color:var(--dark);margin-bottom:16px">{{ $product->name }}</h1>

        <p style="font-size:16px;color:var(--text-muted);line-height:1.7;margin-bottom:24px">{{ $product->description }}</p>

        {{-- Price --}}
        <div class="product-detail-price">
          {{ $product->formatted_price }}
          @if($product->price_original)
            <span class="original">{{ $product->formatted_price_original }}</span>
            <span class="badge badge-discount" style="font-size:14px;vertical-align:middle;margin-left:8px">
              Hemat {{ $product->discount_percent }}%
            </span>
          @endif
        </div>

        {{-- Nutrition --}}
        @if($product->calories)
        <div class="nutrition-info">
          <i class="ri-fire-line" style="color:var(--primary);font-size:20px"></i>
          <div>
            <strong>{{ $product->calories }} kalori</strong> per sajian
          </div>
        </div>
        @endif

        {{-- Ingredients --}}
        @if($product->ingredients)
        <div style="background:var(--light-warm);border-radius:var(--radius-md);padding:16px 20px;margin-bottom:24px">
          <div style="font-size:13px;font-weight:700;color:var(--dark);margin-bottom:8px">
            <i class="ri-list-check" style="color:var(--primary)"></i> Bahan Utama
          </div>
          <div style="font-size:14px;color:var(--text-muted)">{{ $product->ingredients }}</div>
        </div>
        @endif

        {{-- Qty Selector --}}
        @if($product->is_available)
        <div style="margin-bottom:24px">
          <label style="font-size:14px;font-weight:600;color:var(--dark);display:block;margin-bottom:10px">Jumlah</label>
          <div class="qty-selector">
            <button type="button" class="qty-btn" onclick="DetailPage.changeQty(-1)">−</button>
            <span class="qty-num" id="detailQty">1</span>
            <button type="button" class="qty-btn" onclick="DetailPage.changeQty(1)">+</button>
          </div>
        </div>

        <div style="display:flex;gap:12px;flex-wrap:wrap">
          <button
            class="btn btn-primary btn-lg"
            onclick="DetailPage.addToCart()"
            style="flex:1;justify-content:center">
            <i class="ri-shopping-cart-line"></i>
            Tambah ke Keranjang — <span id="detailPrice">{{ $product->formatted_price }}</span>
          </button>
          <a href="{{ route('order.index') }}" class="btn btn-dark btn-lg" style="justify-content:center">
            <i class="ri-lightning-fill"></i> Pesan Langsung
          </a>
        </div>
        @else
        <div style="background:#FEE2E2;border-radius:var(--radius-md);padding:16px 20px;color:#DC2626;font-weight:600">
          <i class="ri-close-circle-line"></i> Produk ini sedang tidak tersedia
        </div>
        @endif

        {{-- Share --}}
        <div style="margin-top:24px;display:flex;align-items:center;gap:12px">
          <span style="font-size:13px;color:var(--text-muted)">Bagikan:</span>
          <button onclick="navigator.share ? navigator.share({title:'{{ $product->name }}',url:window.location.href}) : navigator.clipboard.writeText(window.location.href).then(()=>DoFren.showToast('Link Disalin!','',  'success'))"
                  class="btn btn-sm" style="background:var(--gray-100);color:var(--dark)">
            <i class="ri-share-line"></i> Share
          </button>
        </div>
      </div>

    </div>

    {{-- Related Products --}}
    @if($relatedProducts->count() > 0)
    <div style="margin-top:80px">
      <div class="section-header" style="margin-bottom:40px">
        <div class="section-badge">🍩 Mungkin Kamu Suka</div>
        <h2 class="section-title">Produk <span>Serupa</span></h2>
      </div>

      <div class="products-grid products-grid-4">
        @foreach($relatedProducts as $related)
        <div class="product-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}">
          <div class="product-img-wrap" style="height:180px">
            <img
              src="https://images.unsplash.com/photo-{{ ['1551024601-bec78aea704b','1565299585323-38d6b0865b47','1578985545062-69928b1d9587','1571506165871-ee72a35bc9d4'][$loop->index % 4] }}?w=400&q=80"
              alt="{{ $related->name }}" class="product-img" loading="lazy">
            @if($related->is_bestseller)<div class="product-badges"><span class="badge badge-bestseller">🔥 Bestseller</span></div>@endif
          </div>
          <div class="product-body">
            <h3 class="product-name">
              <a href="{{ route('menu.show', $related->slug) }}" style="color:inherit">{{ $related->name }}</a>
            </h3>
            <div class="product-footer">
              <span class="price-current">{{ $related->formatted_price }}</span>
              <button class="add-cart-btn"
                onclick="DoFren.addToCart({id:{{ $related->id }},name:'{{ addslashes($related->name) }}',price:{{ $related->price }},image:'https://picsum.photos/seed/{{ $related->slug }}/80/80'})">
                <i class="ri-add-line"></i>
              </button>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
    @endif

  </div>
</section>

@endsection

@push('scripts')
<script>
const DetailPage = {
  qty: 1,
  price: {{ $product->price }},
  product: {
    id: {{ $product->id }},
    name: '{{ addslashes($product->name) }}',
    price: {{ $product->price }},
    image: 'https://picsum.photos/seed/{{ $product->slug }}/80/80'
  },

  changeQty(delta) {
    this.qty = Math.max(1, this.qty + delta);
    document.getElementById('detailQty').textContent = this.qty;
    document.getElementById('detailPrice').textContent =
      'Rp ' + (this.price * this.qty).toLocaleString('id-ID');
  },

  addToCart() {
    for (let i = 0; i < this.qty; i++) {
      DoFren.addToCart(this.product);
    }
    // If added more than 1, fix the count
    if (this.qty > 1) {
      const item = DoFren.cart.find(c => c.id === this.product.id);
      if (item) {
        item.qty = this.qty + (item.qty - this.qty);
        DoFren.saveCart();
      }
    }
    DoFren.openCart();
  }
};
</script>
@endpush

@extends('layout')

@php
  $tint = [
    'Cake Besar'  => ['#ffe3f0','#ffb3d6'],
    'Brudel'      => ['#fff3c4','#ffd45e'],
    'Cake Kecil'  => ['#f0e6ff','#d3b8ff'],
    'Cake Sedang' => ['#ffe9dc','#ffbf9a'],
    'Cake Coklat' => ['#f6e4d8','#d9a583'],
  ];
@endphp

@section('hero')
<section class="hero">
  <div class="hero-in">
    <div>
      <h1 class="fx" style="--d:.05s">Kelezatan Bolu Wanderpan & Cake Spesial <span class="hl">Penuh Cinta</span></h1>
      <p class="lead fx" style="--d:.18s">Nikmati aneka cake klasik mulai dari <b>Wanderpan 28 cm</b> rasa Zebra, Sirikaya, dan Pelangi, <b>Brudel</b>, hingga <b>Cake Coklat</b> aneka ukuran dengan pilihan topping.</p>
      <div class="info fx" style="--d:.3s">
        <img src="/logo.png" alt="Mom Sitty">
        <div><i>"Jazakallah Khairan Syukron Katsiran"</i><strong>Menerima Pesanan</strong></div>
        <a class="wa" href="https://wa.me/6281341591765" target="_blank" rel="noopener">WA: 0813 4159 1765</a>
      </div>
      <a class="cta fx" style="--d:.42s" href="#katalog">Lihat Katalog & Pesan
        <svg class="i" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><polyline points="19 12 12 19 5 12"/></svg>
      </a>
    </div>

    <div class="fx2" style="--d:.25s">
      <div class="visual">
        <div class="ph">
          @if(file_exists(public_path('images/hero.jpg')))
            <img src="/images/hero.jpg" alt="Kue buatan Mom Sitty">
          @else
            <div class="hero-placeholder" aria-hidden="true"><span></span><span></span><span></span><span></span><span></span></div>
          @endif
        </div>
        <div class="cap"><small>Freshly baked by Mom Sitty</small><span>Bolu Wanderpan · Brudel · Cake Coklat</span></div>
      </div>
    </div>
  </div>

  <div class="feats">
    <ul>
      <li class="reveal" style="--d:0ms"><span class="ic"><svg class="i" viewBox="0 0 24 24"><polygon points="12 2 2 7 12 12 22 7 12 2"/><polyline points="2 17 12 22 22 17"/><polyline points="2 12 12 17 22 12"/></svg></span><div><b>Aneka Ukuran</b><span class="s">Dari 16 hingga 28 cm</span></div></li>
      <li class="reveal" style="--d:90ms"><span class="ic"><svg class="i" viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg></span><div><b>Pilihan Topping</b><span class="s">Keju, coklat, dan kenari</span></div></li>
      <li class="reveal" style="--d:180ms"><span class="ic"><svg class="i" viewBox="0 0 24 24"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/><line x1="7" y1="7" x2="7.01" y2="7"/></svg></span><div><b>Promo Diskon 10%</b><span class="s">Beli minimal 3 item</span></div></li>
      <li class="reveal" style="--d:270ms"><span class="ic"><svg class="i" viewBox="0 0 24 24"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg></span><div><b>Pesan via WhatsApp</b><span class="s">Konfirmasi ke Mom Sitty</span></div></li>
    </ul>
  </div>
</section>
@endsection

@section('content')
<section class="sec" id="katalog">
  <span class="eyebrow reveal">Katalog Kue</span>
  <h2 class="t reveal" style="--d:60ms">Pilih kue favoritmu</h2>
  <p class="sub reveal" style="--d:120ms">Assalamualaikum bunda Sholeha. Open order insyaallah. Pilih kue, masukkan ke keranjang, lalu checkout.</p>

  <div class="chips">
    @foreach($groups as $cat => $list)
      <a href="#{{ \Illuminate\Support\Str::slug($cat) }}">{{ $cat }}</a>
    @endforeach
  </div>

  @foreach($groups as $cat => $list)
    <h2 class="cat" id="{{ \Illuminate\Support\Str::slug($cat) }}">{{ $cat }}</h2>
    <div class="grid">
      @foreach($list as $p)
        <article class="card reveal" style="--d:{{ ($loop->index % 4) * 70 }}ms;--c1:{{ $tint[$cat][0] ?? '#ffe3f0' }};--c2:{{ $tint[$cat][1] ?? '#ffb3d6' }}">
          @php $hasImg = $p->image && file_exists(public_path('images/produk/'.$p->image)); @endphp
          <div class="thumb {{ $hasImg ? 'ph' : '' }}">
            <span class="size">{{ $p->size }} cm</span>
            @if($hasImg)
              <img src="/images/produk/{{ $p->image }}" alt="{{ $p->name }} ukuran {{ $p->size }} cm" width="900" height="900" loading="lazy">
            @else
              <span class="cake-placeholder" aria-hidden="true"></span>
            @endif
          </div>
          <div class="cbody">
            <h3>{{ $p->name }}</h3>
            <small>{{ $p->note ?: 'Ukuran '.$p->size.' cm' }}</small>
            <div class="price">Rp {{ number_format($p->price,0,',','.') }}</div>
            <form class="buy" method="POST" action="{{ route('cart.add',$p) }}">@csrf
              <div class="qty"><button type="button" data-step="-1" aria-label="Kurangi">−</button><input type="number" name="qty" value="1" min="1" max="99" aria-label="Jumlah"><button type="button" data-step="1" aria-label="Tambah">+</button></div>
              <button class="btn">+ Keranjang</button>
            </form>
          </div>
        </article>
      @endforeach
    </div>
  @endforeach

  <p class="note">Catatan: untuk full topping coklat, harga kue ditambah Rp 5.000. Mohon dikonfirmasi lagi bila ada yang kurang dimengerti.</p>
</section>

<section class="sec" id="cara-pesan">
  <span class="eyebrow reveal">Cara Pesan</span>
  <h2 class="t reveal" style="--d:60ms">Pesan kue dalam 4 langkah</h2>
  <div class="steps">
    <div class="step reveal" style="--d:0ms"><div class="no">1</div><h3>Pilih Kue</h3><p>Pilih kue dan ukuran di katalog, lalu tambahkan ke keranjang.</p></div>
    <div class="step reveal" style="--d:90ms"><div class="no">2</div><h3>Dapatkan Promo</h3><p>Beli minimal 3 item, diskon 10% otomatis di keranjang.</p></div>
    <div class="step reveal" style="--d:180ms"><div class="no">3</div><h3>Checkout</h3><p>Isi nama, nomor WhatsApp, dan alamat. Pesananmu tersimpan.</p></div>
    <div class="step reveal" style="--d:270ms"><div class="no">4</div><h3>Konfirmasi WhatsApp</h3><p>Kirim ringkasan pesanan ke Mom Sitty untuk dikonfirmasi.</p></div>
  </div>
</section>
@endsection

@extends('layout') @section('content')<h2 class="cart-title">Keranjang</h2>
@if($items->isEmpty())<p>Keranjang kosong. <a href="{{ route('home') }}">Lihat menu</a></p>@else
<table><tr><th>Produk</th><th>Qty</th><th class="right">Subtotal</th><th></th></tr>
@foreach($items as $x)<tr><td>{{ $x->p->name }} uk.{{ $x->p->size }}</td><td>{{ $x->qty }}</td>
<td class="right">Rp {{ number_format($x->sub,0,',','.') }}</td>
<td><form method="POST" action="{{ route('cart.remove',$x->p) }}">@csrf<button class="btn sm">Hapus</button></form></td></tr>@endforeach
<tr><td colspan="2">Diskon promo 10%</td><td class="right">- Rp {{ number_format($t['disc'],0,',','.') }}</td><td></td></tr>
<tr class="total-row"><th colspan="2">Total</th><th class="right">Rp {{ number_format($t['total'],0,',','.') }}</th><td></td></tr></table>
@if($t['qty']>=3)<p class="promo">Selamat! Kamu mendapat diskon 10%.</p>
@else<p>Tambah {{ 3-$t['qty'] }} item lagi untuk promo diskon 10%.</p>@endif
<p><a class="btn" href="{{ route('checkout') }}">Lanjut ke Checkout →</a></p>@endif @endsection

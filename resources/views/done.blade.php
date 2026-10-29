@extends('layout') @section('content')<h2>Pesanan #{{ $o->id }} tersimpan</h2>
<div class="order-confirmation">
  <p>Total: <b>Rp {{ number_format($o->total,0,',','.') }}</b> (diskon Rp {{ number_format($o->discount,0,',','.') }}).</p>
  <p>Metode pembayaran: <b>{{ $o->paymentMethodLabel() }}</b></p>
  <p>Status pembayaran: <span class="status-badge status-menunggu">{{ $o->paymentStatusLabel() }}</span></p>
  <p>Hubungi Mom Sitty melalui WhatsApp untuk konfirmasi pesanan dan menerima detail pembayaran.</p>
  <a class="btn g" href="{{ $wa }}" target="_blank" rel="noopener">Konfirmasi via WhatsApp</a>
</div>
@endsection

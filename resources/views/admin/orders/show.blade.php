@extends('layout')

@section('content')
<section class="admin-page">
  @include('admin._nav')
  <div class="admin-heading">
    <div><span class="eyebrow">Transaksi</span><h2>Pesanan #{{ $order->number }}</h2><p class="admin-subtitle">Dibuat {{ $order->created_at->format('d M Y, H:i') }}</p></div>
    <a class="btn btn-muted" href="{{ route('admin.orders.index') }}">← Semua Pesanan</a>
  </div>

  @if(session('ok'))<div class="admin-alert">{{ session('ok') }}</div>@endif

  <div class="detail-grid">
    <section class="admin-panel">
      <div class="panel-heading"><div><h3>Informasi pelanggan</h3></div></div>
      <dl class="detail-list">
        <div><dt>Nama</dt><dd>{{ $order->customer_name }}</dd></div>
        <div><dt>WhatsApp</dt><dd><a href="https://wa.me/{{ preg_replace('/\D+/', '', $order->phone) }}" target="_blank" rel="noopener">{{ $order->phone }}</a></dd></div>
        <div><dt>Alamat</dt><dd>{{ $order->address }}</dd></div>
        @if($order->note)<div><dt>Catatan</dt><dd>{{ $order->note }}</dd></div>@endif
        <div><dt>Metode bayar</dt><dd>{{ $order->paymentMethodLabel() }}</dd></div>
        <div><dt>Status bayar</dt><dd><span class="status-badge status-{{ $order->payment_status === 'terbayar' ? 'selesai' : ($order->payment_status === 'ditolak' ? 'dibatalkan' : 'menunggu') }}">{{ $order->paymentStatusLabel() }}</span></dd></div>
      </dl>
    </section>
    <section class="admin-panel">
      <div class="panel-heading"><div><h3>Status pesanan</h3></div><span class="status-badge status-{{ $order->status }}">{{ ucfirst($order->status) }}</span></div>
      <form method="POST" action="{{ route('admin.orders.update', $order) }}">
        @csrf @method('PATCH')
        <label for="status">Perbarui status</label>
        <select id="status" name="status">
          @foreach($statuses as $status)
            <option value="{{ $status }}" @selected(old('status', $order->status) === $status)>{{ ucfirst($status) }}</option>
          @endforeach
        </select>
        @error('status')<div class="err">{{ $message }}</div>@enderror
        <label for="payment_status">Status pembayaran</label>
        <select id="payment_status" name="payment_status">
          @foreach($paymentStatuses as $paymentStatus)
            <option value="{{ $paymentStatus }}" @selected(old('payment_status', $order->payment_status) === $paymentStatus)>{{ match($paymentStatus) { 'terbayar' => 'Terkonfirmasi', 'ditolak' => 'Perlu konfirmasi ulang', default => 'Menunggu konfirmasi' } }}</option>
          @endforeach
        </select>
        @error('payment_status')<div class="err">{{ $message }}</div>@enderror
        <p class="payment-help">Pembayaran belum terhubung ke payment gateway. Konfirmasi status secara manual setelah memeriksa pembayaran.</p>
        <button class="btn">Simpan Status</button>
      </form>
    </section>
  </div>

  <section class="admin-panel order-items">
    <div class="panel-heading"><div><h3>Rincian produk</h3></div></div>
    <div class="table-wrap">
      <table class="admin-table">
        <thead><tr><th>Produk</th><th class="right">Harga</th><th class="right">Jumlah</th><th class="right">Subtotal</th></tr></thead>
        <tbody>
        @foreach($order->items as $item)
          <tr><td>{{ $item->name }}</td><td class="right">Rp {{ number_format($item->price, 0, ',', '.') }}</td><td class="right">{{ $item->qty }}</td><td class="right">Rp {{ number_format($item->price * $item->qty, 0, ',', '.') }}</td></tr>
        @endforeach
        <tr><td colspan="3">Subtotal</td><td class="right">Rp {{ number_format($order->subtotal, 0, ',', '.') }}</td></tr>
        <tr><td colspan="3">Diskon</td><td class="right">- Rp {{ number_format($order->discount, 0, ',', '.') }}</td></tr>
        <tr class="total-row"><th colspan="3">Total</th><th class="right">Rp {{ number_format($order->total, 0, ',', '.') }}</th></tr>
        </tbody>
      </table>
    </div>
  </section>
</section>
@endsection

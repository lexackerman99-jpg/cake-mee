@extends('layout')

@section('content')
<section class="admin-page">
  @include('admin._nav')
  <div class="admin-heading"><div><span class="eyebrow">Transaksi</span><h2>Pesanan</h2><p class="admin-subtitle">Lihat detail dan perbarui status pesanan pelanggan.</p></div></div>

  <form class="admin-filter" method="GET" action="{{ route('admin.orders.index') }}">
    <label for="status">Status</label>
    <select id="status" name="status">
      <option value="">Semua status</option>
      @foreach(['menunggu', 'diproses', 'selesai', 'dibatalkan'] as $option)
        <option value="{{ $option }}" @selected($status === $option)>{{ ucfirst($option) }}</option>
      @endforeach
    </select>
    <button class="btn sm">Terapkan</button>
    @if($status)<a href="{{ route('admin.orders.index') }}">Hapus filter</a>@endif
  </form>

  <div class="admin-panel">
    @if($orders->isEmpty())
      <p class="empty-state">Belum ada pesanan untuk filter ini.</p>
    @else
      <div class="table-wrap">
        <table class="admin-table">
          <thead><tr><th>No. Pesanan</th><th>Pelanggan</th><th>WhatsApp</th><th>Tanggal</th><th>Status pesanan</th><th>Pembayaran</th><th class="right">Total</th><th></th></tr></thead>
          <tbody>
          @foreach($orders as $order)
            <tr>
              <td>#{{ $order->number }}</td><td>{{ $order->customer_name }}</td>
              <td><a href="https://wa.me/{{ preg_replace('/\D+/', '', $order->phone) }}" target="_blank" rel="noopener">{{ $order->phone }}</a></td>
              <td>{{ $order->created_at->format('d M Y, H:i') }}</td>
              <td><span class="status-badge status-{{ $order->status }}">{{ ucfirst($order->status) }}</span></td>
              <td>{{ $order->paymentMethodLabel() }}<small class="table-note">{{ $order->paymentStatusLabel() }}</small></td>
              <td class="right">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
              <td><a class="btn sm" href="{{ route('admin.orders.show', $order) }}">Detail</a></td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
      <div class="pagination-wrap">{{ $orders->links('admin.pagination') }}</div>
    @endif
  </div>
</section>
@endsection

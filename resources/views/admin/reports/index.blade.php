@extends('layout')

@section('content')
<section class="admin-page">
  @include('admin._nav')
  <div class="admin-heading"><div><span class="eyebrow">Analisis</span><h2>Laporan Penjualan</h2><p class="admin-subtitle">Ringkasan transaksi untuk bulan yang dipilih. Pesanan dibatalkan tidak dihitung sebagai penjualan.</p></div></div>

  <form class="admin-filter" method="GET" action="{{ route('admin.reports.index') }}">
    <label for="month">Bulan laporan</label>
    <input id="month" type="month" name="month" value="{{ $month->format('Y-m') }}">
    <button class="btn sm">Tampilkan</button>
  </form>

  <div class="stats-grid report-stats">
    <article class="stat-card"><span>Omzet {{ $month->translatedFormat('F Y') }}</span><strong>Rp {{ number_format($revenue, 0, ',', '.') }}</strong></article>
    <article class="stat-card"><span>Total pesanan</span><strong>{{ number_format($ordersCount) }}</strong></article>
    <article class="stat-card"><span>Pesanan menunggu</span><strong>{{ number_format($pendingCount) }}</strong></article>
    <article class="stat-card"><span>Pesanan selesai</span><strong>{{ number_format($completedCount) }}</strong></article>
  </div>

  <div class="report-grid">
    <section class="admin-panel">
      <div class="panel-heading"><div><h3>Status pesanan</h3><p>Jumlah pesanan pada bulan ini.</p></div></div>
      @if($statusCounts->isEmpty())<p class="empty-state">Belum ada pesanan pada bulan ini.</p>
      @else
        <div class="report-status-list">
          @foreach(['menunggu', 'diproses', 'selesai', 'dibatalkan'] as $status)
            <div><span class="status-badge status-{{ $status }}">{{ ucfirst($status) }}</span><strong>{{ number_format($statusCounts[$status] ?? 0) }}</strong></div>
          @endforeach
        </div>
      @endif
    </section>

    <section class="admin-panel">
      <div class="panel-heading"><div><h3>Produk terlaris</h3><p>Diurutkan berdasarkan jumlah item, tidak termasuk pesanan batal.</p></div></div>
      @if($topProducts->isEmpty())<p class="empty-state">Belum ada penjualan pada bulan ini.</p>
      @else
        <div class="table-wrap">
          <table class="admin-table">
            <thead><tr><th>Produk</th><th class="right">Terjual</th><th class="right">Nilai kotor</th></tr></thead>
            <tbody>@foreach($topProducts as $product)
              <tr><td>{{ $product->name }}</td><td class="right">{{ number_format($product->quantity) }}</td><td class="right">Rp {{ number_format($product->gross_sales, 0, ',', '.') }}</td></tr>
            @endforeach</tbody>
          </table>
        </div>
      @endif
    </section>
  </div>
</section>
@endsection

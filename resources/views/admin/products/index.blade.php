@extends('layout')

@section('content')
<section class="admin-page">
  @include('admin._nav')
  <div class="admin-heading">
    <div><span class="eyebrow">Katalog</span><h2>Kelola Produk</h2><p class="admin-subtitle">Tambah, perbarui, atau hapus produk yang tampil di katalog.</p></div>
    <a class="btn" href="{{ route('admin.products.create') }}">+ Tambah Produk</a>
  </div>

  @if(session('ok'))<div class="admin-alert">{{ session('ok') }}</div>@endif

  <form class="admin-filter" method="GET" action="{{ route('admin.products.index') }}">
    <input name="search" value="{{ $search }}" placeholder="Cari nama atau kategori produk" aria-label="Cari produk">
    <button class="btn sm">Cari</button>
    @if($search)<a href="{{ route('admin.products.index') }}">Hapus filter</a>@endif
  </form>

  <div class="admin-panel">
    @if($products->isEmpty())
      <p class="empty-state">Produk tidak ditemukan.</p>
    @else
      <div class="table-wrap">
        <table class="admin-table">
          <thead><tr><th>Produk</th><th>Kategori</th><th>Ukuran</th><th class="right">Harga</th><th>Aksi</th></tr></thead>
          <tbody>
          @foreach($products as $product)
            <tr>
              <td><strong>{{ $product->name }}</strong>@if($product->note)<small class="table-note">{{ $product->note }}</small>@endif</td>
              <td>{{ $product->category }}</td>
              <td>{{ $product->size }} cm</td>
              <td class="right">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
              <td><div class="table-actions">
                <a class="btn sm" href="{{ route('admin.products.edit', $product) }}">Edit</a>
                <form method="POST" action="{{ route('admin.products.destroy', $product) }}" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">@csrf @method('DELETE')<button class="btn sm btn-danger">Hapus</button></form>
              </div></td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
      <div class="pagination-wrap">{{ $products->links('admin.pagination') }}</div>
    @endif
  </div>
</section>
@endsection

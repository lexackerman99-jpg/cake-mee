@extends('layout')

@section('content')
<section class="admin-page">
  @include('admin._nav')
  <div class="admin-heading">
    <div><span class="eyebrow">Katalog</span><h2>{{ $product->exists ? 'Edit Produk' : 'Tambah Produk' }}</h2><p class="admin-subtitle">Lengkapi detail produk di bawah ini.</p></div>
  </div>

  <form class="admin-panel product-form" method="POST" enctype="multipart/form-data" action="{{ $product->exists ? route('admin.products.update', $product) : route('admin.products.store') }}">
    @csrf
    @if($product->exists) @method('PUT') @endif
    <label for="name">Nama produk</label>
    <input id="name" name="name" value="{{ old('name', $product->name) }}" required maxlength="255">
    @error('name')<div class="err">{{ $message }}</div>@enderror

    <div class="form-grid">
      <div><label for="category">Kategori</label><input id="category" name="category" value="{{ old('category', $product->category) }}" required maxlength="100">@error('category')<div class="err">{{ $message }}</div>@enderror</div>
      <div><label for="size">Ukuran (cm)</label><input id="size" name="size" type="number" min="1" max="150" value="{{ old('size', $product->size) }}" required>@error('size')<div class="err">{{ $message }}</div>@enderror</div>
    </div>

    <label for="price">Harga (Rp)</label>
    <input id="price" name="price" type="number" min="1000" max="100000000" step="1000" value="{{ old('price', $product->price) }}" required>
    @error('price')<div class="err">{{ $message }}</div>@enderror

    <label for="note">Catatan produk <span class="opt">(opsional)</span></label>
    <textarea id="note" name="note" rows="3" maxlength="255">{{ old('note', $product->note) }}</textarea>
    @error('note')<div class="err">{{ $message }}</div>@enderror

    <label for="image">Foto produk <span class="opt">(JPG, PNG, atau WEBP, maks. 4 MB)</span></label>
    <input id="image" name="image" type="file" accept=".jpg,.jpeg,.png,.webp">
    @error('image')<div class="err">{{ $message }}</div>@enderror
    @if($product->image)
      <p class="current-image">Foto saat ini: <strong>{{ $product->image }}</strong></p>
      <label class="check"><input type="checkbox" name="remove_image" value="1"> Hapus foto saat ini</label>
    @endif

    <div class="form-actions"><a class="btn btn-muted" href="{{ route('admin.products.index') }}">Batal</a><button class="btn">{{ $product->exists ? 'Simpan Perubahan' : 'Tambah Produk' }}</button></div>
  </form>
</section>
@endsection

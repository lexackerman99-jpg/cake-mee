@extends('layout')
@section('content')
<div class="box">
  <h2>Masuk</h2>
  <p class="hint">Masuk untuk klaim promo diskon 10%.</p>
  <form method="POST" action="{{ route('login.submit') }}">@csrf
    <label>Email</label>
    <input type="email" name="email" value="{{ old('email') }}" autofocus>
    @error('email')<div class="err">{{ $message }}</div>@enderror
    <label>Password</label>
    <input type="password" name="password">
    <button class="btn">Masuk</button>
    <p>Belum punya akun? <a href="{{ route('register') }}">Daftar</a></p>
  </form>
</div>
@endsection

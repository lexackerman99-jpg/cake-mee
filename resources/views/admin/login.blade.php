@extends('layout')

@section('content')
<div class="box auth-box">
  <h2>Login Admin</h2>
  <p class="hint">Akses panel admin Cake & Mee Mom Sitty.</p>

  <form method="POST" action="{{ route('admin.login.submit') }}">@csrf
    <label>Email</label>
    <input type="email" name="email" value="{{ old('email') }}" autocomplete="username" autofocus>
    @error('email')<div class="err">{{ $message }}</div>@enderror

    <label>Password</label>
    <input type="password" name="password" autocomplete="current-password">
    @error('password')<div class="err">{{ $message }}</div>@enderror

    <button class="btn">Masuk sebagai admin</button>
  </form>

</div>
@endsection

@extends('layouts.loginRegister')
@section('content')
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <img src="{{asset('img/logo.png')}}" width="60" style="margin-left:128px;">
      <br>
      <p class="login-box-msg"> BKD Kab balangan</p>

      <form action="../../index3.html" method="post">
        <div class="input-group mb-3">
        <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" username="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
            @error('username')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" username="password" required autocomplete="new-password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
        <input id="password-confirm" type="password" class="form-control" username="password_confirmation" required autocomplete="new-password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
            <input class="form-check-input" type="checkbox" username="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
              <label for="remember">
                ingat Saya
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <br>
      <br>
      <p class="mb-0 text-center">
        <a href="register.html" class="text-center">belum Punya Akun ? klik disni ... </a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
@endsection

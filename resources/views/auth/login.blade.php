<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>

  <!-- Bootstrap 5 CSS -->
  <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/login.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/login.css') }}" rel="stylesheet">
</head>
<body>

<div class="container d-flex justify-content-center align-items-center min-vh-100">
  <div class="card shadow-sm w-100" style="max-width: 420px;">
    <div class="card-body p-4">
      <img src="{{ asset('uploads/logo/logo.png') }}" class="logo" width="247" height="auto" alt="Logo" class="mb-4">
      <h3 class="mb-3 text-center">Welcome Back</h3>
      <p class="mb-4 text-center text-muted login-desc">Log in to access your dashboard and manage your data securely.</p>
    
        {{-- Validation Errors --}}
      {{-- Session Status (e.g., password reset link sent) --}}
      @if (session('status'))
        <div class="alert alert-success" role="alert">
          {{ session('status') }}
        </div>
      @endif

      <form method="POST" action="{{ route('login') }}" novalidate>
        @csrf

        {{-- Email --}}
        <div class="mb-3">
          <div class="position-relative">
          <i class="bi bi-c-circle position-absolute top-50 start-0 translate-middle-y ms-2"></i>
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                autocomplete="username"
                autofocus
                class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                placeholder="Email Address"
                required
            >
          </div>

          @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        {{-- Password --}}
        <div class="mb-3">
            <div class="position-relative">
          <i class="bi bi-lock-fill position-absolute top-50 start-0 translate-middle-y ms-2"></i>
            <input
                id="password"
                type="password"
                name="password"
                value="{{ old('password') }}"
                autocomplete="current-password"
                class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
                placeholder="Password"
                required
            >
          </div>
          @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        {{-- Remember Me --}}
        <div class="mb-3 form-check">
          <input
            id="remember_me"
            type="checkbox"
            name="remember"
            class="form-check-input"
            {{ old('remember') ? 'checked' : '' }}
          >
          <label class="form-check-label remember-me-label" for="remember_me">Remember me</label>
        </div>

        {{-- Actions --}}
        <div class="d-flex justify-content-between align-items-center">
          <button type="submit" class="btn btn-primary w-100">
            Log in
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Bootstrap 5 JS (optional, for components) -->
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>

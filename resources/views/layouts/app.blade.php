<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Bootstrap 5 CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/layouts.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">
</head>
<body>
    <div class="main-wrapper">
        <div id="sidebar">
            <div class="sidebar-header">
                <img src="{{ asset('uploads/logo/logo-white.png') }}" class="logo" alt="Logo" width="165" height="auto">
                <button class="btn-close btn-close-white" aria-label="Close" id="sidebarClose"></button>
            </div>
            <hr class="sidebar-divider m-0">
            <div class="navbar-list-container">
                <ul class="list-unstyled sidebar-lists">
                    <li class="{{ request()->is('dashboard') ? 'active' : '' }}">
                        <span><i class="bi bi-grid-1x2-fill"></i></span>
                        <a href="{{ url('/dashboard') }}">Dashboard</a>
                    </li>
                    <p>Data Management</p>
                    <li class="{{ request()->is('dashboard/complete-data*') ? 'active' : '' }}">
                        <span><i class="bi bi-clipboard-data"></i></span>
                        <a href="{{ url('/dashboard/complete-data') }}">Complete Data</a>
                    </li>
                    <li class="">
                        <span><i class="bi bi-clipboard-x"></i></span>
                        <a href="">Incomplete Data</a>
                    </li>
                    <p>Admin Panel</p>
                    <li class="{{ request()->is('dashboard/users*') ? 'active' : '' }}">
                        <span><i class="bi bi-people"></i></span>
                        <a href="{{ url('/dashboard/users') }}">User management</a>
                    </li>
                    <li class="{{ request()->is('dashboard/logs*') ? 'active' : '' }}">
                        <span><i class="bi bi-clock-history"></i></span>
                        <a href="{{ url('/dashboard/logs') }}">Activity Log</a>
                    </li>
                    <li class="{{ request()->is('dashboard/settings*') ? 'active' : '' }}">
                        <span><i class="bi bi-gear"></i></span>
                        <a href="{{ url('/dashboard/settings') }}">Settings</a>
                    </li>
                    <div class="d-md-none d-block">
                        <p>User Details</p>
                        <li class="">
                            <span><i class="bi bi-person"></i></span>
                            <a href="#">Profile</a>
                        </li>
                        <li class="">
                            <span><i class="bi bi-key-fill"></i></span>
                            <a href="#">Change Password</a>
                        </li>
                        <li class="">
                            <span><i class="bi bi-journal-text"></i></span>
                            <a href="#" onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                
                            </a>
                        </li>
                    </div>
                </ul>
                
            </div>
            
            <div class="sidebar-footer">
                <h4 class="sidebar-footer-title">© {{ date('Y') }} {{ config('app.name', 'Laravel') }}</h4>
                <p class="sidebar-footer-description">All Rights Reserved. Made with love by Vereigen Media!</p>
            </div>
        </div>
        <div id="content">
            <nav class="navbar navbar-expand-md navbar-light shadow-sm">
                <div class="container-fluid container-content">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggle" aria-controls="navbarToggle" aria-expanded="false" aria-label="Toggle navigation" id="sidebarToggler">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navbarToggle">
                        <ul class="navbar-nav mb-2 mb-lg-0 gap-3">
                            <li class="nav-item">
                                <div class="dropdown">
                                    <a class="dropdown-toggle" type="button" id="notificationmenu" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-bell"></i>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="notificationmenu">
                                        <ul>
                                            <li><a class="dropdown-item" href="#">Action</a></li>
                                            <li><a class="dropdown-item" href="#">Another action</a></li>
                                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item">
                                <div class="nav-profile-card dropdown">
                                    <div class="dropdown-toggle" type="button" id="profilemenu" data-bs-toggle="dropdown" aria-expanded="false">
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="profile-container">
                                                <img src="{{ asset('uploads/logo/profile.svg') }}" alt="Profile" class="profile-image">
                                            </div>
                                            <div class="profile-details">
                                                <h2>{{ Auth::user()->name }}</h2>
                                                <p>{{ Auth::user()->role->name }}</p>
                                            </div>
                                            <i class="bi bi-chevron-down"></i>
                                        </div>
                                    </div>
                                    <div class="dropdown-menu" aria-labelledby="profilemenu">
                                        <ul>
                                            <li><a class="dropdown-item" href="#">Profile</a></li>
                                            <li><a class="dropdown-item" href="#">Settings</a></li>
                                            <li><a class="dropdown-item" href="#">Logout</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="container-fluid">
                <nav class="breadcrumb m-0" aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#">@yield('title')</a></li>
                    </ol>
                </nav>
                <div class="title-button-container">
                    <div class="pagetitle">
                        <h2 class="page-title mb-0">@yield('title')</h2>
                        <p class="page-subtitle">@yield('subtitle')</p>
                    </div>
                    <div class="action-button">
                        @if (isset($actionbutton))
                            {!! $actionbutton !!}
                        @endif
                    </div>
                </div>
                @yield('content')
            </div>
        </div>
    </div>

    @include('components.alert-modals')

    <!-- Bootstrap 5 JS (optional, for components) -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        window.addEventListener('load', function () {
            $(document).ready(function () {
                const sidebar = $('#sidebar');
                const app = $('#content');
                $('#sidebarToggler').on('click', function () {
                    sidebar.removeClass('slideout').addClass('slidein').show();
                    app.addClass('no-scroll-app');
                });

                $('#sidebarClose').on('click', function () {
                    sidebar.removeClass('slidein').addClass('slideout');
                    app.removeClass('no-scroll-app');
                    setTimeout(() => {
                        sidebar.hide();
                    }, 1000);
                });
            });
        });
    </script>
    @stack('scripts')
</body>
</html>
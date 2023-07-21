<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title_page')</title>

    <!-- Favicon -->
    <link rel="favicon icon" href="{{ asset('assets/img/ponpes.ico') }}" type="image/x-icon">  

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.min.css') }}">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('assets/modules/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/ponpes-style.css') }}">

    <!-- CSS Custom -->
    <style>
        #cash-table tbody tr td {
            text-align: center
        }
    </style>
</head>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                    </ul>
                </form>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            @if (Auth::user()->santri_id == null || Auth::user()->santris->photo == null)
                                <img alt="image" src="{{ asset('assets/img/avatar/avatar-1.png') }}" class="rounded-circle mr-1">
                            @else                                
                                <img alt="image" src="{{ asset('storage/photo/' . Auth::user()->santris->photo) }}" class="rounded-circle mr-1"                            
                                style="position: relative;width: 30px;height: 30px;overflow: hidden;">
                            @endif
                            <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::user()->santris->name }}</div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="{{ route('santri.show', Auth::user()->santris->id) }}" class="dropdown-item has-icon">
                                <i class="fas fa-user"></i> Profil
                            </a>

                            <div class="dropdown-divider"></div>

                            <a class="dropdown-item has-icon text-danger" href="{{ route('logout') }}#"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}#" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </nav>

            @include('layouts.sidebar')

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1>@yield('title_page')</h1>
                    </div>

                    <div class="section-body">
                        <div class="card">
                            <div class="p-3">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <!-- End Main Content -->

            @include('layouts.footer')

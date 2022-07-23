<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="index.html">
            <span class="sidebar-brand-text align-middle">
                SPECTATE
                <sup><small class="badge bg-primary text-uppercase">Pro</small></sup>
            </span>
            <svg class="sidebar-brand-icon align-middle" width="32px" height="32px" viewBox="0 0 24 24" fill="none"
                stroke="#FFFFFF" stroke-width="1.5" stroke-linecap="square" stroke-linejoin="miter" color="#FFFFFF"
                style="margin-left: -3px">
                <path d="M12 4L20 8.00004L12 12L4 8.00004L12 4Z"></path>
                <path d="M20 12L12 16L4 12"></path>
                <path d="M20 16L12 20L4 16"></path>
            </svg>
        </a>

        <div class="sidebar-user">
            <div class="d-flex justify-content-center">
                <div class="flex-shrink-0">

                    <img src="
                    {{ asset('admin_assets/img/avatars/avatar.jpg') }} "class="avatar img-fluid rounded me-1"
                        alt="Charles Hall" />


                </div>
                <div class="flex-grow-1 ps-2">
                    <a class="sidebar-user-title dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        {{-- {{ Auth::user()->name }} --}}
                    </a>
                    <div class="dropdown-menu dropdown-menu-start">
                        <a class="dropdown-item" href="pages-profile.html"><i class="align-middle me-1"
                                data-feather="user"></i> Profile</a>
                        <form method="POST" action="#">
                            @csrf
                            <button class="dropdown-item">Log out</button>
                        </form>
                    </div>

                    <div class="sidebar-user-subtitle">
                        Admin
                    </div>
                </div>
            </div>
        </div>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Pages
            </li>

            {{-- <li class="sidebar-item {{ Request::routeIs('dashboard') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('dashboard') }}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li> --}}
            <li class="sidebar-item {{ Request::routeIs('dashboard') ? 'active' : '' }}"><a class="sidebar-link"
                    href="{{ route('dashboard') }}"> <i class="align-middle" data-feather="layout"></i>Dashboard</a>
            </li>
            <li class="sidebar-item">
                <a data-bs-target="#pages-transaksi" data-bs-toggle="collapse" class="sidebar-link">
                    <i class="align-middle" data-feather="credit-card"></i> <span class="align-middle">Manajemen
                        Tiket</span>
                </a>
                <ul id="pages-transaksi" class="sidebar-dropdown list-unstyled collapse show" data-bs-parent="#sidebar">
                    <li class="sidebar-item {{ Request::routeIs('ticket') ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('ticket') }}">Tambah Event</a></li>
                    <li class="sidebar-item {{ Request::routeIs('ticket_type') ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('ticket_type') }}">Tambah Tipe Tiket</a></li>
                    <li class="sidebar-item {{ Request::routeIs('item') ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('item') }}">Tambah Tiket</a></li>

                </ul>
            </li>
            <li class="sidebar-item {{ Request::routeIs('buyer') ? 'active' : '' }}"><a class="sidebar-link"
                    href="{{ route('buyer') }}"> <i class="align-middle" data-feather="user"></i>Pembeli</a>
            </li>
            <li class="sidebar-item {{ Request::routeIs('invoice') ? 'active' : '' }}"><a class="sidebar-link"
                    href="{{ route('invoice') }}"> <i class="align-middle" data-feather="dollar-sign"></i>Transaksi</a>
            </li>
            <li class="sidebar-item {{ Request::routeIs('payment_method') ? 'active' : '' }}"><a class="sidebar-link"
                    href="{{ route('payment_method') }}"> <i class="align-middle" data-feather="credit-card"></i>Metode Pembayaran</a>
            </li>




            </li>
        </ul>


</nav>

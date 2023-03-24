<!-- Navbar Atas -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                <i class="fas fa-bars"></i>
                <!-- <img src="{{ asset('template/dist/img/Logo.png') }}" style="max-width:100%; max-height:100%"/> -->
            </a>
        </li>
    </ul>
    <ul class="navbar-nav">
        <li class="nav-item">
            <div class="row">
                <div class="col-12"><b>BULGARIA MANAGEMENT SYSTEM</b></div>
                <div class="col-12">Bulgaria Jewellery</div>
            </div>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a href="#" class="nav-link" data-toggle="modal" data-target="#modal-logout">
            Logout &nbsp<i class="fas fa-sign-out-alt"></i>
            </a>
        </li>
    </ul>
</nav>
<!-- /.navbar atas -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4 layout-fixed">
    <!-- <img src="{{ asset('template/dist/img/Logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-link brand-text font-weight-light" style="padding-left: 10%;"><b>BMS</b>&nbsp | Bulgaria</span> -->
    <div class="brand-link">
      <img src="{{ asset('template/dist/img/Logo.png') }}" class="brand-image img-circle elevation-3">
      <span class="brand-text font-weight-bold"><b>BMS</b>&nbsp</span> | Bulgaria
    </div>

    <!-- Nama User -->
    <div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
        <a class="d-block">Welcome, <b>{{ Auth::user()->NamaUser }}</b></a>
        </div>
    </div>

    <!-- Search Menu -->
    <div class="form-inline">
    <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
        <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
        </button>
        </div>
    </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        
        <li class="nav-item">
            <a href="/dashboard" class="nav-link {{ request()->is('dashboard*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i><p>Dashboard</p>
            </a>
        </li>

        <!-- General Setup -->
        @if(Auth::user()->IDLevel != 3)
        <li class="nav-header">General Setup</li>
            @if(Auth::user()->IDLevel == 1)
            <li class="nav-item">
                <a href="/user/setup" class="nav-link {{ request()->is('user/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-user"></i><p>Setup User</p>
                </a>
            </li>
            @endif
        <li class="nav-item">
            <a href="/article/type" class="nav-link {{ request()->is('article/type*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-gem"></i><p>Setup Item Type</p>
            </a>
        </li>
            @if(Auth::user()->IDLevel == 1)
            <li class="nav-item">
                <a href="/allocation/setup" class="nav-link {{ request()->is('allocation/setup*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-box-open"></i><p>Setup Allocation</p>
                </a>
            </li>
            @endif
        @endif

        <!-- Master Data -->
        <li class="nav-header">Master Data</li>
        <li class="nav-item">
            <a href="/customer/setup" class="nav-link {{ request()->is('customer/*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-users"></i><p>Customer</p>
            </a>
        </li>
        @if(Auth::user()->IDLevel != 3)
        <li class="nav-item">
            <a href="/supplier/setup" class="nav-link {{ request()->is('supplier/*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-briefcase"></i><p>Supplier</p>
            </a>
        </li>
        @endif

        <!-- Transaction -->
        @if(Auth::user()->IDLevel == 1 || Auth::user()->IDLevel == 2)
        <li class="nav-header">Transaction</li>
        <li class="nav-item">
            <a href="/transaction/po" class="nav-link {{ request()->is('transaction/po*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-cart-plus"></i><p>Purchase Order</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/transaction/sales" class="nav-link {{ request()->is('transaction/sales*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-file-invoice-dollar"></i><p>Sales Order</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/transaction/co" class="nav-link {{ request()->is('transaction/co*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-toolbox" ></i><p>Custom Order</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/buyback" class="nav-link {{ request()->is('buyback*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-exchange-alt" ></i><p>Buy Back</p>
            </a>
        </li>
        @else
        <li class="nav-header">Transaction</li>
        <li class="nav-item">
            <a href="/transaction/sales/create" class="nav-link {{ request()->is('transaction/sales*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-file-invoice-dollar"></i><p>Sales Order</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/transaction/co/create" class="nav-link {{ request()->is('transaction/co*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-toolbox" ></i><p>Custom Order</p>
            </a>
        </li>
        @endif

        <!-- Article -->
        <li class="nav-header">Item Information</li>
        <li class="nav-item {{ request()->is('storages*') ? 'menu-open' : (request()->is('article/list*') ? 'menu-open' : (request()->is('mutation*') ? 'menu-open' : '')) }}">
            <a href="#" class="nav-link {{ request()->is('storages*') ? 'active' : (request()->is('article/list*') ? 'active' : '') }}">
                <i class="nav-icon fas fa-gem"></i>
                <p>Item
                   <i class="fas fa-angle-left right"></i>
                </p>
            </a>

            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="/article/list" class="nav-link {{ request()->is('article/list*') ? 'active' : ''  }}">
                    <i class="nav-icon fas fa-gem"></i><p>Item List</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/storages" class="nav-link {{ request()->is('storages*') ? 'active' : (request()->is('article/update*') ? 'active' : '') }}">
                    <i class="nav-icon fas fa-warehouse"></i><p>Storage</p>
                    </a>
                </li>
                @if(Auth::user()->IDLevel != 3)
                <li class="nav-item">
                    <a href="/mutation" class="nav-link {{ request()->is('mutation*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-recycle"></i><p>Stock Mutation</p>
                    </a>
                </li>
                @endif
            </ul>
        </li>

        <!-- GL -->
        @if(Auth::user()->IDLevel != 3)
        <li class="nav-header">General Ledger</li>
        <li class="nav-item">
            <a href="/gl" class="nav-link {{ request()->is('gl*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-book"></i><p>General Ledger Entries</p>
            </a>
        </li>
        @endif

        <!-- Log -->
        @if(Auth::user()->IDLevel != 3)
        <!-- <li class="nav-header">Log</li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-file"></i>
                <p>Log Transaction
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>

            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="#" class="nav-link">
                    <i class="nav-icon far fa-circle"></i><p>User Logs</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                    <i class="nav-icon far fa-circle"></i><p>Article Logs</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                    <i class="nav-icon far fa-circle"></i><p>Storage Logs</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                    <i class="nav-icon far fa-circle"></i><p>Customer Logs</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                    <i class="nav-icon far fa-circle"></i><p>Supplier Logs</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/log/co" class="nav-link {{ request()->is('log/co') ? 'active' : '' }}">
                    <i class="nav-icon far fa-circle"></i><p>Custom Order Logs</p>
                    </a>
                </li>
            </ul>
        </li> -->
        @endif

        <li class="nav-item">&nbsp</li>
        </ul>
    </nav>
    </div>
</aside>
@php
    $path = explode('/', Request::path());
@endphp
<aside class="sidebar">
    <button type="button" class="sidebar-close-btn">
        <iconify-icon icon="radix-icons:cross-2"></iconify-icon>
    </button>
    <div>
        <a href="index.html" class="sidebar-logo">
            <img src="{{ asset('assets/images/logo.png') }}" alt="site logo" class="light-logo">
            <img src="{{ asset('assets/images/logo-light.png') }}" alt="site logo" class="dark-logo">
            <img src="{{ asset('assets/images/logo-icon.png') }}" alt="site logo" class="logo-icon w-11">
        </a>
    </div>
    <div class="sidebar-menu-area grid content-between">
        <ul class="sidebar-menu gap-1" id="sidebar-menu">
            <li class="{{ $path == 'dashboard-admin' ? 'active-page show open' : '' }}">
                <a href="{{ route('admin.dashboard-admin') }}"
                    class="{{ $path == 'dashboard-admin' ? 'active-page' : '' }}">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="menu-icon"></iconify-icon>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="">
                <a href="javascript:void(0)">
                    <iconify-icon icon="mdi:report-box-outline" class="menu-icon"></iconify-icon>
                    <span>Laporan</span>
                </a>
                <ul class="sidebar-submenu" style="display: block; padding-top: 0">
                    <li class="{{ $path == 'tunggakan' ? 'active-page show open' : '' }}">
                        <a href="{{ route('admin.tunggakan') }}"
                            class="{{ $path == 'tunggakan' ? 'active-page' : '' }}">
                            <iconify-icon icon="mdi:invoice-clock-outline" class="menu-icon"></iconify-icon>
                            <span>Tagihan</span>
                        </a>
                    </li>

                    <li class="{{ $path == 'transaksi' ? 'active-page show open' : '' }}">
                        <a href="{{ route('admin.transaksi') }}"
                            class="{{ $path == 'transaksi' ? 'active-page' : '' }}">
                            <iconify-icon icon="tdesign:undertake-transaction" class="menu-icon"></iconify-icon>
                            <span>Transaksi</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="{{ $path == 'warga' ? 'active-page show open' : '' }}">
                <a href="{{ route('admin.warga') }}" class="{{ $path == 'warga' ? 'active-page' : '' }}">
                    <iconify-icon icon="mdi:users-outline" class="menu-icon"></iconify-icon>
                    <span>Warga</span>
                </a>
            </li>

            <li class="{{ $path == 'umkm' ? 'active-page show open' : '' }}">
                <a href="{{ route('admin.umkm') }}" class="{{ $path == 'umkm' ? 'active-page' : '' }}">
                    <iconify-icon icon="material-symbols:shopping-cart" class="menu-icon"></iconify-icon>
                    <span>UMKM</span>
                </a>
            </li>

            <li class="{{ $path == 'user' ? 'active-page show open' : '' }}">
                <a href="{{ route('admin.user') }}" class="{{ $path == 'user' ? 'active-page' : '' }}">
                    <iconify-icon icon="mdi:user" class="menu-icon"></iconify-icon>
                    <span>User</span>
                </a>
            </li>
        </ul>
        <div class="flex py-2 px-10 rounded-lg gap-4 bg-[#F5FBF7] shadow-md shadow-zinc-500 logo-bottom-sidebar-open">
            <img src="{{ asset('assets/images/pemkot.png') }}" class="w-[48px] h-[48px]" alt="">
            <img src="{{ asset('assets/images/makassar.png') }}" class="w-[48px] h-[48px]" alt="">
        </div>
        <div class="grid py-2 px-1 rounded-lg bg-[#F5FBF7] shadow-md shadow-zinc-500 logo-bottom-sidebar-reopen">
            <img src="{{ asset('assets/images/pemkot.png') }}" class="w-[38px] h-[38px]" alt="">
            <img src="{{ asset('assets/images/makassar.png') }}" class="mt-2 w-[38px] h-[38px]" alt="">
        </div>
    </div>
</aside>

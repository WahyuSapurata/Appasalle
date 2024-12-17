{{-- Bottom Menu --}}
@php
    $path = explode('/', Request::path());
@endphp

<div class="flex justify-center">
    <div id="menu-user"
        class="fixed bottom-6 flex items-center justify-between w-[344px] gap-2 rounded-3xl p-2 bg-[#E9EFEC] shadow-lg">
        <a href="{{ route('kolektor.dashboard-kolektor') }}"
            class="grid w-[76px] text-center {{ in_array('dashboard-kolektor', $path) ? 'user-active' : '' }}">
            <div class="py-1 rounded-2xl flex items-center justify-center item-user">
                <iconify-icon icon="ic:outline-home"
                    class="text-[25px] {{ in_array('dashboard-kolektor', $path) ? '' : 'text-[#3F4945]' }}"></iconify-icon>
            </div>
            <div class="{{ in_array('dashboard-kolektor', $path) ? '' : 'text-[#3F4945]' }} text-[10px] mt-1">Beranda
            </div>
        </a>
        <a href="{{ route('kolektor.transaksi') }}" id="menu-user" class="grid w-[76px] text-center">
            <div class="{{ in_array('transaksi', $path) ? 'user-active' : '' }}">
                <div class="py-1 rounded-2xl flex items-center justify-center item-user">
                    <iconify-icon icon="tabler:transaction-dollar" width="24" height="24"
                        class="{{ in_array('transaksi', $path) ? '' : 'text-[#3F4945]' }}"></iconify-icon>
                </div>
                <div class="{{ in_array('transaksi', $path) ? '' : 'text-[#3F4945]' }} text-[10px] mt-1">Transaksi</div>
            </div>
        </a>
        <a href="{{ route('kolektor.warga') }}" id="menu-user" class="grid w-[76px] text-center">
            <div class="{{ in_array('warga', $path) ? 'user-active' : '' }}">
                <div class="py-1 rounded-2xl flex items-center justify-center item-user">
                    <iconify-icon icon="ion:people" width="24" height="24"
                        class="{{ in_array('warga', $path) ? '' : 'text-[#3F4945]' }}"></iconify-icon>
                </div>
                <div class="{{ in_array('warga', $path) ? '' : 'text-[#3F4945]' }} text-[10px] mt-1">Warga</div>
            </div>
        </a>
    </div>
</div>

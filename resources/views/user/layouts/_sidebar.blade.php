{{-- Bottom Menu --}}
@php
    $path = explode('/', Request::path());
@endphp

<div class="flex justify-center">
    <div id="menu-user"
        class="fixed bottom-6 flex items-center justify-between w-[344px] gap-2 rounded-3xl p-2 bg-[#E9EFEC] shadow-lg">
        <a href="{{ route('user.dashboard-user') }}"
            class="grid w-[76px] text-center {{ in_array('dashboard-user', $path) ? 'user-active' : '' }}">
            <div class="py-1 rounded-2xl flex items-center justify-center item-user">
                <iconify-icon icon="ic:outline-home"
                    class="text-[25px] {{ in_array('dashboard-user', $path) ? '' : 'text-[#3F4945]' }}"></iconify-icon>
            </div>
            <div class="{{ in_array('dashboard-user', $path) ? '' : 'text-[#3F4945]' }} text-[10px] mt-1">Beranda</div>
        </a>
        <a href="{{ route('user.tagihan') }}" id="menu-user" class="grid w-[76px] text-center">
            <div class="{{ in_array('tagihan', $path) ? 'user-active' : '' }}">
                <div class="py-1 rounded-2xl flex items-center justify-center item-user">
                    <iconify-icon icon="uiw:copy"
                        class="text-[20px] {{ in_array('tagihan', $path) ? '' : 'text-[#3F4945]' }}"></iconify-icon>
                </div>
                <div class="{{ in_array('tagihan', $path) ? '' : 'text-[#3F4945]' }} text-[10px] mt-1">Tagihan</div>
            </div>
        </a>
        <a href="{{ route('user.umkm') }}" id="menu-user" class="grid w-[76px] text-center">
            <div class="{{ in_array('umkm', $path) ? 'user-active' : '' }}">
                <div class="py-1 rounded-2xl flex items-center justify-center item-user">
                    <iconify-icon icon="material-symbols:shopping-bag-outline"
                        class="text-[24px] {{ in_array('umkm', $path) ? '' : 'text-[#3F4945]' }}"></iconify-icon>
                </div>
                <div class="{{ in_array('umkm', $path) ? '' : 'text-[#3F4945]' }} text-[10px] mt-1">UMKM</div>
            </div>
        </a>
    </div>
</div>

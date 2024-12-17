<!-- meta tags and other links -->
@section('title', $module)

@include('user.partial-html._template-top')

<div class="flex justify-center">
    <!-- Kontainer utama -->
    <div id="card-overflow" class="w-[460px] bg-[#f5fbf7] h-screen px-4 pt-4 pb-[20px] relative overflow-y-auto">

        @include('user.layouts._nav')

        <div class="grid gap-2 justify-items-center mt-3">
            <div class="w-full h-[240px] bg-gray-300 rounded-lg flex items-center justify-center">
                @if ($umkm->foto)
                    <img src="{{ asset('umkm/' . $umkm->foto) }}" class="w-full h-[240px] rounded-lg" alt="">
                @else
                    <iconify-icon icon="lucide:image" class="menu-icon text-[120px] text-gray-500"></iconify-icon>
                @endif
            </div>
            <div class="text-xl text-[#096B5A] font-normal">{{ $umkm->nama_umkm }}</div>
            <div class="text-base font-normal">{{ $umkm->alamat }}</div>
            <div class="flex gap-3">
                <!-- Tombol Telepon -->
                <a id="callButton" href="tel:{{ $umkm->telepon }}" target="_blank"
                    class="flex items-center justify-center gap-2 btn bg-[#096B5A] p-2 rounded-full">
                    <iconify-icon icon="material-symbols:call" class="menu-icon text-[24px] text-white"></iconify-icon>
                    <span class="text-white text-sm">Hubungi</span>
                </a>

                <!-- Tombol Website -->
                <a id="websiteButton" href="{{ $umkm->sosial_media }}" target="_blank"
                    class="flex items-center justify-center gap-2 btn bg-[#096B5A] p-2 rounded-full">
                    <iconify-icon icon="mdi:internet" class="menu-icon text-[24px] text-white"></iconify-icon>
                    <span class="text-white text-sm">Website</span>
                </a>
            </div>
        </div>
        <div class="text-base font-medium text-[#096B5A] mt-3">Menu</div>
        <div class="grid grid-cols-2 mt-3 gap-2 w-full">
            @forelse ($product as $item)
                <div class="col-span-1 card w-full h-[220px] border-0 rounded-lg grid shadow-lg">
                    <div class="w-full h-[168px] bg-gray-300 rounded-lg flex items-center justify-center">
                        @if ($item->foto)
                            <img src="{{ asset('menu/' . $item->foto) }}" class="w-full h-[168px] rounded-lg"
                                alt="">
                        @else
                            <iconify-icon icon="lucide:image"
                                class="menu-icon text-[100px] text-gray-500"></iconify-icon>
                        @endif
                    </div>
                    <div class="grid px-2">
                        <span class="text-[14px] font-normal">{{ $item->menu }}</span>
                        <span class="text-[10px] font-semibold">Rp {{ number_format($item->harga, 0, ',', '.') }}</span>
                    </div>
                </div>
            @empty
                <div class="col-span-2 text-4xl font-bold text-center text-slate-400 w-full">Belum ada Product</div>
            @endforelse
        </div>

    </div>
</div>

@include('user.partial-html._template-bottom')

</body>

</html>

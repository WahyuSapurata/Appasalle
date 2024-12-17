<!-- meta tags and other links -->
@section('title', $module)

@include('user.partial-html._template-top')

<div class="flex justify-center">
    <!-- Kontainer utama -->
    <div id="card-overflow" class="w-[460px] bg-[#f5fbf7] h-screen px-4 pt-4 pb-[100px] relative overflow-y-auto">

        @section('title-active', $module)
        @include('user.layouts._nav')

        <div class="grid gap-3 mt-3">

            <div class="card border-0 bg-white p-2 shadow-lg">
                <div class="grid gap-3">
                    <!-- Upload Image Start -->
                    <div class="flex justify-center">
                        <div class="avatar-upload">
                            <div class="avatar-preview">
                                <div id="imagePreview"
                                    style="background-image: url({{ asset('warga/' . auth()->guard('warga')->user()->foto) }})">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Upload Image End -->
                    <div class="grid">
                        <div class="text-[10px] font-semibold uppercase">Nama</div>
                        <div class="text-base font-normal">{{ auth()->guard('warga')->user()->nama }}</div>
                    </div>
                    <div class="grid">
                        <div class="text-[10px] font-semibold uppercase">ID PELANGGAN / NPWR</div>
                        <div class="text-base font-normal">{{ auth()->guard('warga')->user()->nprw }}</div>
                    </div>
                    <div class="grid">
                        <div class="text-[10px] font-semibold uppercase">Alamat</div>
                        <div class="text-base font-normal">{{ auth()->guard('warga')->user()->alamat }}</div>
                    </div>
                    <div class="grid grid-cols-2 gap-2">
                        <div class="grid col-span-1">
                            <div class="text-[10px] font-semibold uppercase">Rt</div>
                            <div class="text-base font-normal">{{ auth()->guard('warga')->user()->rt }}</div>
                        </div>
                        <div class="grid col-span-1">
                            <div class="text-[10px] font-semibold uppercase">Rw</div>
                            <div class="text-base font-normal">{{ auth()->guard('warga')->user()->rw }}</div>
                        </div>
                    </div>
                    <div class="grid">
                        <div class="text-[10px] font-semibold uppercase">Kelurahan</div>
                        <div class="text-base font-normal">{{ auth()->guard('warga')->user()->kelurahan }}</div>
                    </div>
                    <div class="grid">
                        <div class="text-[10px] font-semibold uppercase">jenis sampah</div>
                        <div class="text-base font-normal">{{ auth()->guard('warga')->user()->jenis_sampah }}</div>
                    </div>
                </div>
            </div>

            <div class="grid gap-5">
                <a href="{{ route('user.riwayat-transaksi') }}"
                    class="flex items-center justify-center gap-2 hover:bg-emerald-300 btn bg-transparent border border-[#096B5A] p-2">
                    <iconify-icon icon="meteor-icons:clock-rotate" class="text-[#096B5A]" width="18"
                        height="18"></iconify-icon>
                    <span class="text-xs font-medium text-[#096B5A]">Riwayat Transaksi</span>
                </a>
                <a href="{{ route('logout-user') }}"
                    class="flex items-center justify-center gap-2 hover:bg-[#FFDAD6] btn bg-transparent border border-[#BA1A1A] p-2">
                    <iconify-icon icon="material-symbols:text-select-move-back-word-rounded" class="text-[#BA1A1A]"
                        width="18" height="18"></iconify-icon>
                    <span class="text-xs font-medium text-[#BA1A1A]">Keluar</span>
                </a>
            </div>

        </div>
    </div>
</div>

@include('user.partial-html._template-bottom')

<script></script>

</body>

</html>

<!-- meta tags and other links -->
@section('title', $module)

@include('kolektor.partial-html._template-top')

<div class="flex justify-center">
    <!-- Kontainer utama -->
    <div id="card-overflow" class="w-[460px] bg-[#f5fbf7] h-screen px-4 pt-4 pb-[100px] relative overflow-y-auto">
        <!-- Header dengan gradasi -->
        <div class="absolute top-0 right-0 w-[460px] h-40 bg-gradient-to-b from-[#A1F2DC] to-[#f5fbf7]"></div>

        <!-- Header konten -->
        <div class="flex justify-between items-center mt-3 relative z-10">
            <img src="{{ asset('assets/images/logo.png') }}" alt="site logo" class="w-[157px]">
            <div class="flex items-center gap-2">
                <!-- Ikon notifikasi -->
                <iconify-icon icon="material-symbols:notifications" class="text-white text-[24px]"></iconify-icon>
                <!-- Avatar -->
                <a href="{{ route('kolektor.profil') }}">
                    <img src="{{ asset('user/' . auth()->guard('user')->user()->foto) }}" class="rounded-full w-8 h-8"
                        alt="avatar">
                </a>
            </div>
        </div>

        <div class="overflow-x-auto no-scrollbar relative z-10">
            <!-- Card 2 -->
            <div class="flex p-3 rounded-2xl w-full bg-white mt-6 gap-2 min-w-[300px] items-center">
                <img src="{{ asset('user/' . auth()->guard('user')->user()->foto) }}" class="w-11 h-11 rounded-full"
                    alt="">
                <div class="grid gap-1">
                    <div class="text-base font-normal text-[#096B5A]">{{ auth()->guard('user')->user()->name }}</div>
                    <div class="text-[10px] font-semibold text-[#00201A]">Kolektor Kelurahan
                        {{ auth()->guard('user')->user()->kelurahan }}</div>
                </div>
            </div>
        </div>

        <div class="grid gap-2 grid-cols-3 mt-4">
            <div class="col-span-1 card border-0 p-3">
                <div class="text-xs font-medium text-[#171D1B]">Target NPWR</div>
                <div class="text-base font-semibold text-[#096B5A] text-right">{{ $totalWargaLunas }}</div>
                <div class="text-[10px] font-semibold text-[#171D1B] text-right">/{{ $totalWarga }}</div>
            </div>
            <div class="col-span-1 card border-0 p-3">
                <div class="text-xs font-medium text-[#171D1B]">Menunggak</div>
                <div class="text-base font-semibold text-[#096B5A] text-right">{{ $totalWargaMenunggak }}</div>
                <div class="text-[10px] font-semibold text-[#171D1B] text-right uppercase">warga</div>
            </div>
            <div class="col-span-1 card border-0 p-3">
                <div class="text-xs font-medium text-[#171D1B]">Nominal Target</div>
                <div class="text-base font-semibold text-[#096B5A] text-right">Rp
                    {{ number_format($totalTarifLunas, 0, ',', '.') }}</div>
                <div class="text-[10px] font-semibold text-[#171D1B] text-right">/Rp
                    {{ number_format($totalTarif, 0, ',', '.') }}</div>
            </div>
        </div>

        <div class="grid mt-6 gap-2">
            <div class="col-span-2 flex items-center w-full justify-between">
                <div class="text-base font-medium text-[#171D1B]">Pembayaran Terakhir</div>
                <a href="{{ route('user.tagihan') }}" class="text-[10px] font-medium uppercase text-[#096B5A]">Lihat
                    Semua</a>
            </div>

            @forelse ($transaksiLunas->take(4) as $item_transaksi)
                <div class="col-span-2 flex w-full justify-between items-center">
                    <div class="flex items-center">
                        <img src="{{ asset('warga/' . $item_transaksi->foto) }}" alt=""
                            class="shrink-0 me-3 rounded-full w-11 h-11">
                        <div class="grid">
                            <h6 class="text-[14px] mb-0 font-normal">{{ $item_transaksi->nama }}</h6>
                            <span class="text-[10px] font-semibold">{{ $item_transaksi->nprw }}</span>
                        </div>
                    </div>
                    <div class="grid justify-items-end">
                        <div class="text-xs font-bold text-[#096B5A]">Rp
                            {{ number_format($item_transaksi->terbayarkan, 0, ',', '.') }}</div>
                        <div class="bg-[#A1F2DC] py-0 px-1 text-[10px] font-semibold w-max rounded text-[#096B5A]">
                            {{ $item_transaksi->bulan }} BULAN
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-2 text-lg font-bold text-center text-slate-400 w-full">Belum ada Data</div>
            @endforelse
        </div>

        <div class="grid mt-6 gap-2">
            <div class="col-span-2 flex items-center w-full justify-between">
                <div class="text-base font-medium text-[#171D1B]">Warga Menunggak</div>
                <a href="{{ route('user.tagihan') }}" class="text-[10px] font-medium uppercase text-[#096B5A]">Lihat
                    Semua</a>
            </div>

            @forelse ($warga->take(4) as $warga)
                <div class="col-span-2 flex w-full justify-between items-center">
                    <div class="flex items-center">
                        <img src="{{ asset('warga/' . $warga->foto) }}" alt=""
                            class="shrink-0 me-3 rounded-full w-11 h-11">
                        <div class="grid">
                            <h6 class="text-[14px] mb-0 font-normal">{{ $warga->nama }}</h6>
                            <span class="text-[10px] font-semibold">{{ $warga->nprw }}</span>
                        </div>
                    </div>
                    <div class="grid justify-items-end">
                        <div class="text-xs font-bold text-[#BA1A1A]">Rp
                            {{ number_format($warga->total_tarif, 0, ',', '.') }}</div>
                        <div class="bg-[#FFDAD6] py-0 px-1 text-[10px] font-semibold w-max rounded text-[#BA1A1A]">
                            {{ $warga->bulan }} BULAN
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-2 text-lg font-bold text-center text-slate-400 w-full">Tidak Ada Warga Menunggak
                </div>
            @endforelse
        </div>

        @include('kolektor.layouts._footer')

        @include('kolektor.layouts._sidebar')
    </div>
</div>

@include('kolektor.partial-html._template-bottom')

</body>

</html>

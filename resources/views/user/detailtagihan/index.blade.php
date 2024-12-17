<!-- meta tags and other links -->
@section('title', $module)

@include('user.partial-html._template-top')

<div class="flex justify-center">
    <!-- Kontainer utama -->
    <div id="card-overflow" class="w-[460px] bg-[#f5fbf7] h-screen px-4 pt-4 pb-[20px] relative overflow-y-auto">

        @section('title-active', $module)
        @include('user.layouts._nav')

        <div class="grid gap-3">
            <div class="relative h-[180px]">
                <img src="{{ asset('assets/images/image-transaksi.png') }}" class="absolute" alt="">
            </div>
            <div class="card border-0 bg-white shadow-lg p-2 mt-3 relative">
                <div class="grid gap-2">
                    <div class="flex items-center justify-between">
                        @if ($tagihan->status == 'Lunas')
                            <div class="flex gap-2 items-center">
                                <div class="h-6 w-6 bg-[#BFF0B1] flex items-center justify-center rounded-full">
                                    <iconify-icon icon="tabler:check"
                                        class="menu-icon text-[10px] text-[#3E6837]"></iconify-icon>
                                </div>
                                <span class="text-[10px] text-[#3E6837] font-semibold uppercase">Lunas</span>
                            </div>
                        @elseif ($tagihan->status == 'Belum Lunas')
                            <div class="flex gap-2 items-center">
                                <div class="h-6 w-6 bg-[#FFDAD6] flex items-center justify-center rounded-full">
                                    <iconify-icon icon="line-md:remove"
                                        class="menu-icon text-[10px] text-[#BA1A1A]"></iconify-icon>
                                </div>
                                <span class="text-[10px] text-[#BA1A1A] font-semibold uppercase">Belum
                                    Lunas</span>
                            </div>
                        @elseif ($tagihan->status == 'Gagal')
                            <div class="flex gap-2 items-center">
                                <div class="h-6 w-6 bg-[#FFDAD6] flex items-center justify-center rounded-full">
                                    <iconify-icon icon="line-md:remove"
                                        class="menu-icon text-[10px] text-[#BA1A1A]"></iconify-icon>
                                </div>
                                <span class="text-[10px] text-[#BA1A1A] font-semibold uppercase">Gagal</span>
                            </div>
                        @endif
                    </div>
                    <div class="grid">
                        <div class="text-[10px] font-semibold uppercase">no. tagihan</div>
                        <div class="text-base font-normal">
                            {{ $tagihan->no_tagihan . '-' . Auth::guard('warga')->user()->nprw }}</div>
                    </div>
                    <div class="grid">
                        <div class="text-[10px] font-semibold uppercase">diterbitkan</div>
                        <div class="text-base font-normal">
                            {{ \Carbon\Carbon::createFromFormat('Y m d', $tagihan->tanggal_tagihan)->formatLocalized('%e %B %Y') }}
                        </div>
                    </div>
                    <div class="grid">
                        <div class="text-[10px] font-semibold uppercase">ditagihkan ke</div>
                        <div class="text-base font-normal">{{ Auth::guard('warga')->user()->nama }}</div>
                        <div class="text-base font-normal">{{ Auth::guard('warga')->user()->nprw }}</div>
                    </div>
                    <div class="grid">
                        <div class="text-[10px] font-semibold uppercase">retribusi</div>
                        <div class="text-base font-normal">{{ $module }}</div>
                    </div>
                    <div class="grid">
                        <div class="text-[10px] font-semibold uppercase">Detail retribusi</div>
                        <div class="flex justify-between">
                            <div class="text-base font-normal">Volume</div>
                            <div class="text-base font-normal text-[#096B5A]">1m3</div>
                        </div>
                        <div class="flex justify-between border-b-2">
                            <div class="text-base font-normal">Tarif</div>
                            <div class="text-base font-normal text-[#096B5A]">Rp
                                {{ number_format(Auth::guard('warga')->user()->tarif, 0, ',', '.') }}</div>
                        </div>
                        <div class="flex justify-between">
                            <div class="text-base font-bold">Jumlah Retribusi</div>
                            <div class="text-base font-bold text-[#096B5A]">Rp
                                {{ number_format(Auth::guard('warga')->user()->tarif, 0, ',', '.') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid gap-3 mt-2">
                @if ($tagihan->status == 'Belum Lunas' && !isset($matchingTransaksi))
                    <a href="{{ route('user.pembayaran') }}"
                        class="flex items-center justify-center gap-2 hover:bg-emerald-300 btn bg-[#096B5A] border border-[#096B5A] p-2">
                        <span class="text-xs font-medium text-white">Lakukan Pembayaran</span>
                    </a>
                @endif
                <a href="{{ route('user.dashboard-user') }}"
                    class="flex items-center justify-center gap-2 hover:bg-emerald-300 btn bg-transparent border border-[#096B5A] p-2">
                    <span class="text-xs font-medium text-[#096B5A]">Kembali Ke Beranda</span>
                </a>
            </div>
        </div>
    </div>
</div>

@include('user.partial-html._template-bottom')

</body>

</html>

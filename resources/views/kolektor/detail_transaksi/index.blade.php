@php
    use Carbon\Carbon;
@endphp
<!-- meta tags and other links -->
@section('title', $module)

@include('kolektor.partial-html._template-top')

<div class="flex justify-center">
    <!-- Kontainer utama -->
    <div id="card-overflow" class="w-[460px] bg-[#f5fbf7] h-screen px-4 pt-4 pb-[10px] relative overflow-y-auto">

        @section('title-active', $module)
        @include('kolektor.layouts._nav')

        <div class="card border-0 p-4 grid gap-2 mt-3">
            <div class="grid">
                <div class="text-[10px] font-semibold uppercase">no. transaksi</div>
                <div class="text-base font-normal">
                    {{ $transaksi->no_transaksi . '-' . $transaksi->nprw }}</div>
            </div>
            <div class="grid">
                <div class="text-[10px] font-semibold uppercase">dibayarkan ke</div>
                <div class="text-base font-normal">
                    Kecamatan Makassar
                </div>
            </div>
            <div class="grid">
                <div class="text-[10px] font-semibold uppercase">ID PELANGGAN / NPWR</div>
                <div class="flex items-center">
                    <img src="{{ asset('warga/' . $transaksi->foto_warga) }}" alt=""
                        class="shrink-0 me-3 rounded-full w-11 h-11">
                    <div class="grid">
                        <h6 class="text-[14px] mb-0 font-normal">{{ $transaksi->nama }}</h6>
                        <span class="text-[10px] font-semibold">{{ $transaksi->nprw }}</span>
                    </div>
                </div>
            </div>
            <div class="grid">
                <div class="text-[10px] font-semibold uppercase">alamat</div>
                <div class="text-base font-normal">{{ $transaksi->alamat }}</div>
                <div class="text-base font-normal">RT {{ $transaksi->rt }} / RW
                    {{ $transaksi->rw }}</div>
                <div class="text-base font-normal">Kelurahan {{ $transaksi->kelurahan }}</div>
                <div class="text-base font-normal">Kecamatan Makassar</div>
            </div>
            <div class="grid">
                <div class="text-[10px] font-semibold uppercase">tagihan dibayarkan</div>
                <!-- List Item -->
                <div class="p-1">
                    @foreach ($transaksi->bulan_tagihan as $bulan)
                        @php
                            // Pastikan bulan_tagihan tidak kosong
                            if (!empty($bulan)) {
                                try {
                                    // Perbaiki format dan parse tanggal
                                    $tanggal = Carbon::createFromFormat('Y m d', $bulan)->locale('id');
                                } catch (\Exception $e) {
                                    // Tangani jika ada kesalahan dalam parsing tanggal
                                    $tanggal = null;
                                }
                            } else {
                                $tanggal = null;
                            }
                        @endphp

                        @if ($tanggal)
                            <div class="py-2 border-b">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm font-normal">
                                        {{ $tanggal->isoFormat('MMMM YYYY') }}
                                    </span>
                                    <span class="price text-[#096B5A] text-sm font-medium">
                                        Rp {{ number_format($transaksi->tarif, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

                <!-- Total -->
                <div class="mt-4 text-base font-medium flex justify-between">
                    <span>Total Retribusi:</span>
                    <span class="text-[#096B5A]">Rp
                        {{ number_format($transaksi->terbayarkan, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
    </div>
</div>

@include('kolektor.partial-html._template-bottom')

</body>

</html>

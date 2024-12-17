<!-- meta tags and other links -->
@section('title', $module)

@include('kolektor.partial-html._template-top')

<div class="flex justify-center">
    <!-- Kontainer utama -->
    <div id="card-overflow" class="w-[460px] bg-[#426277] h-screen px-4 pt-4 pb-[20px] relative overflow-y-auto">

        <div class="grid mt-3 gap-2">
            <div class="flex gap-2 mt-3 justify-center">
                <div class="bg-white p-3 w-[80px] h-[80px] rounded-full flex items-center justify-center">
                    <iconify-icon icon="ci:arrows-reload-01" width="45px" height="45px"></iconify-icon>
                </div>
                <div class="text-[28px] font-bold text-white w-min">Transaksi Diproses</div>
            </div>
        </div>

        <div class="grid gap-3 mt-3">
            <div class="rounded-lg p-6 text-center h-[180px] bg-no-repeat bg-cover bg-center opacity-80 flex items-center justify-center"
                style="background-image: url({{ asset('bukti/' . $transaksi->foto) }})">
                <div class="grid justify-center">
                    <button
                        class="flex items-center justify-center gap-2 hover:bg-emerald-300 btn bg-[#C7E7FF] border border-[#096B5A] p-2 w-max lihat-bukti-btn">
                        <iconify-icon icon="mdi-light:eye" class="text-[#426277]" width="24"
                            height="24"></iconify-icon>
                        <span class="text-xs font-medium text-[#426277]">Lihat Bukti Transaksi</span>
                    </button>
                </div>
            </div>

            <!-- Popup -->
            <div id="popup-gambar" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center">
                <div class="relative bg-white p-4 rounded-lg shadow-lg">
                    <button class="absolute top-2 right-2 text-black text-3xl font-bold close-popup">&times;</button>
                    <img src="{{ asset('bukti/' . $transaksi->foto) }}" alt="Bukti Transaksi"
                        class="max-w-[90vw] max-h-[90vh]">
                </div>
            </div>

            <div class="card border-0 bg-white shadow-lg p-2">
                <div class="grid gap-2">
                    <div class="grid">
                        <div class="text-[10px] font-semibold uppercase">No. transaksi</div>
                        <div class="text-base font-normal">{{ $transaksi->no_transaksi }}</div>
                    </div>
                    <div class="grid">
                        <div class="text-[10px] font-semibold uppercase">dibayarkan ke</div>
                        <div class="text-base font-normal">Kecamatan Makassar</div>
                    </div>
                    <div class="grid">
                        <div class="text-[10px] font-semibold uppercase">alamat</div>
                        <div class="text-base font-normal">{{ $warga->alamat }}</div>
                        <div class="text-base font-normal">RT {{ $warga->rt }} / RW
                            {{ $warga->rw }}</div>
                        <div class="text-base font-normal">Kelurahan {{ $warga->kelurahan }}</div>
                        <div class="text-base font-normal">Kecamatan Makassar</div>
                    </div>
                    <div class="grid">
                        <div class="text-[10px] font-semibold uppercase">tagihan dibayarkan</div>
                        <!-- List Item -->
                        <div class="p-1">
                            @foreach ($tagihan as $item)
                                <div class="py-2 border-b">
                                    <div class="flex items-center justify-between">
                                        <span
                                            class="text-sm font-normal">{{ \Carbon\Carbon::createFromFormat('Y m d', $item->tanggal_tagihan)->formatLocalized('%B %Y') }}</span>
                                        <span class="price text-[#096B5A] text-sm font-medium">Rp
                                            {{ number_format($warga->tarif, 0, ',', '.') }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Total -->
                        <div class="mt-4 text-base font-medium flex justify-between">
                            <span>Total Retribusi:</span>
                            <span class="text-[#426277]">Rp
                                {{ number_format($transaksi->terbayarkan, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid gap-3 mt-2">
                <a href="{{ route('kolektor.dashboard-kolektor') }}"
                    class="flex items-center justify-center gap-2 hover:bg-emerald-300 btn bg-[#426277] border border-white p-2">
                    <span class="text-xs font-medium text-white">Kembali Ke Beranda</span>
                </a>
            </div>
        </div>

    </div>
</div>

@include('kolektor.partial-html._template-bottom')

<style>
    #popup-gambar {
        z-index: 9999;
    }

    #popup-gambar img {
        object-fit: contain;
    }
</style>

<script>
    $(document).ready(function() {
        // Tampilkan popup saat tombol diklik
        $(".lihat-bukti-btn").on("click", function() {
            $("#popup-gambar").removeClass("hidden").addClass("flex");
        });

        // Sembunyikan popup saat tombol close diklik
        $(".close-popup").on("click", function() {
            $("#popup-gambar").removeClass("flex").addClass("hidden");
        });

        // Sembunyikan popup saat area luar popup diklik
        $("#popup-gambar").on("click", function(e) {
            if ($(e.target).is("#popup-gambar")) {
                $(this).removeClass("flex").addClass("hidden");
            }
        });
    });
</script>

</body>

</html>

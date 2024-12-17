<!-- meta tags and other links -->
@section('title', $module)

@include('kolektor.partial-html._template-top')

<div class="flex justify-center">
    <!-- Kontainer utama -->
    <div id="card-overflow" class="w-[460px] bg-[#f5fbf7] h-screen px-4 pt-4 pb-[100px] relative overflow-y-auto">

        @section('title-active', $module)
        @include('kolektor.layouts._nav')

        <div class="card border-0 p-4 grid gap-2">
            <div class="text-sm font-medium text-[#096B5A]">Cari Warga</div>
            <input type="text" id="searchInput" class="rounded-lg border border-[#096B5A] p-1 text-[10px] font-semibold"
                placeholder="Masukkan Nama atau NPWR">
            <a href="javascript:void(0);" id="searchButton"
                class="flex items-center justify-center gap-2 hover:bg-emerald-300 btn bg-[#096B5A] border border-[#096B5A] p-2">
                <span class="text-xs font-medium text-white">Cari</span>
            </a>
        </div>

        <div class="grid gap-2 mt-3" id="wargaList">
            @foreach ($wargaWithTagihanStatus as $item)
                <div onclick="window.location.href='{{ route('kolektor.pembayaran', ['uuid' => $item->uuid]) }}';"
                    class="flex items-center justify-between bg-white p-2 rounded-lg shadow-md mb-2 warga-item cursor-pointer"
                    data-nama="{{ $item->nama }}" data-nprw="{{ $item->nprw }}">
                    <div class="flex items-center gap-3">
                        <!-- Foto Warga -->
                        <img src="{{ asset('warga/' . $item->foto) }}" alt="Foto" class="w-10 h-10 rounded-full">
                        <div>
                            <!-- Nama dan NPWR -->
                            <h4 class="text-xs font-normal">{{ $item->nama }}</h4>
                            <p class="text-gray-400 text-[10px]">{{ $item->nprw }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <!-- Tarif dan Bulan Tagihan -->
                        @if ($item->total_belum_lunas != 0)
                            <p class="text-[#BA1A1A] font-bold text-sm">
                                Rp {{ number_format($item->total_belum_lunas, 0, ',', '.') }}
                            </p>
                        @else
                            <p class="text-[#096B5A] font-bold text-sm">
                                Rp {{ number_format($item->total_lunas, 0, ',', '.') }}
                            </p>
                        @endif
                    </div>
                </div>
            @endforeach
            <div id="data-null" class="col-span-2 text-lg font-bold text-center text-slate-400 w-full hidden">Tidak ada
                Data
                Warga</div>
        </div>

        @include('kolektor.layouts._footer')

        @include('kolektor.layouts._sidebar')
    </div>
</div>

@include('kolektor.partial-html._template-bottom')

<script>
    $(document).ready(function() {
        // Fungsi untuk menyaring warga berdasarkan input pencarian
        $('#searchButton').on('click', function() {
            var searchQuery = $('#searchInput').val()
                .toLowerCase(); // Mengambil nilai input dan mengubahnya menjadi lowercase
            var itemFound = false; // Flag untuk mengecek jika ada item yang ditemukan

            $('#wargaList .warga-item').each(function() {
                var nama = $(this).data('nama').toLowerCase(); // Ambil data nama warga
                var nprw = $(this).data('nprw').toLowerCase(); // Ambil data NPWR warga

                // Cek apakah nama atau NPWR mengandung query pencarian
                if (nama.includes(searchQuery) || nprw.includes(searchQuery)) {
                    $(this).show(); // Tampilkan item jika cocok
                    itemFound = true; // Tandai jika ada item yang ditemukan
                } else {
                    $(this).hide(); // Sembunyikan item jika tidak cocok
                }
            });

            // Tampilkan atau sembunyikan elemen data-null berdasarkan hasil pencarian
            if (itemFound) {
                $('#data-null').addClass(
                    'hidden'); // Sembunyikan data-null jika ada item yang ditemukan
            } else {
                $('#data-null').removeClass(
                    'hidden'); // Tampilkan data-null jika tidak ada item yang ditemukan
            }
        });
    });
</script>

</body>

</html>

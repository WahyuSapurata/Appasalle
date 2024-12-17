<!-- meta tags and other links -->
@section('title', $module)

@include('kolektor.partial-html._template-top')

<div class="flex justify-center">
    <!-- Kontainer utama -->
    <div id="card-overflow" class="w-[460px] bg-[#f5fbf7] h-screen px-4 pt-4 pb-[100px] relative overflow-y-auto">

        @section('title-active', $module)
        @include('kolektor.layouts._nav')

        <!-- Filter Dropdowns -->
        <div class="flex justify-between items-center mt-2 mb-4">
            <div class="flex gap-2">
                <select id="filter-tanggal" class="border rounded px-2 py-0 text-gray-600 text-[10px]">
                    <option value="">Semua Tanggal</option>
                    @foreach ($transaksi->unique('created_at') as $item)
                        <option value="{{ $item->created_at->format('Y-m-d') }}">
                            {{ $item->created_at->locale('id')->isoFormat('D MMMM YYYY') }}
                        </option>
                    @endforeach
                </select>

                <select id="filter-bulan" class="border rounded px-2 py-0 text-gray-600 text-[10px]">
                    <option value="">Semua Bulan</option>
                    @foreach ($transaksi->unique('bulan_tagihan') as $item)
                        <option value="{{ $item->bulan_tagihan }}">{{ $item->bulan_tagihan }} Bulan</option>
                    @endforeach
                </select>

                <select id="filter-rtrw" class="border rounded px-2 py-0 text-gray-600 text-[10px]">
                    <option value="">Semua NPRW</option>
                    @foreach ($transaksi->unique('nprw') as $item)
                        <option value="{{ $item->nprw }}">{{ $item->nprw }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Daftar Transaksi -->
        <div id="transaksi-list">
            @foreach ($transaksi as $item)
                <div onclick="window.location.href='{{ route('kolektor.detail-transaksi', ['uuid' => $item->uuid]) }}';"
                    class="transaksi-item mb-6 cursor-pointer" data-tanggal="{{ $item->created_at->format('Y-m-d') }}"
                    data-bulan="{{ $item->bulan_tagihan }}" data-rtrw="{{ $item->nprw }}">
                    <h3 class="text-gray-500 text-[10px] font-semibold mb-2">
                        {{ $item->created_at->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
                    </h3>
                    <div class="flex items-center justify-between bg-white p-2 rounded-lg shadow-md mb-2">
                        <div class="flex items-center gap-3">
                            <!-- Foto Warga -->
                            <img src="{{ asset('warga/' . $item->foto_warga) }}" alt="Foto"
                                class="w-10 h-10 rounded-full">
                            <div>
                                <!-- Nama dan NPRW -->
                                <h4 class="text-xs font-normal">{{ $item->nama }}</h4>
                                <p class="text-gray-400 text-[10px]">{{ $item->nprw }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <!-- Tarif dan Bulan Tagihan -->
                            <p class="text-[#096B5A] font-bold text-sm">
                                Rp {{ number_format($item->terbayarkan, 0, ',', '.') }}
                            </p>
                            <p
                                class="bg-[#A1F2DC] text-[#096B5A] px-2 py-1 rounded-md text-[10px] font-semibold inline-block">
                                {{ $item->bulan_tagihan }} BULAN
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @include('kolektor.layouts._footer')

        @include('kolektor.layouts._sidebar')
    </div>
</div>

@include('kolektor.partial-html._template-bottom')

<script>
    $(document).ready(function() {
        // Event listener untuk setiap dropdown
        $('#filter-tanggal, #filter-bulan, #filter-rtrw').on('change', function() {
            filterTransaksi();
        });

        function filterTransaksi() {
            let tanggal = $('#filter-tanggal').val();
            let bulan = $('#filter-bulan').val();
            let rtrw = $('#filter-rtrw').val();

            $('.transaksi-item').each(function() {
                let itemTanggal = $(this).data('tanggal');
                let itemBulan = $(this).data('bulan').toString();
                let itemRtrw = $(this).data('rtrw');

                let show = true;

                if (tanggal && itemTanggal !== tanggal) {
                    show = false;
                }
                if (bulan && itemBulan !== bulan) {
                    show = false;
                }
                if (rtrw && itemRtrw !== rtrw) {
                    show = false;
                }

                if (show) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }
    });
</script>

</body>

</html>

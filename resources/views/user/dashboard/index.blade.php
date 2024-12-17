<!-- meta tags and other links -->
@section('title', $module)

@include('user.partial-html._template-top')

<div class="flex justify-center">
    <!-- Kontainer utama -->
    <div id="card-overflow" class="w-[460px] bg-[#f5fbf7] h-screen px-4 pt-4 pb-[100px] relative overflow-y-auto">
        <!-- Header dengan gradasi -->
        <div class="absolute top-0 right-0 w-[460px] h-40 bg-gradient-to-b from-[#096B5A] to-[#f5fbf7]"></div>

        <!-- Header konten -->
        <div class="flex justify-between items-center mt-3 relative z-10">
            <img src="{{ asset('assets/images/logo-light.png') }}" alt="site logo" class="w-[157px]">
            <div class="flex items-center gap-2">
                <!-- Ikon notifikasi -->
                <iconify-icon icon="material-symbols:notifications" class="text-white text-[24px]"></iconify-icon>
                <!-- Avatar -->
                <a href="{{ route('user.profil') }}">
                    <img src="{{ asset('warga/' . auth()->guard('warga')->user()->foto) }}" class="rounded-full w-8 h-8"
                        alt="avatar">
                </a>
            </div>
        </div>

        <!-- Card tagihan -->
        <div class="overflow-x-auto no-scrollbar relative z-10">
            <div class="flex gap-2">
                <!-- Card 1 -->
                @if ($transaksi)
                    <div class="p-4 rounded-2xl bg-white mt-6 grid gap-2 min-w-[300px]">
                        <div class="flex items-center justify-between">
                            <div class="text-sm font-normal text-[#171D1B]">Selesaikan Transaksi</div>
                            <div class="text-[10px] font-semibold text-[#171D1B]">{{ $transaksi->no_transaksi }}</div>
                        </div>
                        <div class="flex w-full">
                            <label data-uuid="{{ $transaksi->uuid }}"
                                class="flex w-full items-center mt-4 px-4 py-2 bg-[#096B5A] text-white border rounded-md cursor-pointer hover:bg-teal-200 hover:text-[#096B5A]">
                                <input type="file" name="foto" id="input-foto" class="hidden"
                                    accept=".png, .jpg, .jpeg">
                                <iconify-icon icon="line-md:upload-loop" class="mr-2"></iconify-icon>
                                <span>Upload Bukti Transaksi</span>
                            </label>
                        </div>
                    </div>
                @endif

                <!-- Card 2 -->
                <div class="p-4 rounded-2xl w-full bg-white mt-6 grid gap-2 min-w-[300px]">
                    <!-- Judul -->
                    <div class="text-sm font-normal text-[#171D1B]">Total Tagihan Retribusi</div>
                    <!-- Informasi total tagihan -->
                    @if ($total_tagihan_belum_lunas)
                        @if ($tagihan_proses == 'Belum Lunas')
                            <div class="flex justify-between items-center">
                                <div class="text-2xl font-normal text-[#096B5A]">Rp
                                    {{ number_format($total_tagihan_belum_lunas, 0, ',', '.') }}</div>
                                <div class="px-2 py-1 rounded-xl bg-[#FFDAD6] text-[#BA1A1A] text-[10px] font-semibold">
                                    Belum Lunas
                                </div>
                            </div>
                        @elseif ($tagihan_proses == 'Proses')
                            <div class="flex justify-start items-center">
                                <div class="px-2 py-1 rounded-xl bg-[#CDE8DF] text-[#426277] text-[10px] font-semibold">
                                    Proses
                                </div>
                            </div>
                        @elseif ($tagihan_proses == 'Gagal')
                            <div class="flex justify-start items-center">
                                <div class="px-2 py-1 rounded-xl bg-[#FFDAD6] text-[#BA1A1A] text-[10px] font-semibold">
                                    Dibatalkan
                                </div>
                            </div>
                        @endif
                    @else
                        <div class="flex justify-start items-center">
                            <div class="px-2 py-1 rounded-xl bg-[#BFF0B1] text-[#3E6837] text-[10px] font-semibold">
                                Lunas
                            </div>
                        </div>
                    @endif
                    <!-- Informasi tambahan -->
                    <div class="flex items-center justify-between">
                        <div class="text-sm font-normal text-[#171D1B]">{{ Auth::guard('warga')->user()->nama }}</div>
                        <div class="text-sm font-normal text-[#171D1B]">{{ Auth::guard('warga')->user()->nprw }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid mt-6 gap-2">
            <div class="col-span-2 flex items-center w-full justify-between">
                <div class="text-base font-semibold text-[#171D1B]">Tagihan Anda</div>
                <a href="{{ route('user.tagihan') }}" class="text-[10px] font-medium uppercase text-[#096B5A]">Lihat
                    Semua</a>
            </div>
            @forelse ($tagihan as $item_tagihan)
                <div class="col-span-2 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        @if ($item_tagihan->status == 'Belum Lunas')
                            <div class="h-6 w-6 bg-[#FFDAD6] flex items-center justify-center rounded-full">
                                <iconify-icon icon="line-md:remove"
                                    class="menu-icon text-[10px] text-[#BA1A1A]"></iconify-icon>
                            </div>
                        @elseif ($item_tagihan->status == 'Proses')
                            <div class="h-6 w-6 bg-[#CDE8DF] flex items-center justify-center rounded-full">
                                <iconify-icon icon="mage:reload"
                                    class="menu-icon text-[10px] text-[#426277]"></iconify-icon>
                            </div>
                        @elseif ($item_tagihan->status == 'Gagal')
                            <div class="h-6 w-6 bg-[#FFDAD6] flex items-center justify-center rounded-full">
                                <iconify-icon icon="line-md:remove"
                                    class="menu-icon text-[10px] text-[#BA1A1A]"></iconify-icon>
                            </div>
                        @endif

                        <div class="text-sm font-normal text-[#171D1B]">
                            {{ \Carbon\Carbon::createFromFormat('Y m d', $item_tagihan->tanggal_tagihan)->formatLocalized('%B %Y') }}
                        </div>
                    </div>
                    <div class="text-sm font-normal text-[#171D1B]">Rp
                        {{ number_format(Auth::guard('warga')->user()->tarif, 0, ',', '.') }}</div>
                </div>
            @empty
                <div class="col-span-2 text-4xl font-bold text-center text-slate-400 w-full">Belum ada Tagihan</div>
            @endforelse
        </div>

        <div class="mt-6 bg-[#A1F2DC] rounded-2xl">
            <div class="flex items-center justify-between">
                <div class="grid gap-3 px-3">
                    <div class="text-base font-medium text-[#171D1B]">Promo UMKM</div>
                    <a href="#" class="text-[10px] font-medium uppercase text-[#096B5A]">Lihat Semua</a>
                </div>
                <div class="py-3">
                    <img class="rounded-lg w-[248px] h-[136px]" src="{{ asset('assets/images/promo.webp') }}"
                        alt="">
                </div>
            </div>
        </div>

        <div class="grid mt-6 gap-2">
            <div class="flex items-center justify-between">
                <div class="text-base font-semibold text-[#171D1B]">UMKM Binaan</div>
                <a href="{{ route('user.umkm') }}" class="text-[10px] font-medium uppercase text-[#096B5A]">Lihat
                    Semua</a>
            </div>
            <div class="grid grid-cols-2 gap-2 w-full">
                @forelse ($product as $item_product)
                    <div class="col-span-1 card w-full h-[220px] border-0 rounded-lg grid shadow-lg">
                        <div class="w-full h-[168px] bg-gray-300 rounded-lg flex items-center justify-center">
                            @if ($item_product->foto)
                                <img src="{{ asset('menu/' . $item_product->foto) }}"
                                    class="w-full h-[168px] rounded-lg" alt="">
                            @else
                                <iconify-icon icon="lucide:image"
                                    class="menu-icon text-[100px] text-gray-500"></iconify-icon>
                            @endif
                        </div>
                        <div class="grid px-2">
                            <span class="text-[14px] font-normal">{{ $item_product->menu }}</span>
                            <span class="text-[10px] font-semibold">Rp
                                {{ number_format($item_product->harga, 0, ',', '.') }}</span>
                        </div>
                    </div>
                @empty
                    <div class="col-span-2 text-4xl font-bold text-center text-slate-400 w-full">Belum ada Produk</div>
                @endforelse
            </div>
        </div>

        @include('user.layouts._footer')

        @include('user.layouts._sidebar')
    </div>
</div>

@include('user.partial-html._template-bottom')

<script>
    $(document).ready(function() {
        // Event saat file dipilih
        $(document).on('change', '#input-foto', function(e) {
            e.preventDefault();

            var file = this.files[0]; // Ambil file yang dipilih
            var formData = new FormData(); // Buat objek FormData
            formData.append('foto', file);

            var uuid = $(this).closest('label').attr('data-uuid');

            // Tampilkan pesan loading (opsional)
            Swal.fire({
                title: 'Mengunggah...',
                text: 'Mohon tunggu.',
                icon: 'info',
                showConfirmButton: false,
                allowOutsideClick: false,
            });

            const route = "{{ route('user.upload-bukti', ['uuid' => ':uuid']) }}".replace(
                ":uuid",
                uuid
            );

            // Kirim AJAX
            $.ajax({
                url: route,
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            text: "Data Sedang Di Proses",
                            icon: "success",
                            showConfirmButton: false,
                            timer: 1500,
                        }).then(() => {
                            window.location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: response.message,
                            text: response.data,
                            icon: "warning",
                            showConfirmButton: false,
                            timer: 1500,
                        });
                    }
                },
                error: function(xhr) {
                    Swal.fire({
                        title: 'Gagal',
                        text: xhr.responseJSON.message || 'Terjadi kesalahan.',
                        icon: 'error',
                        showConfirmButton: true,
                    });
                },
            });
        });
    });
</script>

</body>

</html>

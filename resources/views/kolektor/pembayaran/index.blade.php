@php
    use Carbon\Carbon;
@endphp
<!-- meta tags and other links -->
@section('title', $module)

@include('kolektor.partial-html._template-top')

<div class="flex justify-center">
    <!-- Kontainer utama -->
    <div id="card-overflow" class="w-[460px] bg-[#f5fbf7] h-screen px-4 pt-4 pb-[20px] relative overflow-y-auto">

        @section('title-active', $module)
        @include('kolektor.layouts._nav')

        <div class="grid gap-3 mt-3">
            <div class="card border-0 bg-white shadow-lg p-2">
                <div class="grid gap-2">
                    <div class="grid">
                        <div class="text-[10px] font-semibold uppercase">ID PELANGGAN / NPWR</div>
                        <div class="flex items-center gap-3">
                            <!-- Foto Warga -->
                            <img src="{{ asset('warga/' . $warga->foto) }}" alt="Foto"
                                class="w-10 h-10 rounded-full">
                            <div>
                                <!-- Nama dan NPRW -->
                                <h4 class="text-xs font-normal">{{ $warga->nama }}</h4>
                                <p class="text-gray-400 text-[10px]">{{ $warga->nprw }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="grid">
                        <div class="text-[10px] font-semibold uppercase">alamat</div>
                        <div class="text-base font-normal">{{ $warga->alamat }}</div>
                        <div class="text-base font-normal">RT {{ $warga->rt }} / RW
                            {{ $warga->rw }}</div>
                        <div class="text-base font-normal">Kelurahan {{ $warga->kelurahan }}</div>
                        <div class="text-base font-normal">Kecamatan Makassar</div>
                    </div>
                    @if ($tagihan->isEmpty())
                        <div class="grid">
                            <div class="text-[10px] font-semibold uppercase">tagihan dibayarkan</div>
                            <!-- List Item -->
                            <div class="p-1">
                                @foreach ($wargaTagihan as $bulan)
                                    @php
                                        // Pastikan bulan_tagihan tidak kosong
                                        if (!empty($bulan->tanggal_tagihan)) {
                                            try {
                                                // Perbaiki format dan parse tanggal
                                                $tanggal = Carbon::createFromFormat(
                                                    'Y m d',
                                                    $bulan->tanggal_tagihan,
                                                )->locale('id');
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
                                                    Rp {{ number_format($warga->tarif, 0, ',', '.') }}
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
                                    {{ number_format($totalPembayaran, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    @else
                        <div class="grid">
                            <div class="text-[10px] font-semibold uppercase">PILIH TAGIHAN RETRIBUSI</div>
                            <div id="retribusi-app">
                                <!-- Pilih Semua -->
                                <div class="mt-2 bg-[#E9EFEC] p-1 rounded-md">
                                    <label class="flex items-center">
                                        <input type="checkbox" id="select-all" class="mr-2 rounded-md">
                                        <span class="text-sm font-medium">Pilih Semua</span>
                                    </label>
                                </div>

                                <!-- List Item -->
                                <div class="p-1">
                                    @foreach ($tagihan as $item)
                                        <div class="py-2 border-b">
                                            <div class="flex items-center justify-between">
                                                <label class="flex items-center">
                                                    <input type="checkbox" class="item-checkbox mr-2 rounded-md"
                                                        data-index="{{ $loop->iteration }}"
                                                        data-price="{{ $warga->tarif }}"
                                                        data-uuid="{{ $item->uuid }}">
                                                    <span class="text-sm font-normal">
                                                        {{ \Carbon\Carbon::createFromFormat('Y m d', $item->tanggal_tagihan)->formatLocalized('%B %Y') }}
                                                    </span>
                                                </label>
                                                <span class="price text-[#CDE8DF] text-sm font-medium">Rp
                                                    {{ number_format($warga->tarif, 0, ',', '.') }}
                                                </span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Total -->
                                <div class="mt-4 text-base font-medium flex justify-between">
                                    <span>Total Retribusi:</span>
                                    <span id="total-retribusi">Rp 0</span>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            @if (!$tagihan->isEmpty())
                <div class="grid gap-3 mt-2">
                    <div class="text-[10px] font-semibold uppercase">Metode Pembayaran</div>
                    <div class="flex items-center gap-2 btn bg-transparent border border-[#6F7975] p-2">
                        <iconify-icon icon="si:barcode-scan-alt-duotone" width="20" height="20"></iconify-icon>
                        <span class="text-sm font-normal">QRIS</span>
                    </div>
                    <button type="button" id="proses-bayar"
                        class="flex items-center justify-center gap-2 hover:bg-emerald-300 btn bg-[#096B5A] border border-[#096B5A] p-2">
                        <span class="text-xs font-medium text-white">Lakukan Pembayaran</span>
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>

@include('kolektor.partial-html._template-bottom')

<style>
    .text-active {
        color: #096B5A !important;
    }
</style>

<script>
    $(document).ready(function() {
        const $selectAllCheckbox = $("#select-all");
        const $itemCheckboxes = $(".item-checkbox");
        const $totalRetribusiElement = $("#total-retribusi");

        // Fungsi untuk memperbarui total
        function updateTotal() {
            let total = 0;
            $itemCheckboxes.each(function() {
                if ($(this).is(":checked")) {
                    total += parseInt($(this).data("price"), 10);
                }
            });
            $totalRetribusiElement.text(`Rp ${total.toLocaleString()}`);
        }

        // Event listener untuk checkbox "Pilih Semua"
        $selectAllCheckbox.on("change", function() {
            const isChecked = $(this).is(":checked");
            $itemCheckboxes.prop("checked", isChecked).trigger("change");
        });

        // Event listener untuk checkbox individual
        $itemCheckboxes.on("change", function() {
            const $priceElement = $(this).closest("div").find(".price");
            if ($(this).is(":checked")) {
                $priceElement.addClass("text-active").removeClass("text-[#CDE8DF]");
            } else {
                $priceElement.removeClass("text-active").addClass("text-[#CDE8DF]");
            }

            const index = $(this).data("index");

            // Jika checkbox dicentang, otomatis centang semua di atasnya
            if ($(this).is(":checked")) {
                $itemCheckboxes.each(function() {
                    if ($(this).data("index") < index) {
                        $(this).prop("checked", true).trigger("change");
                    }
                });
            } else {
                // Jika checkbox di-uncheck, otomatis uncheck semua di bawahnya
                $itemCheckboxes.each(function() {
                    if ($(this).data("index") > index) {
                        $(this).prop("checked", false).trigger("change");
                    }
                });
            }

            // Periksa apakah semua checkbox sudah dicentang
            const allChecked = $itemCheckboxes.length === $itemCheckboxes.filter(":checked").length;
            $selectAllCheckbox.prop("checked", allChecked);

            // Perbarui total
            updateTotal();
        });

        $(document).on("click", "#proses-bayar", function(e) {
            e.preventDefault(); // Mencegah form disubmit

            // Setup CSRF Token
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });

            // Menghitung total dari checkbox yang dicentang
            let uuidWarga = '{{ $warga->uuid }}';
            let totalTerbayarkan = 0;
            let uuidTagihan = [];
            $(".item-checkbox:checked").each(function() {
                totalTerbayarkan += parseInt($(this).data("price"), 10);
                uuidTagihan.push($(this).data("uuid"));
            });

            if (uuidTagihan.length === 0) {
                Swal.fire({
                    title: "Tidak ada tagihan dipilih",
                    text: "Silakan pilih tagihan terlebih dahulu.",
                    icon: "warning",
                    showConfirmButton: false,
                    timer: 1500,
                });
                return;
            }

            // Mengirim data ke server
            $.ajax({
                type: "POST",
                url: "{{ route('kolektor.add-transaksi') }}",
                data: {
                    uuid_warga: uuidWarga,
                    uuid_tagihan: uuidTagihan, // Kirimkan daftar UUID
                    terbayarkan: totalTerbayarkan, // Kirimkan total yang dibayarkan
                },
                success: function(response) {
                    if (response.success) {
                        const route =
                            "{{ route('kolektor.qris-transaksi', ['uuid' => ':uuid']) }}"
                            .replace(':uuid', response.data.uuid);
                        window.location.href = route;
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
                error: function(response) {
                    Swal.fire({
                        title: "Terjadi Kesalahan",
                        text: "Silakan coba lagi nanti.",
                        icon: "error",
                        showConfirmButton: false,
                        timer: 1500,
                    });
                },
            });
        });
    });
</script>

</body>

</html>

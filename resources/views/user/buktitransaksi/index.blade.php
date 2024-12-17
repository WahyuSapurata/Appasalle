<!-- meta tags and other links -->
@section('title', $module)

@include('user.partial-html._template-top')

<div class="flex justify-center">
    <!-- Kontainer utama -->
    <div id="card-overflow" class="w-[460px] bg-[#f5fbf7] h-screen px-4 pt-4 pb-[20px] relative overflow-y-auto">

        <div class="grid mt-3 gap-2">
            <iconify-icon onclick="window.location.href='{{ route('user.dashboard-user') }}'" class="cursor-pointer"
                icon="icon-park-outline:back" width="24" height="24">
            </iconify-icon>
            <div class="text-[#096B5A] text-2xl font-normal">{{ $module }}</div>
        </div>

        <div class="grid gap-3">
            <form id="form-submit" class="grid gap-3">
                <input type="hidden" value="{{ $transaksi->uuid }}">
                <div
                    class="border-2 border-dashed border-[#096B5A] rounded-lg p-6 text-center grid justify-center relative">
                    <div id="image-preview"
                        class="absolute w-full h-full -z-0 rounded-lg p-6 bg-no-repeat bg-cover bg-center opacity-80">
                    </div>
                    <iconify-icon icon="line-md:cloud-alt-upload-twotone-loop"
                        class="menu-icon text-5xl text-[#096B5A] mx-auto z-[1]"></iconify-icon>
                    <div class="text-[#096B5A] text-sm font-normal z-[1]">Upload Bukti Transaksi</div>
                    <label
                        class="flex items-center w-max mt-4 px-4 py-2 bg-teal-100 text-teal-700 border rounded-md cursor-pointer hover:bg-teal-200 z-[1]">
                        <input id="image-upload" type="file" name="foto" class="hidden"
                            accept=".png, .jpg, .jpeg">
                        <iconify-icon icon="line-md:upload-loop" class="mr-2"></iconify-icon>
                        <span>BROWSE FILE</span>
                    </label>
                </div>
                <div class="grid">
                    <button type="submit" id="submit-form"
                        class="flex items-center justify-center gap-2 hover:bg-emerald-300 btn bg-[#096B5A] border border-[#096B5A] p-2">
                        <span class="text-xs font-medium text-white">Lanjutkan</span>
                    </button>
                </div>
            </form>
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
                        <div class="text-base font-normal">{{ Auth::guard('warga')->user()->alamat }}</div>
                        <div class="text-base font-normal">RT {{ Auth::guard('warga')->user()->rt }} / RW
                            {{ Auth::guard('warga')->user()->rw }}</div>
                        <div class="text-base font-normal">Kelurahan {{ Auth::guard('warga')->user()->kelurahan }}</div>
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
                                            {{ number_format(Auth::guard('warga')->user()->tarif, 0, ',', '.') }}
                                        </span>
                                    </div>

                                    <button
                                        onclick="window.location.href='{{ route('user.detail-tagihan', ['uuid' => $item->uuid]) }}';"
                                        class="bg-[#CDE8DF] text-[#096B5A] text-xs px-2 py-1 rounded-lg">
                                        Lihat Tagihan
                                    </button>
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
        </div>

    </div>
</div>

@include('user.partial-html._template-bottom')
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $("#submit-form").click(function(e) {
            e.preventDefault(); // Mencegah reload halaman

            let formData = new FormData($("#form-submit")[
                0]); // Gunakan FormData untuk menyertakan file upload

            const route = "{{ route('user.upload-bukti', ['uuid' => ':uuid']) }}".replace(
                ":uuid",
                "{{ $transaksi->uuid }}"
            );

            $.ajax({
                type: "POST",
                url: route,
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            text: "Data Sedang Di Proses",
                            icon: "success",
                            showConfirmButton: false,
                            timer: 1500,
                        }).then(() => {
                            const route =
                                "{{ route('user.proses-transaksi', ['uuid' => ':uuid']) }}"
                                .replace(':uuid', "{{ $transaksi->uuid }}");
                            window.location.href = route;
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

    // Fungsi untuk menangani pratinjau gambar
    function readURL(input) {
        if (input.files && input.files[0]) {
            const file = input.files[0];

            // Membaca file dan menampilkan pratinjau
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = $(input).closest("div").find("#image-preview")[0]; // Elemen pratinjau terkait

                if (preview) {
                    preview.style.backgroundImage = `url(${e.target.result})`;
                    preview.style.backgroundSize = "cover"; // Menyesuaikan ukuran pratinjau
                    preview.style.backgroundPosition = "center"; // Menyesuaikan posisi
                }
            };
            reader.readAsDataURL(file); // Membaca file sebagai data URL
        } else {
            console.warn("No file selected or browser does not support FileReader.");
        }
    }

    // Event listener dinamis untuk elemen input
    $(document).on("change", "#image-upload", function() {
        readURL(this);
    });
</script>

</body>

</html>

<!-- resources/views/admin/login.blade.php -->
@section('title', $module)

@include('admin.partial-html._template-top')

@include('admin.layouts._sidebar')
<main class="dashboard-main">
    @include('admin.layouts._nav')
    <div class="dashboard-main-body">
        <div class="card bg-transparent border-0 mb-2">
            <div class="flex gap-2 justify-end">
                <div class="flex gap-2 items-start">
                    <!-- Dropdown Start -->
                    <div class="">
                        <button data-dropdown-toggle="jenis-sampah" data-dropdown-placement="bottom"
                            class="text-[#4B635C] border text-[10px] font-semibold border-[#4B635C] bg-transparent hover:bg-primary-700 hover:text-white focus:ring-0 focus:outline-none focus:ring-primary-300 rounded-lg px-2 py-2 text-center inline-flex items-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 gap-5"
                            type="button">Kategori
                            <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <!-- Dropdown menu -->
                        <div id="jenis-sampah"
                            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-2xl w-44 dark:bg-gray-700">
                            <ul class="py-2 text-base text-[#4B635C] dark:text-gray-200">
                                <li>
                                    <a href="javascript:void(0)"
                                        class="active block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Semua</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Komersial</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Rumah
                                        Tangga
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Sekolah
                                        / Kampus</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- Dropdown End -->

                    <!-- Dropdown Start -->
                    <div class="">
                        <button data-dropdown-toggle="status-transaksi" data-dropdown-placement="bottom"
                            class="text-[#4B635C] border text-[10px] dark:text-white font-semibold border-[#4B635C] bg-transparent hover:bg-primary-700 hover:text-white focus:ring-0 focus:outline-none focus:ring-primary-300 rounded-lg px-2 py-2 text-center inline-flex items-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 gap-5"
                            type="button">Status Transaksi
                            <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <!-- Dropdown menu -->
                        <div id="status-transaksi"
                            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-2xl w-44 dark:bg-gray-700">
                            <ul class="py-2 text-base text-[#4B635C] dark:text-gray-200">
                                <li>
                                    <a href="javascript:void(0)"
                                        class="active block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Semua</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Berhasil</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Diproses
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Dibatalkan</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- Dropdown End -->

                    <button
                        class="bg-[#FFDAD6] px-3 py-2 text-[#BA1A1A] text-[10px] font-semibold rounded-lg reset">RESET</button>
                </div>
            </div>
        </div>
        <div class="card border-0 overflow-hidden p-2">
            <table id="selection-table"
                class="border border-neutral-200 dark:border-neutral-600 rounded-lg border-separate	">
                <thead>
                    <tr>
                        <th scope="col" class="text-neutral-800 dark:text-white">
                            <div class="flex items-center gap-2">
                                Nama Warga
                            </div>
                        </th>
                        <th scope="col" class="text-neutral-800 dark:text-white">
                            <div class="flex items-center gap-2">
                                No. Transaksi
                            </div>
                        </th>
                        <th scope="col" class="text-neutral-800 dark:text-white">
                            <div class="flex items-center gap-2">
                                Kategori
                            </div>
                        </th>
                        <th scope="col" class="text-neutral-800 dark:text-white">
                            <div class="flex items-center gap-2">
                                Buan Tagihan
                            </div>
                        </th>
                        <th scope="col" class="text-neutral-800 dark:text-white">
                            <div class="flex items-center gap-2">
                                Nominal
                            </div>
                        </th>
                        <th scope="col" class="text-neutral-800 dark:text-white">
                            <div class="flex items-center gap-2">
                                Status
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transaksi as $item)
                        <tr data-modal-target="authentication-modal{{ $item->uuid }}"
                            data-modal-toggle="authentication-modal{{ $item->uuid }}" class="cursor-pointer">
                            <td>
                                <div class="flex items-center">
                                    <img src="{{ asset('warga/' . $item->foto_warga) }}" alt=""
                                        class="shrink-0 me-3 rounded-full w-12 h-12">
                                    <div class="grid">
                                        <h6 class="text-[14px] mb-0 font-normal">{{ $item->nama }}</h6>
                                        <span class="text-[10px] font-semibold">{{ $item->nprw }}</span>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $item->no_transaksi }}</td>
                            <td>{{ $item->jenis_sampah }}</td>
                            <td>
                                <div class="grid grid-cols-3 items-center gap-1">
                                    @foreach ($item->bulan_tagihan as $bulan)
                                        <div
                                            class="col-span-1 p-1 rounded-2xl border border-[#096B5A] text-[#096B5A] text-xs font-bold">
                                            {{ $bulan ? \Carbon\Carbon::createFromFormat('Y m d', $bulan)->format('M y') : '-' }}
                                        </div>
                                    @endforeach
                                </div>
                            </td>
                            <td class="text-[#3E6837] font-bold">Rp
                                {{ number_format($item->terbayarkan, 0, ',', '.') }}</td>
                            <td>
                                <div
                                    class="py-1 px-4 {{ $item->status == 'Lunas' ? 'bg-[#BFF0B1]' : ($item->status == 'Proses' ? 'bg-[#CDE8DF]' : ($item->status == 'Gagal' ? 'bg-[#FFDAD6]' : '')) }} {{ $item->status == 'Lunas' ? 'text-[#3E6837]' : ($item->status == 'Proses' ? 'text-[#426277]' : ($item->status == 'Gagal' ? 'text-[#BA1A1A]' : '')) }} text-[10px] rounded-xl text-center">
                                    {{ $item->status == 'Lunas' ? 'Berhasil' : ($item->status == 'Proses' ? 'Diproses' : ($item->status == 'Gagal' ? 'Dibatalkan' : '')) }}
                                </div>
                            </td>
                        </tr>

                        <div id="authentication-modal{{ $item->uuid }}" tabindex="-1" aria-hidden="true"
                            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-md max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <!-- Modal body -->
                                    <div class="p-4 md:p-5 grid gap-4">
                                        <div class="flex gap-2 items-center">
                                            <div
                                                class="h-6 w-6 {{ $item->status == 'Lunas' ? 'bg-[#BFF0B1]' : 'bg-[#CDE8DF]' }} flex items-center justify-center rounded-full">
                                                <iconify-icon
                                                    icon="{{ $item->status == 'Lunas' ? 'tabler:check' : 'mage:reload' }}"
                                                    class="menu-icon text-[10px] text-[#3E6837]"></iconify-icon>
                                            </div>
                                            <span
                                                class="text-[10px] text-[#426277] font-semibold uppercase">{{ $item->status == 'Lunas' ? 'Lunas' : 'Pembayaran Diproses' }}</span>
                                        </div>

                                        @if ($item->status == 'Proses')
                                            <div class="rounded-lg p-6 text-center h-[180px] bg-no-repeat bg-cover bg-center opacity-80 flex items-center justify-center"
                                                style="background-image: url({{ asset('bukti/' . $item->foto) }})">
                                                <div class="grid justify-center">
                                                    <button
                                                        class="flex items-center justify-center gap-2 hover:bg-emerald-300 btn bg-[#C7E7FF] border border-[#096B5A] p-2 w-max lihat-bukti-btn">
                                                        <iconify-icon icon="mdi-light:eye" class="text-[#426277]"
                                                            width="24" height="24"></iconify-icon>
                                                        <span class="text-xs font-medium text-[#426277]">Lihat Bukti
                                                            Transaksi</span>
                                                    </button>
                                                </div>
                                            </div>

                                            <!-- Popup -->
                                            <div id="popup-gambar"
                                                class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center">
                                                <div class="relative bg-white p-4 rounded-lg shadow-lg">
                                                    <button
                                                        class="absolute top-2 right-2 text-black text-3xl font-bold close-popup">&times;</button>
                                                    <img src="{{ asset('bukti/' . $item->foto) }}"
                                                        alt="Bukti Transaksi" class="max-w-[90vw] max-h-[90vh]">
                                                </div>
                                            </div>
                                        @endif

                                        <div class="grid">
                                            <div class="text-[10px] font-semibold uppercase">no. transaksi</div>
                                            <div class="text-base font-normal">
                                                {{ $item->no_transaksi . '-' . $item->nprw }}</div>
                                        </div>
                                        <div class="grid">
                                            <div class="text-[10px] font-semibold uppercase">WAKTU transaksi</div>
                                            <div class="text-base font-normal">
                                                {{ $item->created_at ? \Carbon\Carbon::parse($item->created_at)->format('d/m/Y, H:i') : '-' }}
                                            </div>
                                        </div>
                                        <div class="grid">
                                            <div class="text-[10px] font-semibold uppercase">ID PELANGGAN / NPWR</div>
                                            <div class="flex items-center">
                                                <img src="{{ asset('warga/' . $item->foto_warga) }}" alt=""
                                                    class="shrink-0 me-3 rounded-full w-12 h-12">
                                                <div class="grid">
                                                    <h6 class="text-[14px] mb-0 font-normal">{{ $item->nama }}</h6>
                                                    <span class="text-[10px] font-semibold">{{ $item->nprw }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="grid">
                                            <div class="text-[10px] font-semibold uppercase">alamat</div>
                                            <div class="text-base font-normal">{{ $item->alamat }}</div>
                                            <div class="text-base font-normal">RT {{ $item->rt }} / RW
                                                {{ $item->rw }}</div>
                                            <div class="text-base font-normal">Kelurahan {{ $item->kelurahan }}</div>
                                            <div class="text-base font-normal">Kecamatan Makassar</div>
                                        </div>
                                        <div class="grid">
                                            <div class="text-[10px] font-semibold uppercase">tagihan dibayarkan</div>
                                            <!-- List Item -->
                                            <div class="p-1">
                                                @foreach ($item->bulan_tagihan as $bulan)
                                                    <div class="py-2 border-b">
                                                        <div class="flex items-center justify-between">
                                                            <span
                                                                class="text-sm font-normal">{{ \Carbon\Carbon::createFromFormat('Y m d', $bulan)->formatLocalized('%B %Y') }}</span>
                                                            <span class="price text-[#426277] text-sm font-medium">Rp
                                                                {{ number_format($item->tarif, 0, ',', '.') }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>

                                            <!-- Total -->
                                            <div class="mt-4 text-base font-medium flex justify-between">
                                                <span>Total Retribusi:</span>
                                                <span class="text-[#426277]">Rp
                                                    {{ number_format($item->terbayarkan, 0, ',', '.') }}</span>
                                            </div>
                                        </div>
                                        @if ($item->status == 'Proses')
                                            <div class="flex gap-2 justify-between">
                                                <button type="button"
                                                    class="button-batal flex w-full justify-center items-center gap-2 text-[#BA1A1A] bg-[#FFDAD6] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-1 text-center uppercase"
                                                    data-uuid="{{ $item->uuid }}">
                                                    <iconify-icon icon="line-md:remove"
                                                        class="menu-icon"></iconify-icon>
                                                    <span>Batalkan</span>
                                                </button>
                                                <button type="button"
                                                    class="button-verifikasi flex w-full justify-center items-center gap-2 text-white bg-[#096B5A] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-1 text-center uppercase"
                                                    data-uuid="{{ $item->uuid }}">
                                                    <iconify-icon icon="tabler:check"
                                                        class="menu-icon"></iconify-icon>
                                                    <span>Verifikasi</span>
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @include('admin.layouts._footer')
</main>

@include('admin.partial-html._template-bottom')

<script>
    if (document.getElementById("selection-table") && typeof simpleDatatables.DataTable !== 'undefined') {
        let multiSelect = true;
        let rowNavigation = false;
        let table = null;

        const resetTable = () => {
            // Hancurkan tabel jika sudah ada instance sebelumnya
            if (table) {
                table.destroy();
            }

            // Konfigurasi tabel
            const options = {
                columns: [{
                    select: [0, 5], // Nonaktifkan sorting pada kolom ke-0 dan ke-4
                    sortable: false,
                }],
                perPage: 5, // Tampilkan 5 baris per halaman
                perPageSelect: [5, 10, 15], // Opsi jumlah baris yang dapat dipilih
            };

            // Inisialisasi tabel
            table = new simpleDatatables.DataTable("#selection-table", options);

            // Modifikasi dropdown setelah tabel diinisialisasi
            table.on("datatable.init", () => {
                const perPageSelector = document.querySelector(
                    ".datatable-wrapper .datatable-dropdown select");
                if (perPageSelector) {
                    // Tambahkan teks "Line" pada setiap opsi
                    Array.from(perPageSelector.options).forEach(option => {
                        option.text = "Line " + option.value;
                    });
                }

                const dropdownLabel = document.querySelector(".datatable-dropdown label");
                if (dropdownLabel) {
                    // Hapus teks "entries per page"
                    dropdownLabel.childNodes.forEach(node => {
                        if (node.nodeType === Node.TEXT_NODE && node.textContent
                            .includes(
                                "entries per page")) {
                            node.textContent = "";
                        }
                    });
                }
            });
        };

        // Inisialisasi tabel pada halaman
        resetTable();

        // Fungsi untuk memfilter tabel berdasarkan kelurahan dan filter lainnya
        const filterTable = () => {
            if (table) {
                const rows = document.querySelectorAll("#selection-table tbody tr");

                const jenisSampah = document.querySelector("#jenis-sampah .active")?.textContent.trim()
                    .toLowerCase().replace(/\s+/g, ' ') || 'semua';
                const status = document.querySelector("#status-transaksi .active")?.textContent.trim()
                    .toLowerCase().replace(/\s+/g, ' ') || 'semua';

                let visibleRows = 0;

                rows.forEach(row => {
                    const jenisSampahCell = row.cells[2]?.textContent.trim()
                        .toLowerCase().replace(/\s+/g, ' '); // Kolom 4 untuk jenis sampah

                    const statusCell = row.cells[5]?.textContent.trim()
                        .toLowerCase().replace(/\s+/g, ' '); // Kolom 4 untuk jenis sampah

                    // Tentukan apakah baris ini harus ditampilkan
                    const isJenisSampahVisible = jenisSampah === "semua" || jenisSampah === jenisSampahCell;
                    const isStatusVisible = status === "semua" || status === statusCell;

                    // Sembunyikan atau tampilkan baris
                    const isVisible = isJenisSampahVisible && isStatusVisible;
                    row.style.display = isVisible ? "" : "none";

                    if (isVisible) {
                        visibleRows++;
                    }
                });

                // Perbarui informasi jumlah entri yang ditampilkan
                const startEntry = visibleRows > 0 ? 1 : 0;
                const endEntry = visibleRows < rows.length ? visibleRows : rows.length;
                const infoText = `Showing ${startEntry} to ${endEntry} of ${visibleRows} entries`;

                // Update info jumlah entri
                const infoContainer = document.querySelector('.datatable-info');
                if (infoContainer) {
                    infoContainer.textContent = infoText;
                }
            }
        };

        // Fungsi untuk mengatur opsi aktif dan memperbarui teks tombol dropdown
        const handleDropdownSelection = (dropdownItems, dropdownButton, filterFunction) => {
            dropdownItems.forEach(item => {
                item.addEventListener('click', (event) => {
                    event.preventDefault();

                    // Hilangkan class active dari semua opsi di dropdown
                    dropdownItems.forEach(link => link.classList.remove('active'));

                    // Tambahkan class active pada opsi yang diklik
                    item.classList.add('active');

                    // Perbarui teks tombol dropdown sesuai dengan opsi yang dipilih
                    dropdownButton.textContent = item.textContent.trim();

                    // Jalankan fungsi filter tabel
                    if (typeof filterFunction === 'function') {
                        filterFunction();
                    }
                });
            });
        };

        // Jenis Sampah Dropdown
        const jenisSampahDropdown = document.querySelectorAll('#jenis-sampah a');
        const jenisSampahButton = document.querySelector('[data-dropdown-toggle="jenis-sampah"]');
        handleDropdownSelection(jenisSampahDropdown, jenisSampahButton, filterTable);

        // Kelurahan Dropdown
        const statusDropdown = document.querySelectorAll('#status-transaksi a');
        const statusButton = document.querySelector('[data-dropdown-toggle="status-transaksi"]');
        handleDropdownSelection(statusDropdown, statusButton, filterTable);

        // Menutup dropdown jika klik di luar area dropdown
        document.addEventListener('click', (event) => {
            if (![jenisSampahButton, statusButton].some(btn => btn
                    .contains(event.target))) {
                document.getElementById('jenis-sampah').classList.add('hidden');
                document.getElementById('status-transaksi').classList.add('hidden');
            }
        });

        // Tombol Reset
        const resetButton = document.querySelector('.reset');

        resetButton.addEventListener('click', (event) => {
            event.preventDefault();

            // Reset semua dropdown ke kondisi awal
            const dropdowns = [{
                    button: jenisSampahButton,
                    defaultText: 'Pilih Kategori',
                    items: jenisSampahDropdown
                },
                {
                    button: statusButton,
                    defaultText: 'Pilih Status Transaksi',
                    items: statusDropdown
                },
            ];

            dropdowns.forEach(({
                button,
                defaultText,
                items
            }) => {
                // Reset teks tombol dropdown ke default
                button.textContent = defaultText;

                // Hilangkan class active dari semua opsi
                items.forEach(item => item.classList.remove('active'));
            });

            // Jalankan filterTable untuk menampilkan semua data
            filterTable();
        });
    }

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

        $(document).on('click', '.button-batal', function(e) {
            e.preventDefault();

            var uuid = $(this).data('uuid'); // Mengambil nilai UUID dari tombol

            let formData = new FormData();
            formData.append('status', 'Gagal');

            $.ajax({
                type: "POST",
                url: `{{ route('admin.update-transaksi', ['uuid' => 'UUID_PLACEHOLDER']) }}`
                    .replace('UUID_PLACEHOLDER', uuid),
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            text: response.message,
                            icon: "success",
                            showConfirmButton: false,
                            timer: 1500,
                        }).then(() => {
                            // Refresh halaman atau lakukan tindakan lain
                            window.location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: "Gagal",
                            text: response.message || "Data gagal dihapus.",
                            icon: "error",
                            showConfirmButton: true,
                        });
                    }
                },
                error: function(xhr) {
                    Swal.fire({
                        title: "Kesalahan",
                        text: "Terjadi kesalahan saat menghapus data.",
                        icon: "error",
                        showConfirmButton: true,
                    });
                },
            });
        });

        $(document).on('click', '.button-verifikasi', function(e) {
            e.preventDefault();

            var uuid = $(this).data('uuid'); // Mengambil nilai UUID dari tombol

            let formData = new FormData();
            formData.append('status', 'Lunas');

            $.ajax({
                type: "POST",
                url: `{{ route('admin.update-transaksi', ['uuid' => 'UUID_PLACEHOLDER']) }}`
                    .replace('UUID_PLACEHOLDER', uuid),
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            text: response.message,
                            icon: "success",
                            showConfirmButton: false,
                            timer: 1500,
                        }).then(() => {
                            // Refresh halaman atau lakukan tindakan lain
                            window.location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: "Gagal",
                            text: response.message || "Data gagal dihapus.",
                            icon: "error",
                            showConfirmButton: true,
                        });
                    }
                },
                error: function(xhr) {
                    Swal.fire({
                        title: "Kesalahan",
                        text: "Terjadi kesalahan saat menghapus data.",
                        icon: "error",
                        showConfirmButton: true,
                    });
                },
            });
        });

    });
</script>

</body>

</html>

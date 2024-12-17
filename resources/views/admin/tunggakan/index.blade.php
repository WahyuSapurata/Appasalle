<!-- resources/views/admin/login.blade.php -->
@section('title', $module)

@include('admin.partial-html._template-top')

@include('admin.layouts._sidebar')

<main class="dashboard-main">
    @include('admin.layouts._nav')
    <div class="dashboard-main-body">
        <div class="card bg-transparent border-0 mb-2">
            <div class="flex justify-end">
                <div class="flex gap-2">
                    <!-- Dropdown Start -->
                    <div class="">
                        <button data-dropdown-toggle="kelurahan" data-dropdown-placement="bottom"
                            class="text-[#4B635C] border text-[10px] font-semibold border-[#4B635C] bg-transparent hover:bg-primary-700 hover:text-white focus:ring-0 focus:outline-none focus:ring-primary-300 rounded-lg px-2 py-2 text-center inline-flex items-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 gap-5"
                            type="button">Kelurahan
                            <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <!-- Dropdown menu -->
                        <div id="kelurahan"
                            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-2xl w-44 dark:bg-gray-700">
                            <ul class="py-2 text-base text-[#4B635C] dark:text-gray-200">
                                <li>
                                    <a href="javascript:void(0)"
                                        class="active block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Semua</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Bara-Baraya</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Bara-Baraya
                                        Timur</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Bara-Baraya
                                        Selatan</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Bara-Baraya
                                        Utara</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Barana</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Lariang
                                        Bangi</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Maccini</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Maccini
                                        Gusung</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Maccini
                                        Parang</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Maradekaya</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Maradekaya
                                        Selatan</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Maredakaya
                                        Utara</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Maricaya</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Maricaya
                                        Baru</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- Dropdown End -->

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

                    <button
                        class="bg-[#FFDAD6] px-3 py-2 text-[#BA1A1A] text-[10px] font-semibold reset rounded-lg">RESET</button>
                </div>
            </div>
        </div>
        <div class="card border-0 overflow-hidden p-2">
            <table id="selection-table"
                class="border border-neutral-200 dark:border-neutral-600 rounded-lg border-separate	">
                <thead>
                    <tr>
                        <th scope="col" class="text-neutral-800 dark:text-white">
                            <div class="flex items-center gap-2 dark:text-white">
                                Nama Warga
                            </div>
                        </th>
                        <th scope="col" class="text-neutral-800 dark:text-white">
                            <div class="flex items-center gap-2 dark:text-white">
                                Kelurahan
                            </div>
                        </th>
                        <th scope="col" class="text-neutral-800 dark:text-white">
                            <div class="flex items-center gap-2 dark:text-white">
                                Kategori
                            </div>
                        </th>
                        <th scope="col" class="text-neutral-800 dark:text-white">
                            <div class="flex items-center gap-2 dark:text-white">
                                Total Tagihan
                            </div>
                        </th>
                        <th scope="col" class="text-neutral-800 dark:text-white">
                            <div class="flex items-center gap-2 dark:text-white">
                                Tunggakan
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tagihan as $item)
                        <tr>
                            <td>
                                <div class="flex items-center">
                                    <img src="{{ asset('warga/' . $item->foto) }}" alt=""
                                        class="shrink-0 me-3 rounded-full w-12 h-12">
                                    <div class="grid">
                                        <h6 class="text-[14px] mb-0 font-normal">{{ $item->nama }}</h6>
                                        <span class="text-[10px] font-semibold">{{ $item->nprw }}</span>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $item->kelurahan }}</td>
                            <td>{{ $item->jenis_sampah }}</td>
                            @if ($item->status == 'Lunas')
                                <td class="text-[#3E6837]">Rp {{ number_format($item->total_lunas, 0, ',', '.') }}</td>
                            @else
                                <td class="text-[#BA1A1A]">Rp
                                    {{ number_format($item->total_belum_lunas, 0, ',', '.') }}</td>
                            @endif
                            <td>
                                @if ($item->tagihan_bulan != 0)
                                    <div
                                        class="py-1 px-4 bg-[#FFDAD6] text-[#BA1A1A] text-[10px] text-center rounded-xl">
                                        {{ $item->tagihan_bulan }} BULAN
                                    </div>
                                @else
                                    <div
                                        class="py-1 px-4 bg-[#BFF0B1] text-[#3E6837] text-[10px] rounded-xl text-center">
                                        Lunas
                                    </div>
                                @endif

                            </td>
                        </tr>
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
                    select: [0, 4], // Nonaktifkan sorting pada kolom ke-0 dan ke-4
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

                // Ambil filter yang dipilih
                const kelurahan = document.querySelector("#kelurahan .active")?.textContent.trim().toLowerCase()
                    .replace(/\s+/g, ' ') ||
                    'semua';
                const jenisSampah = document.querySelector("#jenis-sampah .active")?.textContent.trim()
                    .toLowerCase().replace(/\s+/g, ' ') || 'semua';

                let visibleRows = 0;

                rows.forEach(row => {
                    // Ambil data dari kolom-kolom yang sesuai
                    const kelurahanCell = row.cells[1]?.textContent.trim()
                        .toLowerCase().replace(/\s+/g, ' '); // Kolom 1 untuk kelurahan

                    const jenisSampahCell = row.cells[2]?.textContent.trim()
                        .toLowerCase().replace(/\s+/g, ' '); // Kolom 4 untuk jenis sampah

                    // Tentukan apakah baris ini harus ditampilkan
                    const isKelurahanVisible = kelurahan === "semua" || kelurahan === kelurahanCell;
                    const isJenisSampahVisible = jenisSampah === "semua" || jenisSampah === jenisSampahCell;

                    // Sembunyikan atau tampilkan baris
                    const isVisible = isKelurahanVisible && isJenisSampahVisible;
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

        // Kelurahan Dropdown
        const kelurahanDropdown = document.querySelectorAll('#kelurahan a');
        const kelurahanButton = document.querySelector('[data-dropdown-toggle="kelurahan"]');
        handleDropdownSelection(kelurahanDropdown, kelurahanButton, filterTable);

        // Jenis Sampah Dropdown
        const jenisSampahDropdown = document.querySelectorAll('#jenis-sampah a');
        const jenisSampahButton = document.querySelector('[data-dropdown-toggle="jenis-sampah"]');
        handleDropdownSelection(jenisSampahDropdown, jenisSampahButton, filterTable);

        // Menutup dropdown jika klik di luar area dropdown
        document.addEventListener('click', (event) => {
            if (![kelurahanButton, jenisSampahButton].some(btn => btn
                    .contains(event.target))) {
                document.getElementById('kelurahan').classList.add('hidden');
                document.getElementById('jenis-sampah').classList.add('hidden');
            }
        });

        // Tombol Reset
        const resetButton = document.querySelector('.reset');

        resetButton.addEventListener('click', (event) => {
            event.preventDefault();

            // Reset semua dropdown ke kondisi awal
            const dropdowns = [{
                    button: kelurahanButton,
                    defaultText: 'Pilih Kelurahan',
                    items: kelurahanDropdown
                },
                {
                    button: jenisSampahButton,
                    defaultText: 'Pilih Kategori',
                    items: jenisSampahDropdown
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
</script>

</body>

</html>

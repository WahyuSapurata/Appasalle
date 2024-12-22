<!-- resources/views/admin/login.blade.php -->
@section('title', $module)

@include('admin.partial-html._template-top')

@include('admin.layouts._sidebar')

<main class="dashboard-main">
    @include('admin.layouts._nav')
    <div class="dashboard-main-body">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mb-3">
            <div class="card h-full p-0 border-0 overflow-hidden">
                <div
                    class="card-header border-b border-neutral-200 dark:border-neutral-600 bg-white dark:bg-neutral-700 py-4 px-6">
                    <h6 class="text-lg font-semibold mb-0 text-[#096B5A]">Nominal Realisasi & Target</h6>
                </div>
                <div class="card-body p-3">
                    <div class="grid gap-3">
                        <div class="text-[10px] text-[#6F7975] uppercase font-semibold text-right">Tahun Ini</div>
                        <div class="text-4xl font-normal">Rp
                            {{ number_format($totalTarifTahunIni, 0, ',', '.') }}</div>
                        <div class="w-full bg-primary-600/10 rounded-full h-2">
                            <div class="bg-primary-600 h-2 rounded-full dark:bg-primary-600"
                                style="width: {{ $persentaseTahunan }}%"></div>
                        </div>
                        <div class="grid">
                            <div class="text-[10px] text-[#6F7975] uppercase font-semibold text-right">Bulan Ini</div>
                            <div class="text-2xl text-[#6F7975] font-normal text-right">Rp
                                {{ number_format($totalTarifBulanIni, 0, ',', '.') }}</div>
                        </div>
                        <div class="grid">
                            <div class="text-[10px] text-[#6F7975] uppercase font-semibold text-right">hari Ini</div>
                            <div class="text-2xl text-[#6F7975] font-normal text-right">Rp
                                {{ number_format($totalTarifHariIni, 0, ',', '.') }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card h-full p-0 border-0 overflow-hidden">
                <div
                    class="card-header border-b border-neutral-200 dark:border-neutral-600 bg-white dark:bg-neutral-700 py-4 px-6">
                    <h6 class="text-lg font-semibold mb-0 text-[#096B5A]">Realisasi Per Kelurahan</h6>
                </div>
                <div id="card-overflow" class="card-body p-2 overflow-y-auto" style="height: 40vh">
                    <div class="flex gap-4 items-end justify-center mb-4">
                        @forelse ($kelurahanStats->take(3) as $index => $kelurahan)
                            <div
                                class="col-span-4 w-[108px] h-[{{ 120 + $index * 12 }}px] bg-[#CDE8DF] rounded-lg p-2 grid content-between">
                                <div class="text-3xl font-bold text-[#4B635C]">{{ $index + 1 }}</div>
                                <div class="text-sm font-normal text-[#4B635C]">{{ $kelurahan->kelurahan }}</div>
                                <div class="w-full bg-white rounded-full h-2">
                                    <div class="bg-[#4B635C] h-2 rounded-full"
                                        style="width: {{ $kelurahan->persentase }}%;"></div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-2 text-lg font-bold text-center text-slate-400 w-full">Belum ada
                                Relisasi</div>
                        @endforelse
                    </div>

                    <div class="grid gap-4">
                        @foreach ($kelurahanStats->skip(3) as $kelurahan)
                            <div class="flex justify-between items-center">
                                <div class="text-sm font-normal text-[#4B635C]">{{ $kelurahan->kelurahan }}</div>
                                <div class="w-20 bg-[#E9EFEC] rounded-full h-2">
                                    <div class="bg-[#4B635C] h-2 rounded-full"
                                        style="width: {{ $kelurahan->persentase }}%;"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div><!-- card end -->
            <div class="card h-full p-0 border-0 overflow-hidden">
                <div
                    class="card-header border-b border-neutral-200 dark:border-neutral-600 bg-white dark:bg-neutral-700 py-4 px-6">
                    <h6 class="text-lg font-semibold mb-0 text-[#096B5A]">Menunggu Verifikasi</h6>
                </div>
                <div class="card-body p-3">
                    @forelse ($transaksi as $item_transaksi)
                        <div class="flex items-center justify-between gap-3 cursor-pointer"
                            data-modal-target="authentication-modal{{ $item_transaksi->uuid }}"
                            data-modal-toggle="authentication-modal{{ $item_transaksi->uuid }}">
                            <div class="flex items-center">
                                <img src="{{ asset('warga/' . $item_transaksi->foto_warga) }}" alt=""
                                    class="shrink-0 me-3 rounded-full w-10 h-10">
                                <div class="grid">
                                    <h6 class="text-[14px] mb-0 font-normal">{{ $item_transaksi->nama }}</h6>
                                    <span class="text-[10px] font-semibold">{{ $item_transaksi->nprw }}</span>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="flex gap-2 items-center">
                                    <span class="text-[10px] text-[#426277] font-semibold">Rp
                                        {{ number_format($item_transaksi->terbayarkan, 0, ',', '.') }}</span>
                                    <div class="h-6 w-6 bg-[#CDE8DF] flex items-center justify-center rounded-full">
                                        <iconify-icon icon="mage:reload"
                                            class="menu-icon text-[10px] text-[#426277]"></iconify-icon>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="authentication-modal{{ $item_transaksi->uuid }}" tabindex="-1" aria-hidden="true"
                            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-md max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <!-- Modal body -->
                                    <div class="p-4 md:p-5 grid gap-4">
                                        <div class="flex gap-2 items-center">
                                            <div
                                                class="h-6 w-6 {{ $item_transaksi->status == 'Lunas' ? 'bg-[#BFF0B1]' : 'bg-[#CDE8DF]' }} flex items-center justify-center rounded-full">
                                                <iconify-icon
                                                    icon="{{ $item_transaksi->status == 'Lunas' ? 'tabler:check' : 'mage:reload' }}"
                                                    class="menu-icon text-[10px] text-[#3E6837]"></iconify-icon>
                                            </div>
                                            <span
                                                class="text-[10px] text-[#426277] font-semibold uppercase">{{ $item_transaksi->status == 'Lunas' ? 'Lunas' : 'Pembayaran Diproses' }}</span>
                                        </div>

                                        <div class="rounded-lg p-6 text-center h-[180px] bg-no-repeat bg-cover bg-center opacity-80 flex items-center justify-center"
                                            style="background-image: url({{ asset('bukti/' . $item_transaksi->foto) }})">
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
                                                <img src="{{ asset('bukti/' . $item_transaksi->foto) }}"
                                                    alt="Bukti Transaksi" class="max-w-[90vw] max-h-[90vh]">
                                            </div>
                                        </div>

                                        <div class="grid">
                                            <div class="text-[10px] font-semibold uppercase">no. transaksi</div>
                                            <div class="text-base font-normal">
                                                {{ $item_transaksi->no_transaksi . '-' . $item_transaksi->nprw }}
                                            </div>
                                        </div>
                                        <div class="grid">
                                            <div class="text-[10px] font-semibold uppercase">WAKTU transaksi</div>
                                            <div class="text-base font-normal">
                                                {{ $item_transaksi->created_at ? \Carbon\Carbon::parse($item_transaksi->created_at)->format('d/m/Y, H:i') : '-' }}
                                            </div>
                                        </div>
                                        <div class="grid">
                                            <div class="text-[10px] font-semibold uppercase">ID PELANGGAN / NPWR
                                            </div>
                                            <div class="flex items-center">
                                                <img src="{{ asset('warga/' . $item_transaksi->foto_warga) }}"
                                                    alt="" class="shrink-0 me-3 rounded-full w-12 h-12">
                                                <div class="grid">
                                                    <h6 class="text-[14px] mb-0 font-normal">
                                                        {{ $item_transaksi->nama }}</h6>
                                                    <span
                                                        class="text-[10px] font-semibold">{{ $item_transaksi->nprw }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="grid">
                                            <div class="text-[10px] font-semibold uppercase">alamat</div>
                                            <div class="text-base font-normal">{{ $item_transaksi->alamat }}</div>
                                            <div class="text-base font-normal">RT {{ $item_transaksi->rt }} / RW
                                                {{ $item_transaksi->rw }}</div>
                                            <div class="text-base font-normal">Kelurahan
                                                {{ $item_transaksi->kelurahan }}</div>
                                            <div class="text-base font-normal">Kecamatan Makassar</div>
                                        </div>
                                        <div class="grid">
                                            <div class="text-[10px] font-semibold uppercase">tagihan dibayarkan
                                            </div>
                                            <!-- List Item -->
                                            <div class="p-1">
                                                @foreach ($item_transaksi->bulan_tagihan as $bulan)
                                                    <div class="py-2 border-b">
                                                        <div class="flex items-center justify-between">
                                                            <span
                                                                class="text-sm font-normal">{{ \Carbon\Carbon::createFromFormat('Y m d', $bulan)->formatLocalized('%B %Y') }}</span>
                                                            <span class="price text-[#426277] text-sm font-medium">Rp
                                                                {{ number_format($item_transaksi->tarif, 0, ',', '.') }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>

                                            <!-- Total -->
                                            <div class="mt-4 text-base font-medium flex justify-between">
                                                <span>Total Retribusi:</span>
                                                <span class="text-[#426277]">Rp
                                                    {{ number_format($item_transaksi->terbayarkan, 0, ',', '.') }}</span>
                                            </div>
                                        </div>
                                        <div class="flex gap-2 justify-between">
                                            <button type="button"
                                                class="button-batal flex w-full justify-center items-center gap-2 text-[#BA1A1A] bg-[#FFDAD6] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-1 text-center uppercase"
                                                data-uuid="{{ $item_transaksi->uuid }}">
                                                <iconify-icon icon="line-md:remove" class="menu-icon"></iconify-icon>
                                                <span>Batalkan</span>
                                            </button>
                                            <button type="button"
                                                class="button-verifikasi flex w-full justify-center items-center gap-2 text-white bg-[#096B5A] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-1 text-center uppercase"
                                                data-uuid="{{ $item_transaksi->uuid }}">
                                                <iconify-icon icon="tabler:check" class="menu-icon"></iconify-icon>
                                                <span>Verifikasi</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-2 text-lg font-bold text-center text-slate-400 w-full">Belum ada
                            Transaksi Diproses</div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="card border-0 shadow mb-4">
            <!-- Card Header -->
            <div
                class="card-header border-b border-neutral-200 dark:border-neutral-600 bg-white dark:bg-neutral-700 py-4 px-6">
                <h6 class="text-lg font-semibold mb-0 text-[#096B5A]">Transaksi Per Bulan</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="mb-3 w-max">
                    <select name="filter_year" class="form-select" id="filter_year_select"
                        placeholder="Silahkan pilih tahun">
                    </select>
                </div>
                <div class="chart-area">
                    <!-- No Data Section -->
                    <div id="noData" class="grid justify-center gap-5 items-center">
                        <div class="text-muted text-sm">Grafik Masih Kosong Pilih Tahun Terlebih Dahulu</div>
                    </div>

                    <!-- Chart Section -->
                    <div id="onData" class="hidden">
                        <canvas id="myAreaChart" class="max-h-[400px]"></canvas>
                    </div>
                </div>
            </div>
        </div>

    </div>

    @include('admin.layouts._footer')
</main>

@include('admin.partial-html._template-bottom')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

    const generateSchoolYears = (startYear) => {
        const currentYear = new Date().getFullYear();
        const years = [];
        for (let year = startYear; year <= currentYear; year++) {
            years.push({
                text: year
            });
        }
        return years.reverse(); // Urutan tahun terbaru ke lama
    };

    const dataYears = generateSchoolYears(2000);

    document.addEventListener('DOMContentLoaded', function() {
        const yearSelect = document.getElementById('filter_year_select');
        const noDataDiv = document.getElementById('noData');
        const onDataDiv = document.getElementById('onData');
        const ctx = document.getElementById('myAreaChart').getContext('2d');
        let myChart;

        // Populate dropdown tahun
        dataYears.forEach((year) => {
            const option = document.createElement('option');
            option.value = year.text;
            option.textContent = year.text;
            yearSelect.appendChild(option);
        });

        // Set tahun sekarang secara otomatis
        const currentYear = new Date().getFullYear();
        yearSelect.value = currentYear; // Set nilai dropdown ke tahun sekarang

        // Event ketika tahun dipilih
        yearSelect.addEventListener('change', async function() {
            const selectedYear = this.value;

            if (selectedYear) {
                noDataDiv.classList.add('hidden');
                onDataDiv.classList.remove('hidden');
                $('.loading').show(); // Tampilkan loading state

                try {
                    // AJAX request ke backend
                    const response = await $.ajax({
                        url: '/admin/chart',
                        method: 'GET',
                        data: {
                            selectedYear
                        },
                    });

                    if (response.success && response.data.labels.length > 0) {
                        renderChart(response.data); // Render chart dengan data dari backend
                    } else {
                        clearChart();
                        noDataDiv.classList.remove('hidden');
                        onDataDiv.classList.add('hidden');
                        console.log('Tidak ada data untuk tahun yang dipilih.');
                    }
                } catch (error) {
                    console.error('Gagal mengambil data:', error);
                    clearChart();
                    noDataDiv.classList.remove('hidden');
                    onDataDiv.classList.add('hidden');
                } finally {
                    $('.loading').hide(); // Sembunyikan loading
                }
            } else {
                clearChart();
                noDataDiv.classList.remove('hidden');
                onDataDiv.classList.add('hidden');
            }
        });

        // Panggil event change setelah tahun di-set
        yearSelect.dispatchEvent(new Event('change'));

        // Fungsi untuk merender Chart.js
        function renderChart(data) {
            if (myChart) myChart.destroy(); // Hapus chart sebelumnya jika ada

            // Ambil data dari backend
            const labels = data.labels; // Bulan
            const datasets = data.datasets.map((dataset, index) => {
                // Menyiapkan data untuk chart berdasarkan status (Lunas, Belum Lunas, Proses)
                const chartData = dataset.data.map(item =>
                    item); // Ambil data langsung tanpa perlu akses 'total'

                return {
                    label: dataset.label,
                    data: chartData,
                    backgroundColor: dataset.backgroundColor,
                };
            });

            // Render chart
            myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels, // Bulan
                    datasets: datasets, // Data untuk setiap status (Lunas, Belum Lunas, Proses)
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return 'Rp ' + value.toLocaleString('id-ID');
                                },
                            },
                        },
                    },
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return `${context.dataset.label}: Rp ${context.raw.toLocaleString('id-ID')}`;
                                },
                            },
                        },
                    },
                },
            });
        }

        // Fungsi untuk membersihkan chart
        function clearChart() {
            if (myChart) {
                myChart.destroy();
                myChart = null;
            }
        }
    });
</script>

</body>

</html>

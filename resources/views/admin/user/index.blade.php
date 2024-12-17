<!-- resources/views/admin/login.blade.php -->
@section('title', $module)

@include('admin.partial-html._template-top')

@include('admin.layouts._sidebar')
<main class="dashboard-main">
    @include('admin.layouts._nav')
    <div class="dashboard-main-body">
        <div class="card bg-transparent border-0 mb-2">
            <div class="flex gap-2 justify-between">
                <button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" type="button"
                    class="flex items-center gap-2 px-5 py-0 btn text-white bg-[#096B5A]">
                    <iconify-icon icon="pepicons-pop:plus" class="menu-icon"></iconify-icon>
                    <span class="text-[10px] font-semibold">TAMBAH USER</span>
                </button>
                <!-- Main modal -->
                <div id="authentication-modal" tabindex="-1" aria-hidden="true"
                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-md max-h-full">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <!-- Modal body -->
                            <div class="p-4 md:p-5">
                                <form id="form-submit" class="space-y-4 grid grid-cols-2 gap-1">
                                    <!-- Upload Image Start -->
                                    <div class="col-span-2">
                                        <div class="avatar-upload">
                                            <div
                                                class="avatar-edit absolute bottom-0 end-0 me-6 mt-4 z-[1] cursor-pointer">
                                                <input type='file' name="foto" id="imageUpload"
                                                    accept=".png, .jpg, .jpeg" hidden>
                                                <label for="imageUpload"
                                                    class="w-8 h-8 flex justify-center items-center bg-primary-50 dark:bg-primary-600/25 text-primary-600 dark:text-primary-400 border border-primary-600 hover:bg-primary-100 text-lg rounded-full cursor-pointer">
                                                    <iconify-icon icon="solar:camera-outline"
                                                        class="icon"></iconify-icon>
                                                </label>
                                            </div>
                                            <div class="avatar-preview">
                                                <div id="imagePreview"> </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Upload Image End -->
                                    <div class="col-span-2">
                                        <label for="name"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white uppercase">
                                            nama</label>
                                        <input type="text" name="name" id="name"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                            placeholder="Masukkan Nama" />
                                        <div class="text-danger-600 text-sm name_error">
                                        </div>
                                    </div>
                                    <div class="col-span-2">
                                        <label for="username"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white uppercase">
                                            username</label>
                                        <input type="text" name="username" id="username"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                            placeholder="Masukkan Username" />
                                        <div class="text-danger-600 text-sm username_error">
                                        </div>
                                    </div>
                                    <div class="col-span-2">
                                        <label for="your-password"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white uppercase">
                                            password</label>
                                        <div class="relative">
                                            <div class="icon-field">
                                                <input type="password" name="password"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                                    id="your-password" placeholder="Password">
                                            </div>
                                            <span
                                                class="toggle-password ri-eye-line cursor-pointer absolute end-0 top-1/2 -translate-y-1/2 me-4 text-secondary-light"
                                                data-toggle="#your-password"></span>
                                        </div>
                                        <div class="text-danger-600 text-sm password_error">
                                        </div>
                                    </div>
                                    <div class="col-span-2">
                                        <label class="block text-sm font-medium text-gray-700">ROLE</label>
                                        <div id="role-options" class="flex items-center justify-between space-x-4 mt-2">
                                            <div class="flex gap-2 items-center">
                                                <input type="radio" id="admin" name="role" value="admin"
                                                    class="peer">
                                                <label for="admin"
                                                    class="cursor-pointer text-gray-600 peer-checked:text-[#096B5A]">
                                                    Admin
                                                </label>
                                            </div>
                                            <div class="flex gap-2 items-center">
                                                <input type="radio" id="monitoring" name="role" value="monitoring"
                                                    class="peer">
                                                <label for="monitoring"
                                                    class="cursor-pointer text-gray-600 peer-checked:text-[#096B5A]">
                                                    Monitoring
                                                </label>
                                            </div>
                                            <div class="flex gap-2 items-center">
                                                <input type="radio" id="kolektor" name="role" value="kolektor"
                                                    class="peer">
                                                <label for="kolektor"
                                                    class="cursor-pointer text-gray-600 peer-checked:text-[#096B5A]">
                                                    Kolektor
                                                </label>
                                            </div>
                                        </div>
                                        <div class="text-danger-600 text-sm role_error">
                                        </div>
                                    </div>
                                    <div id="additional-fields" class="hidden grid col-span-2 gap-5 w-full">
                                        <div class="col-span-2">
                                            <label for="kelurahan-modal"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white uppercase">kelurahan</label>
                                            <select id="kelurahan-modal" name="kelurahan"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                <option selected="">Pilih Kelurahan</option>
                                                <option value="Bara-Baraya">Bara-Baraya</option>
                                                <option value="Bara-Baraya Timur">Bara-Baraya Timur</option>
                                                <option value="Bara-Baraya Selatan">Bara-Baraya Selatan</option>
                                                <option value="Bara-Baraya Utara">Bara-Baraya Utara</option>
                                                <option value="Barana">Barana</option>
                                                <option value="Lariang Bangi">Lariang Bangi</option>
                                                <option value="Maccini">Maccini</option>
                                                <option value="Maccini Gusung">Maccini Gusung</option>
                                                <option value="Maccini Parang">Maccini Parang</option>
                                                <option value="Maradekaya">Maradekaya</option>
                                                <option value="Maradekaya Selatan">Maradekaya Selatan</option>
                                                <option value="Maredakaya Utara">Maredakaya Utara</option>
                                                <option value="Maricaya">Maricaya</option>
                                                <option value="Maricaya Bar">Maricaya Bar</option>
                                            </select>
                                            <div class="text-danger-600 text-sm kelurahan_error">
                                            </div>
                                        </div>
                                        <div class="flex col-span-2 gap-1 w-full">
                                            <div class="col-span-1 w-full">
                                                <label for="rt-modal"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white uppercase">rt</label>
                                                <input type="number" name="rt" id="rt-modal"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    placeholder="000">
                                                <div class="text-danger-600 text-sm rt_error">
                                                </div>
                                            </div>
                                            <div class="col-span-1 w-full">
                                                <label for="rw-modal"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white uppercase">rw</label>
                                                <input type="number" name="rw" id="rw-modal"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    placeholder="000">
                                                <div class="text-danger-600 text-sm rw_error">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-span-2 flex justify-end">
                                        <div class="flex gap-2">
                                            <button data-modal-hide="authentication-modal" type="button"
                                                class="text-[#096B5A] bg-transparent font-medium text-sm px-3 py-2.5 text-center uppercase">
                                                batalkan
                                            </button>
                                            <button type="button" id="submit-form"
                                                class="flex items-center gap-2 text-white bg-[#096B5A] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2.5 text-center uppercase">
                                                <iconify-icon icon="material-symbols:save" class="menu-icon"
                                                    style="font-size: 20px;"></iconify-icon>
                                                <span>simpan</span>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex gap-2">
                    <!-- Dropdown Start -->
                    <div class="">
                        <button data-dropdown-toggle="role" data-dropdown-placement="bottom"
                            class="text-[#4B635C] border text-[10px] font-semibold border-[#4B635C] bg-transparent hover:bg-primary-700 hover:text-white focus:ring-0 focus:outline-none focus:ring-primary-300 rounded-lg px-2 py-2 text-center inline-flex items-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 gap-5"
                            type="button">Role
                            <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <!-- Dropdown menu -->
                        <div id="role"
                            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-2xl w-44 dark:bg-gray-700">
                            <ul class="py-2 text-base text-[#4B635C] dark:text-gray-200">
                                <li>
                                    <a href="javascript:void(0)"
                                        class="active block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Semua</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Admin</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Kolektor
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Monitoring</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- Dropdown End -->

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
                            <div class="flex items-center gap-2">
                                Nama Warga
                            </div>
                        </th>
                        <th scope="col" class="text-neutral-800 dark:text-white">
                            <div class="flex items-center gap-2">
                                Username
                            </div>
                        </th>
                        <th scope="col" class="text-neutral-800 dark:text-white">
                            <div class="flex items-center gap-2">
                                Kelurahan
                            </div>
                        </th>
                        <th scope="col" class="text-neutral-800 dark:text-white">
                            <div class="flex items-center gap-2">
                                RW
                            </div>
                        </th>
                        <th scope="col" class="text-neutral-800 dark:text-white">
                            <div class="flex items-center gap-2">
                                RT
                            </div>
                        </th>
                        <th scope="col" class="text-neutral-800 dark:text-white">
                            <div class="flex items-center gap-2">
                                Role
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user as $item)
                        <tr onclick="window.location.href='{{ route('admin.profil-admin', ['uuid' => $item->uuid]) }}';"
                            class="cursor-pointer">
                            <td>
                                <div class="flex items-center gap-2">
                                    @if ($item->foto)
                                        <img src="{{ asset('user/' . $item->foto) }}" alt=""
                                            class="shrink-0 rounded-full w-12 h-12">
                                    @else
                                        <div class="w-12 h-12 bg-[#d9dce1] rounded-full flex items-end justify-center">
                                            <iconify-icon icon="mdi:user" width="45px" heiht="45px"
                                                class="menu-icon"></iconify-icon>
                                        </div>
                                    @endif
                                    <h6 class="text-[14px] mb-0 font-normal">{{ $item->name }}</h6>
                                </div>
                            </td>
                            <td>{{ $item->username }}</td>
                            <td>{{ $item->kelurahan ? $item->kelurahan : '-' }}</td>
                            <td>{{ $item->rw ? $item->rw : '-' }} </td>
                            <td>{{ $item->rt ? $item->rt : '-' }}</td>
                            <td>{{ $item->role }}</td>
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
    $(document).ready(function() {
        // Event listener untuk perubahan role
        $('input[name="role"]').change(function() {
            if ($(this).val() === 'kolektor') {
                $('#additional-fields').removeClass('hidden'); // Tampilkan Kelurahan, RW, RT
            } else {
                $('#additional-fields').addClass('hidden'); // Sembunyikan Kelurahan, RW, RT
            }
        });
    });

    $(document).ready(function() {
        // Setup CSRF Token
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        // Submit Form
        $("#submit-form").click(function(e) {
            e.preventDefault(); // Mencegah reload halaman

            let formData = new FormData($("#form-submit")[
                0]); // Gunakan FormData untuk menyertakan file upload

            $.ajax({
                type: "POST",
                url: "{{ route('admin.add-user') }}",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $(".text-danger-600").html(""); // Hapus pesan error sebelumnya
                    if (response.success) {
                        Swal.fire({
                            text: "Data berhasil ditambahkan",
                            icon: "success",
                            showConfirmButton: false,
                            timer: 1500,
                        }).then(() => {
                            location.reload(); // Reload halaman setelah alert
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
                    $(".text-danger-600").html(""); // Hapus pesan error sebelumnya
                    $.each(xhr.responseJSON.errors, function(key, value) {
                        $(`.${key}_error`).html(
                            value); // Tampilkan pesan error dari backend
                    });
                },
            });
        });
    });

    if (document.getElementById("selection-table") && typeof simpleDatatables.DataTable !== 'undefined') {
        let rowNavigation = false;
        let table = null;

        // Fungsi untuk reset dan inisialisasi tabel
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
                        if (node.nodeType === Node.TEXT_NODE && node.textContent.includes(
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
                const role = document.querySelector("#role .active")?.textContent.trim()
                    .toLowerCase().replace(/\s+/g, ' ') || 'semua';

                let visibleRows = 0;

                rows.forEach(row => {
                    // Ambil data dari kolom-kolom yang sesuai
                    const kelurahanCell = row.cells[2]?.textContent.trim()
                        .toLowerCase().replace(/\s+/g, ' '); // Kolom 1 untuk kelurahan
                    const roleCell = row.cells[5]?.textContent.trim()
                        .toLowerCase().replace(/\s+/g, ' '); // Kolom 4 untuk jenis sampah

                    // Tentukan apakah baris ini harus ditampilkan
                    const isKelurahanVisible = kelurahan === "semua" || kelurahan === kelurahanCell;
                    const isRoleVisible = role === "semua" || role === roleCell;

                    // Sembunyikan atau tampilkan baris
                    const isVisible = isKelurahanVisible &&
                        isRoleVisible;
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
        const roleDropdown = document.querySelectorAll('#role a');
        const roleButton = document.querySelector('[data-dropdown-toggle="role"]');
        handleDropdownSelection(roleDropdown, roleButton, filterTable);


        // Menutup dropdown jika klik di luar area dropdown
        document.addEventListener('click', (event) => {
            if (![kelurahanButton, roleButton].some(btn => btn
                    .contains(event.target))) {
                document.getElementById('kelurahan').classList.add('hidden');
                document.getElementById('role').classList.add('hidden');
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
                    button: roleButton,
                    defaultText: 'Pilih Jenis Sampah',
                    items: roleDropdown
                }
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

    // ================== Image Upload Js Start ===========================
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                $('#imagePreview').hide();
                $('#imagePreview').fadeIn(650);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#imageUpload").change(function() {
        readURL(this);
    });
    // ================== Image Upload Js End ===========================

    // ================== Password Show Hide Js Start ==========
    function initializePasswordToggle(toggleSelector) {
        $(toggleSelector).on('click', function() {
            $(this).toggleClass("ri-eye-off-line");
            var input = $($(this).attr("data-toggle"));
            if (input.attr("type") === "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    }
    // Call the function
    initializePasswordToggle('.toggle-password');
    // ========================= Password Show Hide Js End ===========================
</script>

</body>

</html>

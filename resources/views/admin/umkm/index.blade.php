<!-- resources/views/admin/login.blade.php -->
@section('title', $module)

@include('admin.partial-html._template-top')

@include('admin.layouts._sidebar')
<main class="dashboard-main">
    @include('admin.layouts._nav')
    <div class="dashboard-main-body">
        <div class="grid grid-cols-3 gap-2">
            <div class="col-span-2">
                <div class="card bg-transparent border-0 mb-2">
                    <div class="flex gap-2 justify-between">
                        <div class="flex gap-2">
                            <button id="btn-tambah" type="button" data-modal-target="authentication-modal"
                                data-modal-toggle="authentication-modal"
                                class="flex items-center gap-2 px-5 py-0 btn text-white bg-[#096B5A]">
                                <iconify-icon icon="pepicons-pop:plus" class="menu-icon"></iconify-icon>
                                <span class="text-[10px] font-semibold">TAMBAH UMKM</span>
                            </button>

                            <button data-modal-target="authentication-modal-upload"
                                data-modal-toggle="authentication-modal-upload" type="button"
                                class="flex items-center gap-2 px-5 py-0 btn text-white bg-[#096B5A]">
                                <iconify-icon icon="line-md:upload-loop" class="menu-icon"></iconify-icon>
                                <span class="text-[10px] font-semibold">IMPORT DATA UMKM</span>
                            </button>
                        </div>
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
                                                <div
                                                    class="w-full h-[210px] bg-gray-300 rounded-lg flex items-center justify-center relative">
                                                    <iconify-icon icon="lucide:image" id="icon-default"
                                                        class="menu-icon text-[120px] text-gray-500"></iconify-icon>
                                                    <div id="imagePreviewUmkm"
                                                        class="image-preview absolute inset-0 bg-cover bg-center rounded-lg hidden">
                                                    </div>
                                                    <input type="file" id="imageUpload" accept=".png, .jpg, .jpeg"
                                                        class="image-upload" name="foto" hidden>
                                                    <label for="imageUpload"
                                                        class="absolute bottom-3 right-3 w-8 h-8 flex justify-center items-center bg-primary-50 dark:bg-primary-600/25 text-primary-600 dark:text-primary-400 border border-primary-600 hover:bg-primary-100 text-lg rounded-full cursor-pointer">
                                                        <iconify-icon icon="solar:camera-outline"
                                                            class="icon"></iconify-icon>
                                                    </label>
                                                </div>
                                            </div>
                                            <!-- Upload Image End -->
                                            <div class="col-span-2">
                                                <label for="nama_umkm"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white uppercase">
                                                    nama umkm</label>
                                                <input type="text" name="nama_umkm" id="nama_umkm"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                                    placeholder="Contoh: Bakso Top Super" />
                                                <div class="text-danger-600 text-sm nama_umkm_error"></div>
                                            </div>
                                            <div class="col-span-2">
                                                <label for="alamat"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white uppercase">
                                                    alamat </label>
                                                <input type="text" name="alamat" id="alamat"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                                    placeholder="Contoh: Jl. Ahmad Yani No. 2" />
                                                <div class="text-danger-600 text-sm alamat_error"></div>
                                            </div>
                                            <div class="col-span-1">
                                                <label for="rt-modal"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white uppercase">rt</label>
                                                <input type="number" name="rt" id="rt-modal"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    placeholder="000">
                                                <div class="text-danger-600 text-sm rt_error"></div>
                                            </div>
                                            <div class="col-span-1">
                                                <label for="rw-modal"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white uppercase">rw</label>
                                                <input type="number" name="rw" id="rw-modal"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    placeholder="000">
                                                <div class="text-danger-600 text-sm rw_error"></div>
                                            </div>
                                            <div class="col-span-2">
                                                <label for="kelurahan-modal"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white uppercase">kelurahan</label>
                                                <select id="kelurahan-modal" name="kelurahan"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                    <option value="">Pilih Kelurahan</option>
                                                    <option value="Bara-Baraya">Bara-Baraya</option>
                                                    <option value="Bara-Baraya Timur">Bara-Baraya Timur
                                                    </option>
                                                    <option value="Bara-Baraya Selatan">Bara-Baraya
                                                        Selatan</option>
                                                    <option value="Bara-Baraya Utara">Bara-Baraya Utara
                                                    </option>
                                                    <option value="Barana">Barana</option>
                                                    <option value="Lariang Bangi">Lariang Bangi</option>
                                                    <option value="Maccini">Maccini</option>
                                                    <option value="Maccini Gusung">Maccini Gusung
                                                    </option>
                                                    <option value="Maccini Parang">Maccini Parang
                                                    </option>
                                                    <option value="Maradekaya">Maradekaya</option>
                                                    <option value="Maradekaya Selatan">Maradekaya
                                                        Selatan</option>
                                                    <option value="Maredakaya Utara">Maredakaya Utara
                                                    </option>
                                                    <option value="Maricaya">Maricaya</option>
                                                    <option value="Maricaya Bar">Maricaya Bar</option>
                                                </select>
                                                <div class="text-danger-600 text-sm kelurahan_error"></div>
                                            </div>
                                            <div class="col-span-2">
                                                <label for="jenis_umkm-modal"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white uppercase">jenis
                                                    umkm</label>
                                                <input type="text" name="jenis_umkm" id="jenis_umkm"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    placeholder="Makanan, Jasa, dll">
                                                <div class="text-danger-600 text-sm jenis_umkm_error"></div>
                                            </div>
                                            <div class="col-span-2">
                                                <label for="telepon"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white uppercase">No.
                                                    telepon</label>
                                                <input type="text" name="telepon" id="telepon"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    placeholder="+62812 xxxx xxxx">
                                                <div class="text-danger-600 text-sm telepon_error"></div>
                                            </div>
                                            <div class="col-span-2">
                                                <label for="sosial_media"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white uppercase">sosial
                                                    media</label>
                                                <input type="text" name="sosial_media" id="sosial_media"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    placeholder="Link Instagram, Facebook, atau Tiktok">
                                                <div class="text-danger-600 text-sm sosial_media_error"></div>
                                            </div>
                                            <div class="col-span-2 flex justify-between items-center">
                                                <button data-modal-hide="authentication-modal" type="reset"
                                                    class="text-[#096B5A] bg-transparent font-medium text-sm px-3 py-2.5 text-center uppercase">
                                                    keluar
                                                </button>
                                                <button type="submit" id="submit-form"
                                                    class="flex items-center gap-2 text-white bg-[#096B5A] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2.5 text-center uppercase">
                                                    <iconify-icon icon="material-symbols:save" class="menu-icon"
                                                        style="font-size: 20px;"></iconify-icon>
                                                    <span>simpan</span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="authentication-modal-upload" tabindex="-1" aria-hidden="true"
                            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-md max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <!-- Modal body -->
                                    <div class="p-4 md:p-5">
                                        <form class="space-y-4 grid grid-cols-2 gap-1"
                                            action="{{ route('admin.import-umkm') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="col-span-2">
                                                <div
                                                    class="border-2 border-dashed border-[#096B5A] rounded-lg p-6 text-center">
                                                    <iconify-icon icon="line-md:cloud-alt-upload-twotone-loop"
                                                        class="menu-icon text-5xl text-[#096B5A] mx-auto"></iconify-icon>
                                                    <p class="text-[10px] text-[#096B5A] mt-4 mb-0">Berkas <span
                                                            class="font-medium">.csv</span>, <span
                                                            class="font-medium">.xls</span>, <span
                                                            class="font-medium">.xlsx</span></p>
                                                    <p class="text-[#096B5A] text-xs mb-0">Seret dan lepas berkas
                                                        kesini
                                                        untuk
                                                        mengunggah <br> atau</p>
                                                    <div class="flex justify-center">
                                                        <label
                                                            class="flex items-center w-max mt-4 px-4 py-2 bg-teal-100 text-teal-700 border rounded-md cursor-pointer hover:bg-teal-200">
                                                            <input type="file" name="file" class="hidden"
                                                                accept=".csv, .xls, .xlsx">
                                                            <iconify-icon icon="line-md:upload-loop"
                                                                class="mr-2"></iconify-icon>
                                                            <span>BROWSE FILE</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-span-2 flex justify-end">
                                                <div class="flex gap-2">
                                                    <button data-modal-hide="authentication-modal-upload"
                                                        type="reset"
                                                        class="text-[#096B5A] bg-transparent font-medium text-sm px-3 py-2.5 text-center uppercase">
                                                        batalkan
                                                    </button>
                                                    <button type="submit"
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
                                <button data-dropdown-toggle="kelurahan" data-dropdown-placement="bottom"
                                    class="text-[#4B635C] border text-[10px] font-semibold border-[#4B635C] bg-transparent hover:bg-primary-700 hover:text-white focus:ring-0 focus:outline-none focus:ring-primary-300 rounded-lg px-2 py-2 text-center inline-flex items-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 gap-5"
                                    type="button">Kelurahan
                                    <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
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
                                        Kelurahan
                                    </div>
                                </th>
                                <th scope="col" class="text-neutral-800 dark:text-white">
                                    <div class="flex items-center gap-2">
                                        Bidang Usaha
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($umkm as $item)
                                <tr onclick="cardBlock('{{ $item->uuid }}')" class="cursor-pointer">
                                    <td>
                                        <div class="flex items-center">
                                            <img src="{{ asset('umkm/' . $item->foto) }}" alt=""
                                                class="shrink-0 me-3 w-11 h-11 rounded-lg">
                                            <div class="grid">
                                                <h6 class="text-[14px] mb-0 font-normal">{{ $item->nama_umkm }}</h6>
                                                <span class="text-[10px] font-semibold">{{ $item->alamat }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $item->kelurahan }}</td>
                                    <td>{{ $item->jenis_umkm }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-span-1">
                <div id="card-hidden" class="grid items-center justify-items-center gap-2 h-[72vh] content-center">
                    <div class="w-60 h-[180px] bg-gray-300 rounded-lg flex items-center justify-center">
                        <iconify-icon icon="lucide:image" class="menu-icon text-[120px] text-gray-500"></iconify-icon>
                    </div>
                    <div class="text-base font-normal">Klik UMKM disamping untuk Preview</div>
                </div>
                <div id="card-produk" class="card border-0 p-2 hidden">
                    <div class="grid gap-2 justify-items-center">
                        <div class="w-full h-[240px] bg-gray-300 rounded-lg flex items-center justify-center relative">
                            <!-- Ikon default -->
                            <iconify-icon id="defaultIcon" icon="lucide:image"
                                class="menu-icon text-[120px] text-gray-500"></iconify-icon>

                            <!-- Gambar produk -->
                            <div id="imageProduk" class="absolute inset-0 bg-cover bg-center rounded-lg hidden"></div>
                        </div>

                        <div id="nama-produk" class="text-xl text-[#096B5A] font-normal"></div>
                        <div id="alamat-produk" class="text-base font-normal"></div>
                        <div class="flex gap-4">
                            <!-- Tombol Telepon -->
                            <a id="callButton" href="#" target="_blank"
                                class="flex items-center justify-center gap-2 btn bg-[#096B5A] p-2 rounded-full hidden">
                                <iconify-icon icon="material-symbols:call"
                                    class="menu-icon text-[24px] text-white"></iconify-icon>
                                <span class="text-white text-sm">Hubungi</span>
                            </a>

                            <!-- Tombol Website -->
                            <a id="websiteButton" href="#" target="_blank"
                                class="flex items-center justify-center gap-2 btn bg-[#096B5A] p-2 rounded-full hidden">
                                <iconify-icon icon="mdi:internet"
                                    class="menu-icon text-[24px] text-white"></iconify-icon>
                                <span class="text-white text-sm">Website</span>
                            </a>
                        </div>

                        <div class="flex w-full gap-2">
                            <button id="btn-edit" type="button" data-modal-target="authentication-modal"
                                data-modal-toggle="authentication-modal"
                                class="w-full flex items-center justify-center gap-2 btn bg-[#A1F2DC] p-2">
                                <iconify-icon icon="solar:pen-bold"
                                    class="menu-icon text-[12px] text-[#096B5A]"></iconify-icon>
                                <span class="text-[10px] font-semibold text-[#096B5A] uppercase">edit profil
                                    umkm</span>
                            </button>
                            <button type="button" id="delete"
                                class="flex items-center justify-center gap-2 btn bg-[#FFDAD6] p-2">
                                <iconify-icon icon="mdi:trash"
                                    class="menu-icon text-[12px] text-[#BA1A1A]"></iconify-icon>
                            </button>
                        </div>
                        <div class="text-base text-[#096B5A] font-medium text-left w-full">Menu</div>
                        <div class="grid grid-cols-2 gap-2 w-full">
                            <div class="col-span-2 card w-full h-[220px] rounded-lg grid items-center content-center gap-2 justify-items-center cursor-pointer"
                                style="border-color: #096B5A" data-modal-target="authentication-modal-add-product"
                                data-modal-toggle="authentication-modal-add-product">
                                <iconify-icon icon="pepicons-pop:plus"
                                    class="menu-icon text-2xl text-[#096B5A]"></iconify-icon>
                                <div class="text-[10px] font-semibold text-[#096B5A]">
                                    Tambah produk
                                </div>
                            </div>

                            <!-- Main modal -->
                            <div id="authentication-modal-add-product" tabindex="-1" aria-hidden="true"
                                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-md max-h-full">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <!-- Modal body -->
                                        <div class="p-4 md:p-5">
                                            <form id="form-submit-menu" class="space-y-4 grid grid-cols-2 gap-1">
                                                <input type="hidden" name="uuid_umkm">
                                                <!-- Upload Image Start -->
                                                <div class="col-span-2">
                                                    <div
                                                        class="w-full h-[210px] bg-gray-300 rounded-lg flex items-center justify-center relative">
                                                        <iconify-icon icon="lucide:image" id="icon-default"
                                                            class="menu-icon icon-produk text-[120px] text-gray-500"></iconify-icon>
                                                        <div id="imagePreviewUmkm"
                                                            class="image-preview image-produk absolute inset-0 bg-cover bg-center rounded-lg hidden">
                                                        </div>
                                                        <input type="file" id="imageUploadProduct"
                                                            class="image-upload" accept=".png, .jpg, .jpeg"
                                                            name="foto" hidden>
                                                        <label for="imageUploadProduct"
                                                            class="absolute bottom-3 right-3 w-8 h-8 flex justify-center items-center bg-primary-50 dark:bg-primary-600/25 text-primary-600 dark:text-primary-400 border border-primary-600 hover:bg-primary-100 text-lg rounded-full cursor-pointer">
                                                            <iconify-icon icon="solar:camera-outline"
                                                                class="icon"></iconify-icon>
                                                        </label>
                                                    </div>
                                                </div>
                                                <!-- Upload Image End -->

                                                <!-- Nama Menu -->
                                                <div class="col-span-2">
                                                    <label for="menu"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white uppercase">
                                                        Nama menu
                                                    </label>
                                                    <input type="text" name="menu" id="menu"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                                        placeholder="Contoh: Bakso Top Super">
                                                    <div class="text-danger-600 text-sm menu_error"></div>
                                                </div>

                                                <!-- Harga -->
                                                <div class="col-span-2">
                                                    <label for="harga"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white uppercase">
                                                        Harga
                                                    </label>
                                                    <input type="text" name="harga" id="harga"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                                        placeholder="Contoh: Rp 12.000">
                                                    <div class="text-danger-600 text-sm harga_error"></div>
                                                </div>

                                                <!-- Tombol -->
                                                <div class="col-span-2 flex justify-between items-center">
                                                    <button data-modal-hide="authentication-modal-add-product"
                                                        type="reset"
                                                        class="text-[#096B5A] bg-transparent font-medium text-sm px-3 py-2.5 text-center uppercase">
                                                        Keluar
                                                    </button>
                                                    <button type="submit" id="submit-form-menu"
                                                        class="flex items-center gap-2 text-white bg-[#096B5A] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2.5 text-center uppercase">
                                                        <iconify-icon icon="material-symbols:save" class="menu-icon"
                                                            style="font-size: 20px;"></iconify-icon>
                                                        <span>Simpan</span>
                                                    </button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="card-menu-umkm" class="flex col-span-2 gap-2 w-full"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.layouts._footer')
</main>

@include('admin.partial-html._template-bottom')

<script>
    $(document).ready(function() {
        // Tombol untuk membuka modal tambah
        $('#btn-tambah').click(function() {
            $('#authentication-modal').removeClass('hidden'); // Menampilkan modal
            $('#form-submit')[0].reset(); // Reset form
            $('#form-submit').data('mode', 'add'); // Menandai form untuk tambah
            $('#submit-form').text('Simpan'); // Ganti teks tombol menjadi 'Simpan'
        });

        // Menangani submit form
        $('#form-submit').submit(function(e) {
            e.preventDefault(); // Mencegah form disubmit

            // Setup CSRF Token
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });

            var mode = $(this).data('mode'); // Cek apakah mode tambah atau edit
            let formData = new FormData($("#form-submit")[
                0]); // Gunakan FormData untuk menyertakan file upload

            if (mode === 'add') {
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.add-umkm') }}",
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
            } else if (mode === 'edit') {
                var uuid = $(this).data('uuid');
                $.ajax({
                    type: "POST",
                    url: `{{ route('admin.update-umkm', ['uuid' => 'UUID_PLACEHOLDER']) }}`
                        .replace('UUID_PLACEHOLDER',
                            uuid),
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $(".text-danger-600").html(""); // Hapus pesan error sebelumnya
                        if (response.success) {
                            Swal.fire({
                                text: "Data berhasil di Update",
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
            }
        });

        $(document).ready(function() {
            $("#harga").on("input", function() {
                let input = $(this).val();

                // Hapus semua karakter non-angka
                input = input.replace(/[^,\d]/g, "");

                // Format angka dengan pemisah ribuan
                if (input) {
                    const numberFormat = new Intl.NumberFormat("id-ID");
                    const formatted = numberFormat.format(parseInt(input.replace(/\./g, ""),
                        10));
                    $(this).val('Rp ' + formatted);
                }
            });
        });

        $(document).on("submit", "#form-submit-menu", function(e) {
            e.preventDefault(); // Mencegah form disubmit langsung

            // Setup CSRF Token
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });

            // Ambil data form
            let formData = new FormData(this);

            // AJAX Request
            $.ajax({
                type: "POST",
                url: "{{ route('admin.add-menu') }}",
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
                        });

                        // Tambahkan data baru ke DOM
                        const container = $("#card-menu-umkm");
                        const item = response.data; // Data menu baru dari response
                        const newCardHtml = `
                                                <div class="col-span-1 card w-full h-[220px] border-0 rounded-lg grid shadow-lg relative">
                                                    <button class="delete-menu p-1 bg-white rounded-full" data-uuid="${item.uuid}"
                                                            style="position: absolute; width: 30px; height: 30px; display: flex; justify-content: center; align-items: center; top: 5px; right: 5px;">
                                                        <iconify-icon icon="si:close-duotone" width="24" height="24"></iconify-icon>
                                                    </button>
                                                    <div class="w-full h-[168px] bg-gray-300 rounded-lg flex items-center justify-center">
                                                        ${
                                                            item.foto
                                                                ? `<img src="{{ asset('menu/${item.foto}') }}" alt="${item.menu}" class="w-full h-full object-cover rounded-lg" />`
                                                                : `<iconify-icon icon="lucide:image" class="menu-icon text-[100px] text-gray-500"></iconify-icon>`
                                                        }
                                                    </div>
                                                    <div class="grid px-2">
                                                        <span class="text-[14px] font-normal">${item.menu}</span>
                                                        <span class="text-[10px] font-semibold">Rp ${new Intl.NumberFormat('id-ID').format(item.harga)}</span>
                                                    </div>
                                                </div>
                                            `;
                        container.append(newCardHtml);

                        // Reset form
                        $("#form-submit-menu")[0].reset();

                        // Kosongkan input file
                        $("#form-submit-menu input[type='file']").val(null);

                        $('[data-modal-hide="authentication-modal-add-product"]').click();

                        // Reset preview gambar
                        $(".image-produk").addClass('hidden').css('background-image',
                            'none');
                        $(".icon-produk").removeClass('hidden');
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
                            value
                        ); // Tampilkan pesan error dari backend
                    });
                },
            });
        });

        // Menutup modal ketika klik tombol keluar
        $('[data-modal-hide="authentication-modal"]').click(function() {
            $('#authentication-modal').addClass('hidden');
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
                    select: [0, 2], // Nonaktifkan sorting pada kolom ke-0 dan ke-4
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
            const table = document.querySelector("#selection-table");
            if (table) {
                const rows = document.querySelectorAll("#selection-table tbody tr");

                // Ambil filter yang dipilih
                const kelurahan = document.querySelector("#kelurahan .active")?.textContent.trim().toLowerCase()
                    .replace(/\s+/g, ' ') ||
                    "semua";
                const bidangUsaha = document.querySelector("#bidang-usaha .active")?.textContent.trim()
                    .toLowerCase().replace(/\s+/g, ' ') || "semua";

                let visibleRows = 0;

                rows.forEach(row => {
                    // Ambil data dari kolom tabel
                    const kelurahanCell = row.cells[1]?.textContent.trim().toLowerCase().replace(/\s+/g,
                        ' ') || "";
                    const bidangUsahaCell = row.cells[2]?.textContent.trim().toLowerCase().replace(/\s+/g,
                        ' ') || "";

                    // Tentukan apakah baris harus ditampilkan
                    const isKelurahanVisible = kelurahan === "semua" || kelurahan === kelurahanCell;
                    const isBidangUsahaVisible = bidangUsaha === "semua" || bidangUsaha === bidangUsahaCell;

                    const isVisible = isKelurahanVisible && isBidangUsahaVisible;
                    row.style.display = isVisible ? "" : "none";

                    if (isVisible) visibleRows++;
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

        // Fungsi untuk mengatur dropdown
        const handleDropdownSelection = (dropdownItems, dropdownButton, filterFunction) => {
            dropdownItems.forEach(item => {
                item.addEventListener("click", (event) => {
                    event.preventDefault();

                    // Hilangkan class active dari semua opsi
                    dropdownItems.forEach(link => link.classList.remove("active"));

                    // Tambahkan class active pada opsi yang dipilih
                    item.classList.add("active");

                    // Perbarui teks tombol dropdown
                    dropdownButton.textContent = item.textContent.trim();

                    // Jalankan filter tabel
                    if (typeof filterFunction === "function") filterFunction();
                });
            });
        };

        // Kelurahan Dropdown
        const kelurahanDropdown = document.querySelectorAll("#kelurahan a");
        const kelurahanButton = document.querySelector("[data-dropdown-toggle='kelurahan']");
        handleDropdownSelection(kelurahanDropdown, kelurahanButton, filterTable);

        // Bidang Usaha Dropdown
        const bidangUsahaDropdown = document.querySelectorAll("#bidang-usaha a");
        const bidangUsahaButton = document.querySelector("[data-dropdown-toggle='bidang-usaha']");
        handleDropdownSelection(bidangUsahaDropdown, bidangUsahaButton, filterTable);

        // Menutup dropdown jika klik di luar area dropdown
        document.addEventListener("click", (event) => {
            const isKelurahan = kelurahanButton && kelurahanButton.contains(event.target);
            const isBidangUsaha = bidangUsahaButton && bidangUsahaButton.contains(event.target);

            if (!isKelurahan && !isBidangUsaha) {
                document.getElementById("kelurahan")?.classList.add("hidden");
                document.getElementById("bidang-usaha")?.classList.add("hidden");
            }
        });

        // Tombol Reset
        const resetButton = document.querySelector(".reset");
        resetButton.addEventListener("click", (event) => {
            event.preventDefault();

            // Reset dropdown ke default
            kelurahanButton.textContent = "Pilih Kelurahan";
            bidangUsahaButton.textContent = "Pilih Bidang Usaha";

            kelurahanDropdown.forEach(item => item.classList.remove("active"));
            bidangUsahaDropdown.forEach(item => item.classList.remove("active"));

            // Set "Semua" sebagai opsi aktif
            kelurahanDropdown[0]?.classList.add("active");
            bidangUsahaDropdown[0]?.classList.add("active");

            // Jalankan filter tabel
            filterTable();
        });
    }

    // ================== Image Upload Js Start ===========================
    // Fungsi untuk menangani pratinjau gambar
    function readURL(input) {
        if (input.files && input.files[0]) {
            const file = input.files[0];

            // Validasi jenis file (PNG, JPG, JPEG)
            const allowedTypes = ["image/png", "image/jpeg", "image/jpg"];
            if (!allowedTypes.includes(file.type)) {
                alert("Hanya file PNG, JPG, atau JPEG yang diperbolehkan.");
                input.value = ""; // Reset input jika file tidak valid
                return;
            }

            // Membaca file dan menampilkan pratinjau
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = $(input).siblings(".image-preview")[0]; // Elemen pratinjau terkait
                preview.style.backgroundImage = `url(${e.target.result})`;
                preview.style.display = "block";
                preview.classList.remove("hidden");
            };
            reader.readAsDataURL(file);
        }
    }

    // Event listener dinamis untuk elemen input
    $(document).on("change", ".image-upload", function() {
        readURL(this);
    });
    // ================== Image Upload Js End ===========================

    function cardBlock(uuid) {
        // Tampilkan elemen yang relevan
        $('#card-produk').removeClass('hidden');
        $('#card-hidden').addClass('hidden');

        $("input[name='uuid_umkm']").val(uuid)

        // Kirim permintaan AJAX ke server
        $.ajax({
            url: `{{ route('admin.detail-umkm', ['uuid' => 'UUID_PLACEHOLDER']) }}`.replace('UUID_PLACEHOLDER',
                uuid),
            method: "GET",
            success: function(res) {
                if (res.success) {
                    const preview = document.querySelector("#imageProduk");
                    const defaultIcon = document.querySelector("#defaultIcon");

                    // Update gambar jika ada
                    if (res.data.foto) {
                        preview.style.backgroundImage = `url('/umkm/${res.data.foto}')`;
                        preview.classList.remove("hidden");
                        defaultIcon.classList.add("hidden");
                    } else {
                        preview.classList.add("hidden");
                        defaultIcon.classList.remove("hidden");
                    }

                    // Update teks produk
                    $('#nama-produk').text(res.data.nama_umkm);
                    $('#alamat-produk').text(res.data.alamat);

                    // Update tombol Telepon
                    if (res.data.telepon) {
                        $('#callButton')
                            .attr('href', `tel:${res.data.telepon}`)
                            .removeClass('hidden');
                    } else {
                        $('#callButton').addClass('hidden');
                    }

                    // Update tombol Website
                    if (res.data.sosial_media) {
                        $('#websiteButton')
                            .attr('href', res.data.sosial_media)
                            .removeClass('hidden');
                    } else {
                        $('#websiteButton').addClass('hidden');
                    }

                    // Tombol untuk membuka modal edit
                    $('#btn-edit').click(function() {
                        $('#authentication-modal').removeClass('hidden'); // Menampilkan modal
                        $('#form-submit')[0].reset(); // Reset form sebelum mengisi dengan data
                        $('#form-submit').data('mode', 'edit'); // Menandai form untuk edit
                        $('#submit-form').text('Update'); // Ganti teks tombol menjadi 'Update'
                        $('#form-submit').data('uuid', res.data.uuid); // Menandai form untuk edit

                        const preview = document.querySelector("#imagePreviewUmkm");
                        const iconDefault = document.querySelector("#icon-default");

                        // Update gambar jika ada
                        if (res.data.foto) {
                            preview.style.backgroundImage = `url('/umkm/${res.data.foto}')`;
                            preview.classList.remove("hidden");
                            iconDefault.classList.add("hidden");
                        } else {
                            preview.classList.add("hidden");
                            iconDefault.classList.remove("hidden");
                        }

                        // Isi form dengan data yang akan diedit
                        $('#nama_umkm').val(res.data.nama_umkm);
                        $('#alamat').val(res.data.alamat);
                        $('#rt-modal').val(res.data.rt);
                        $('#rw-modal').val(res.data.rw);
                        $('#kelurahan-modal').val(res.data.kelurahan);
                        $('#jenis_umkm-modal').val(res.data.jenis_umkm);
                        $('#telepon').val(res.data.telepon);
                        $('#sosial_media').val(res.data.sosial_media);
                    });

                    $("#delete").click(function(e) {
                        e.preventDefault();
                        // Konfirmasi penghapusan
                        Swal.fire({
                            title: "Apakah Anda yakin?",
                            text: "Data ini akan dihapus secara permanen!",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#d33",
                            cancelButtonColor: "#3085d6",
                            confirmButtonText: "Ya, Hapus!",
                            cancelButtonText: "Batal",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Lakukan AJAX untuk delete
                                $.ajax({
                                    type: "DELETE",
                                    url: `{{ route('admin.delete-umkm', ['uuid' => 'UUID_PLACEHOLDER']) }}`
                                        .replace('UUID_PLACEHOLDER',
                                            uuid),
                                    headers: {
                                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]')
                                            .attr(
                                                "content"), // CSRF token
                                    },
                                    success: function(response) {
                                        if (response.success) {
                                            Swal.fire({
                                                text: response.message,
                                                icon: "success",
                                                showConfirmButton: false,
                                                timer: 1500,
                                            }).then(() => {
                                                location.reload();
                                            });
                                        } else {
                                            Swal.fire({
                                                title: "Gagal",
                                                text: response
                                                    .message ||
                                                    "Data gagal dihapus.",
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
                            }
                        });
                    });
                } else {
                    console.warn("Data gagal diterima. Cek response:", res);
                    alert("Gagal memuat data. Silakan coba lagi.");
                }
            },
            error: function(xhr) {
                console.error("Error saat mengambil data:", xhr.responseText || xhr.statusText);
                alert("Gagal memuat data. Silakan coba lagi.");
            }
        });

        $.ajax({
            url: `{{ route('admin.get-menu', ['uuid_umkm' => 'UUID_PLACEHOLDER']) }}`.replace(
                'UUID_PLACEHOLDER',
                uuid
            ),
            method: "GET",
            success: function(res) {
                if (res.success) {
                    const container = $("#card-menu-umkm"); // Pastikan Anda memiliki container untuk kartu
                    container.empty(); // Kosongkan container sebelum memuat data baru

                    // Render data produk lainnya
                    res.data.forEach((item) => {
                        const cardHtml = `
                                            <div class="col-span-1 card w-full h-[220px] border-0 rounded-lg grid shadow-lg relative">
                                                <button class="delete-menu p-1 bg-white rounded-full" data-uuid="${item.uuid}"
                                                        style="position: absolute; width: 30px; height: 30px; display: flex; justify-content: center; align-items: center; top: 5px; right: 5px;">
                                                    <iconify-icon icon="si:close-duotone" width="24" height="24"></iconify-icon>
                                                </button>
                                                <div class="w-full h-[168px] bg-gray-300 rounded-lg flex items-center justify-center">
                                                    ${
                                                        item.foto
                                                            ? `<img src="{{ asset('menu/${item.foto}') }}" alt="${item.menu}" class="w-full h-full object-cover rounded-lg" />`
                                                            : `<iconify-icon icon="lucide:image" class="menu-icon text-[100px] text-gray-500"></iconify-icon>`
                                                    }
                                                </div>
                                                <div class="grid px-2">
                                                    <span class="text-[14px] font-normal">${item.menu}</span>
                                                    <span class="text-[10px] font-semibold">Rp ${new Intl.NumberFormat('id-ID').format(item.harga)}</span>
                                                </div>
                                            </div>
                                        `;
                        container.append(cardHtml);
                    });
                } else {
                    console.warn("Data gagal diterima. Cek response:", res);
                    alert("Gagal memuat data. Silakan coba lagi.");
                }
            },
            error: function(xhr) {
                console.error("Error saat mengambil data:", xhr.responseText || xhr.statusText);
                alert("Gagal memuat data. Silakan coba lagi.");
            },
        });

        // Delegasi event handler untuk tombol delete
        $(document).on("click", ".delete-menu", function(e) {
            e.preventDefault();

            const uuid = $(this).data("uuid"); // Ambil UUID dari tombol

            // Konfirmasi penghapusan
            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Data ini akan dihapus secara permanen!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, Hapus!",
                cancelButtonText: "Batal",
            }).then((result) => {
                if (result.isConfirmed) {
                    // Lakukan AJAX untuk delete
                    $.ajax({
                        type: "DELETE",
                        url: `{{ route('admin.delete-menu', ['uuid' => 'UUID_PLACEHOLDER']) }}`
                            .replace(
                                "UUID_PLACEHOLDER",
                                uuid
                            ),
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"), // CSRF token
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    text: response.message,
                                    icon: "success",
                                    showConfirmButton: false,
                                    timer: 1500,
                                }).then(() => {
                                    // Refresh data setelah penghapusan berhasil
                                    $(`[data-uuid="${uuid}"]`).closest(".card")
                                        .remove();
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
                }
            });
        });

    }
</script>

</body>

</html>

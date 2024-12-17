<!-- resources/views/admin/login.blade.php -->
@section('title', $module)

@include('admin.partial-html._template-top')

@include('admin.layouts._sidebar')
<main class="dashboard-main">
    @include('admin.layouts._nav')
    <div class="dashboard-main-body">
        <div class="flex flex-wrap items-center justify-between gap-2 mb-6">
            <h6 class="font-semibold mb-0 text-[#096B5A] dark:text-white">{{ $module }}</h6>
        </div>

        <div class="grid grid-cols-3 gap-2">
            <div class="col-span-1">
                <div class="card border-0 bg-white p-2">
                    <div class="grid gap-3">
                        <div class="avatar-upload">
                            <div class="avatar-preview flex items-center justify-center"
                                style="width: 120px; height: 120px;">
                                <img src="{{ asset('/warga/' . $warga->foto) }}"
                                    class="w-[120px] h-[120px] rounded-full" alt="">
                            </div>
                        </div>
                        <div class="grid">
                            <div class="text-[10px] font-semibold uppercase">Pin</div>
                            <div class="text-base font-normal">{{ $warga->resrtribusi }}</div>
                        </div>
                        <div class="grid">
                            <div class="text-[10px] font-semibold uppercase">Nama</div>
                            <div class="text-base font-normal">{{ $warga->nama }}</div>
                        </div>
                        <div class="grid">
                            <div class="text-[10px] font-semibold uppercase">NPRW</div>
                            <div class="text-base font-normal">{{ $warga->nprw }}</div>
                        </div>
                        <div class="grid">
                            <div class="text-[10px] font-semibold uppercase">Alamat</div>
                            <div class="text-base font-normal">{{ $warga->alamat }}</div>
                        </div>
                        <div class="grid grid-cols-2 gap-2">
                            <div class="grid col-span-1">
                                <div class="text-[10px] font-semibold uppercase">Rt</div>
                                <div class="text-base font-normal">{{ $warga->rt }}</div>
                            </div>
                            <div class="grid col-span-1">
                                <div class="text-[10px] font-semibold uppercase">Rw</div>
                                <div class="text-base font-normal">{{ $warga->rw }}</div>
                            </div>
                        </div>
                        <div class="grid">
                            <div class="text-[10px] font-semibold uppercase">Kelurahan</div>
                            <div class="text-base font-normal">{{ $warga->kelurahan }}</div>
                        </div>
                        <div class="grid">
                            <div class="text-[10px] font-semibold uppercase">kategori</div>
                            <div class="text-base font-normal">{{ $warga->jenis_sampah }}</div>
                        </div>
                        <div class="grid">
                            <div class="text-[10px] font-semibold uppercase">sub kategori</div>
                            <div class="text-base font-normal">{{ $warga->sub_kategori }}</div>
                        </div>
                        <div class="grid grid-cols-2 gap-2">
                            <div class="grid col-span-1">
                                <div class="text-[10px] font-semibold uppercase">volume</div>
                                <div class="text-base font-normal">{{ $warga->volume }}</div>
                            </div>
                            <div class="grid col-span-1">
                                <div class="text-[10px] font-semibold uppercase">tarif</div>
                                <div class="text-base font-normal">Rp {{ number_format($warga->tarif, 0, ',', '.') }}
                                </div>
                            </div>
                        </div>
                        <button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal"
                            type="button"
                            class="flex items-center justify-center gap-2 hover:bg-emerald-300 btn bg-transparent border border-[#096B5A] p-2">
                            <iconify-icon icon="solar:pen-bold"
                                class="menu-icon text-[12px] text-[#096B5A]"></iconify-icon>
                            <span class="text-[10px] font-semibold text-[#096B5A]">EDIT</span>
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
                                                        <div id="imagePreview"
                                                            style="background-image: url({{ asset('/warga/' . $warga->foto) }})">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Upload Image End -->
                                            <div class="col-span-2">
                                                <label for="nama"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white uppercase">
                                                    nama</label>
                                                <input type="text" name="nama" id="nama"
                                                    value="{{ $warga->nama }}"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                                    placeholder="Masukkan Nama" />
                                                <div class="text-danger-600 text-sm nama_error">
                                                </div>
                                            </div>
                                            <div class="col-span-2">
                                                <label for="nprw"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white uppercase">
                                                    nprw</label>
                                                <input type="text" name="nprw" id="nprw"
                                                    value="{{ $warga->nprw }}"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                                    placeholder="xx.x.x.x.x-xxx" />
                                                <div class="text-danger-600 text-sm nprw_error">
                                                </div>
                                            </div>
                                            <div class="col-span-2">
                                                <label for="alamat"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white uppercase">
                                                    alamat</label>
                                                <input type="text" name="alamat" id="alamat"
                                                    value="{{ $warga->alamat }}"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                                    placeholder="Masukkan Alamat" />
                                                <div class="text-danger-600 text-sm alamat_error">
                                                </div>
                                            </div>
                                            <div class="col-span-1">
                                                <label for="rt-modal"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white uppercase">rt</label>
                                                <input type="number" name="rt" id="rt-modal"
                                                    value="{{ $warga->rt }}"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    placeholder="000">
                                                <div class="text-danger-600 text-sm rt_error">
                                                </div>
                                            </div>
                                            <div class="col-span-1">
                                                <label for="rw-modal"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white uppercase">rw</label>
                                                <input type="number" name="rw" id="rw-modal"
                                                    value="{{ $warga->rw }}"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    placeholder="000">
                                                <div class="text-danger-600 text-sm rw_error">
                                                </div>
                                            </div>
                                            <div class="col-span-2">
                                                <label for="kelurahan-modal"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white uppercase">kelurahan</label>
                                                <select id="kelurahan-modal" name="kelurahan"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                    <option value="Bara-Baraya"
                                                        {{ $warga->kelurahan == 'Bara-Baraya' ? 'selected' : '' }}>
                                                        Bara-Baraya</option>
                                                    <option value="Bara-Baraya Timur"
                                                        {{ $warga->kelurahan == 'Bara-Baraya Timur' ? 'selected' : '' }}>
                                                        Bara-Baraya Timur</option>
                                                    <option value="Bara-Baraya Selatan"
                                                        {{ $warga->kelurahan == 'Bara-Baraya Selatan' ? 'selected' : '' }}>
                                                        Bara-Baraya Selatan</option>
                                                    <option value="Bara-Baraya Utara"
                                                        {{ $warga->kelurahan == 'Bara-Baraya Utara' ? 'selected' : '' }}>
                                                        Bara-Baraya Utara</option>
                                                    <option value="Barana"
                                                        {{ $warga->kelurahan == 'Barana' ? 'selected' : '' }}>Barana
                                                    </option>
                                                    <option value="Lariang Bangi"
                                                        {{ $warga->kelurahan == 'Lariang Bangi' ? 'selected' : '' }}>
                                                        Lariang Bangi</option>
                                                    <option value="Maccini"
                                                        {{ $warga->kelurahan == 'Maccini' ? 'selected' : '' }}>Maccini
                                                    </option>
                                                    <option value="Maccini Gusung"
                                                        {{ $warga->kelurahan == 'Maccini Gusung' ? 'selected' : '' }}>
                                                        Maccini Gusung</option>
                                                    <option value="Maccini Parang"
                                                        {{ $warga->kelurahan == 'Maccini Parang' ? 'selected' : '' }}>
                                                        Maccini Parang</option>
                                                    <option value="Maradekaya"
                                                        {{ $warga->kelurahan == 'Maradekaya' ? 'selected' : '' }}>
                                                        Maradekaya</option>
                                                    <option value="Maradekaya Selatan"
                                                        {{ $warga->kelurahan == 'Maradekaya Selatan' ? 'selected' : '' }}>
                                                        Maradekaya Selatan</option>
                                                    <option value="Maredakaya Utara"
                                                        {{ $warga->kelurahan == 'Maredakaya Utara' ? 'selected' : '' }}>
                                                        Maredakaya Utara</option>
                                                    <option value="Maricaya"
                                                        {{ $warga->kelurahan == 'Maricaya' ? 'selected' : '' }}>
                                                        Maricaya</option>
                                                    <option value="Maricaya Bar"
                                                        {{ $warga->kelurahan == 'Maricaya Bar' ? 'selected' : '' }}>
                                                        Maricaya Bar</option>
                                                </select>
                                                <div class="text-danger-600 text-sm kelurahan_error">
                                                </div>
                                            </div>
                                            <div class="col-span-2">
                                                <label for="jenis_sampah-modal"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white uppercase">jenis
                                                    sampah</label>
                                                <select id="jenis_sampah-modal" name="jenis_sampah"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                    <option value="Komersial"
                                                        {{ $warga->jenis_sampah == 'Komersial' ? 'selected' : '' }}>
                                                        Komersial</option>
                                                    <option value="Rumah Tangga"
                                                        {{ $warga->jenis_sampah == 'Rumah Tangga' ? 'selected' : '' }}>
                                                        Rumah Tangga</option>
                                                    <option value="Sekolah / Kampus"
                                                        {{ $warga->jenis_sampah == 'Sekolah / Kampus' ? 'selected' : '' }}>
                                                        Sekolah / Kampus</option>
                                                </select>
                                                <div class="text-danger-600 text-sm jenis_sampah_error">
                                                </div>
                                            </div>
                                            <div class="col-span-2">
                                                <label for="sub_kategori"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white uppercase">
                                                    sub kategori</label>
                                                <input type="text" name="sub_kategori" id="sub_kategori"
                                                    value="{{ $warga->sub_kategori }}"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                                    placeholder="Masukkan Alamat" />
                                                <div class="text-danger-600 text-sm sub_kategori_error">
                                                </div>
                                            </div>
                                            <div class="col-span-1">
                                                <label for="volume"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white uppercase">
                                                    volume</label>
                                                <input type="text" name="volume" id="volume"
                                                    value="{{ $warga->volume }}"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                                    placeholder="Masukkan Alamat" />
                                                <div class="text-danger-600 text-sm volume_error">
                                                </div>
                                            </div>
                                            <div class="col-span-1">
                                                <label for="tarif"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white uppercase">
                                                    tarif</label>
                                                <input type="text" name="tarif" id="tarif"
                                                    value="{{ $warga->tarif }}"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                                    placeholder="Masukkan Alamat" />
                                                <div class="text-danger-600 text-sm tarif_error">
                                                </div>
                                            </div>

                                            <div class="col-span-2 flex justify-between">
                                                <button type="button" id="delete"
                                                    class="flex items-center gap-2 text-[#BA1A1A] bg-[#FFDAD6] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2.5 text-center uppercase">
                                                    <iconify-icon icon="mdi:trash" class="menu-icon"
                                                        style="font-size: 20px;"></iconify-icon>
                                                    <span>Hapus</span>
                                                </button>
                                                <div class="flex gap-2">
                                                    <button data-modal-hide="authentication-modal" type="reset"
                                                        class="text-[#096B5A] bg-transparent font-medium text-sm px-3 py-2.5 text-center uppercase">
                                                        batalkan
                                                    </button>
                                                    <button type="submit" id="submit-form"
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
                    </div>
                </div>
            </div>
            <div class="col-span-1">
                <div class="card border-0 bg-white p-2">
                    <div class="card-header px-0 py-2">
                        <h6 class="text-[#096B5A] text-base font-medium mb-0">Daftar Tagihan</h6>
                    </div>
                    <div class="card-body px-0 py-2 grid gap-2">
                        @forelse ($tagihan as $item_tagihan)
                            <div class="grid grid-cols-3 items-center border-b cursor-pointer"
                                data-modal-target="authentication-modal-tagihan{{ $item_tagihan->uuid }}"
                                data-modal-toggle="authentication-modal-tagihan{{ $item_tagihan->uuid }}">
                                <div class="grid col-span-2">
                                    <h6 class="text-[14px] mb-0 font-normal">{{ $item_tagihan->nama }}</h6>
                                    <span
                                        class="text-[10px] font-semibold">{{ $item_tagihan->no_tagihan . '-' . $item_tagihan->nprw }}</span>
                                </div>
                                <div class="col-span-1">
                                    <div
                                        class="py-1 px-4 {{ $item_tagihan->status == 'Lunas' ? 'bg-[#BFF0B1] text-[#3E6837]' : 'bg-[#FFDAD6] text-[#BA1A1A]' }} text-[10px] rounded-xl text-center">
                                        {{ $item_tagihan->status == 'Lunas' ? 'LUNAS' : 'BELUM LUNAS' }}
                                    </div>
                                </div>
                            </div>

                            <!-- Main modal -->
                            <div id="authentication-modal-tagihan{{ $item_tagihan->uuid }}" tabindex="-1"
                                aria-hidden="true"
                                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-md max-h-full">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <!-- Modal body -->
                                        <div class="p-4 md:p-5 grid gap-4">
                                            <div class="flex items-center justify-start">
                                                <div class="flex gap-2 items-center">
                                                    <div
                                                        class="h-6 w-6 {{ $item_tagihan->status == 'Lunas' ? 'bg-[#BFF0B1]' : 'bg-[#FFDAD6]' }} flex items-center justify-center rounded-full">
                                                        <iconify-icon
                                                            icon="{{ $item_tagihan->status == 'Lunas' ? 'tabler:check' : 'line-md:remove' }}"
                                                            class="menu-icon text-[10px] text-[#3E6837]"></iconify-icon>
                                                    </div>
                                                    <span
                                                        class="text-[10px] text-[#3E6837] font-semibold uppercase">{{ $item_tagihan->status == 'Lunas' ? 'LUNAS' : 'BELUM LUNAS' }}</span>
                                                </div>
                                            </div>
                                            <div class="grid">
                                                <div class="text-[10px] font-semibold uppercase">no. tagihan</div>
                                                <div class="text-base font-normal">
                                                    {{ $item_tagihan->no_tagihan . '-' . $item_tagihan->nprw }}</div>
                                            </div>
                                            <div class="grid">
                                                <div class="text-[10px] font-semibold uppercase">diterbitkan</div>
                                                <div class="text-base font-normal">
                                                    {{ \Carbon\Carbon::createFromFormat('Y m d', $item_tagihan->tanggal_tagihan)->formatLocalized('%e %B %Y') }}
                                                </div>
                                            </div>
                                            <div class="grid">
                                                <div class="text-[10px] font-semibold uppercase">ditagihkan ke</div>
                                                <div class="text-base font-normal">{{ $item_tagihan->nama }}</div>
                                                <div class="text-base font-normal">{{ $item_tagihan->nprw }}</div>
                                            </div>
                                            <div class="grid">
                                                <div class="text-[10px] font-semibold uppercase">retribusi</div>
                                                <div class="text-base font-normal">
                                                    {{ \Carbon\Carbon::createFromFormat('Y m d', $item_tagihan->tanggal_tagihan)->formatLocalized('%B %Y') }}
                                                </div>
                                            </div>
                                            <div class="grid">
                                                <div class="text-[10px] font-semibold uppercase">Detail retribusi</div>
                                                <div class="flex justify-between">
                                                    <div class="text-base font-normal">Volume</div>
                                                    <div class="text-base font-normal text-[#096B5A]">
                                                        {{ $item_tagihan->vlome }}</div>
                                                </div>
                                                <div class="flex justify-between border-b-2">
                                                    <div class="text-base font-normal">Tarif</div>
                                                    <div class="text-base font-normal text-[#096B5A]">Rp
                                                        {{ number_format($item_tagihan->tarif, 0, ',', '.') }}</div>
                                                </div>
                                                <div class="flex justify-between">
                                                    <div class="text-base font-bold">Jumlah Retribusi</div>
                                                    <div class="text-base font-bold text-[#096B5A]">Rp
                                                        {{ number_format($item_tagihan->tarif, 0, ',', '.') }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-2 text-lg font-bold text-center text-slate-400 w-full">Belum ada
                                Tagihan</div>
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="col-span-1">
                <div class="card border-0 bg-white p-2">
                    <div class="card-header px-0 py-2">
                        <h6 class="text-[#096B5A] text-base font-medium mb-0">Daftar Transaksi</h6>
                    </div>
                    <div class="card-body px-0 py-2 grid gap-2">
                        @forelse ($transaksi as $item_transaksi)
                            <div class="flex justify-between items-center pb-1 border-b cursor-pointer"
                                data-modal-target="authentication-modal-transaksi{{ $item_transaksi->uuid }}"
                                data-modal-toggle="authentication-modal-transaksi{{ $item_transaksi->uuid }}">
                                <div class="grid col-span-1 gap-1">
                                    <h6 class="text-[14px] mb-0 font-normal">{{ $item_transaksi->nama }}</h6>
                                    <div class="grid grid-cols-3 items-center gap-1">
                                        @foreach ($item_transaksi->bulan_tagihan as $bulan)
                                            <div
                                                class="col-span-1 p-1 py-0 text-center rounded-2xl border border-[#096B5A] text-[#096B5A] text-xs font-bold">
                                                {{ $bulan ? \Carbon\Carbon::createFromFormat('Y m d', $bulan)->format('M y') : '-' }}
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex gap-2 items-center">
                                        <span
                                            class="text-[10px] {{ $item_transaksi->status == 'Lunas' ? 'text-[#3E6837]' : 'text-[#BA1A1A]' }} font-semibold">Rp
                                            {{ number_format($item_transaksi->terbayarkan, 0, ',', '.') }}</span>
                                        <div
                                            class="h-6 w-6 {{ $item_transaksi->status == 'Lunas' ? 'bg-[#BFF0B1]' : 'bg-[#FFDAD6]' }} flex items-center justify-center rounded-full">
                                            <iconify-icon
                                                icon="{{ $item_transaksi->status == 'Lunas' ? 'tabler:check' : 'line-md:remove' }}"
                                                class="menu-icon text-[10px] {{ $item_transaksi->status == 'Lunas' ? 'text-[#3E6837]' : 'text-[#BA1A1A]' }}"></iconify-icon>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Main modal -->
                            <div id="authentication-modal-transaksi{{ $item_transaksi->uuid }}" tabindex="-1"
                                aria-hidden="true"
                                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-md max-h-full">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <!-- Modal body -->
                                        <div class="p-4 md:p-5 grid gap-4">
                                            <div class="flex items-center justify-between">
                                                <div class="flex gap-2 items-center">
                                                    <div
                                                        class="h-6 w-6 {{ $item_transaksi->status == 'Lunas' ? 'bg-[#BFF0B1]' : 'bg-[#FFDAD6]' }} flex items-center justify-center rounded-full">
                                                        <iconify-icon
                                                            icon="{{ $item_transaksi->status == 'Lunas' ? 'tabler:check' : 'line-md:remove' }}"
                                                            class="menu-icon text-[10px] {{ $item_transaksi->status == 'Lunas' ? 'text-[#3E6837]' : 'text-[#BA1A1A]' }}"></iconify-icon>
                                                    </div>
                                                    <span
                                                        class="text-[10px] {{ $item_transaksi->status == 'Lunas' ? 'text-[#3E6837]' : 'text-[#BA1A1A]' }} font-semibold uppercase">{{ $item_transaksi->status == 'Lunas' ? 'Pembayaran Berhasil' : 'Transaksi Gagal' }}</span>
                                                </div>
                                            </div>
                                            <div class="grid">
                                                <div class="text-[10px] font-semibold uppercase">no. transaksi</div>
                                                <div class="text-base font-normal">
                                                    {{ $item_transaksi->no_transaksi . '-' . $item_transaksi->nprw }}
                                                </div>
                                            </div>
                                            <div class="grid">
                                                <div class="text-[10px] font-semibold uppercase">dibayarkan ke</div>
                                                <div class="text-base font-normal">Kecamatan Makassar</div>
                                            </div>
                                            <div class="grid">
                                                <div class="text-[10px] font-semibold uppercase">ID PELANGGAN / NPWR
                                                </div>
                                                <div class="text-base font-normal">{{ $item_transaksi->nama }}</div>
                                                <div class="text-base font-normal">{{ $item_transaksi->nprw }}</div>
                                            </div>
                                            <div class="grid">
                                                <div class="text-[10px] font-semibold uppercase">ALAMAT</div>
                                                <div class="text-base font-normal">{{ $item_transaksi->alamat }}
                                                </div>
                                                <div class="text-base font-normal">RT {{ $item_transaksi->rt }} / RW
                                                    {{ $item_transaksi->rw }}</div>
                                                <div class="text-base font-normal">Kelurahan
                                                    {{ $item_transaksi->kelurahan }}</div>
                                                <div class="text-base font-normal">Kecamatan Makassar</div>
                                            </div>
                                            <div class="grid">
                                                <div class="text-[10px] font-semibold uppercase">tagihan dibayarkan
                                                </div>
                                                <div class="p-2">
                                                    @foreach ($item_transaksi->bulan_tagihan as $bulan)
                                                        <div class="flex justify-between border-b-2 pb-1">
                                                            <div class="text-base font-normal">
                                                                {{ \Carbon\Carbon::createFromFormat('Y m d', $bulan)->formatLocalized('%B %Y') }}
                                                            </div>
                                                            <div
                                                                class="text-base font-normal {{ $item_transaksi->status == 'Lunas' ? 'text-[#3E6837]' : 'text-[#BA1A1A]' }}">
                                                                Rp
                                                                {{ number_format($item_transaksi->tarif, 0, ',', '.') }}
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    <div class="flex justify-between">
                                                        <div class="text-base font-bold">Total Retribusi</div>
                                                        <div
                                                            class="text-base font-bold {{ $item_transaksi->status == 'Lunas' ? 'text-[#3E6837]' : 'text-[#BA1A1A]' }}">
                                                            Rp
                                                            {{ number_format($item_transaksi->terbayarkan, 0, ',', '.') }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-2 text-lg font-bold text-center text-slate-400 w-full">Belum ada
                                Transaksi</div>
                        @endforelse
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
        // Setup CSRF Token
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        const nprwInput = $("#nprw");
        const nprwError = $(".nprw_error");

        // Tambahkan format NPRW otomatis saat mengetik
        nprwInput.on("input", function() {
            let value = nprwInput.val().replace(/[^0-9A-Za-z]/g, ""); // Hanya angka dan huruf
            let formatted = "";

            // Buat format: xx.X.x.x.x-xxx
            if (value.length > 0) formatted += value.substring(0, 2); // Dua angka pertama
            if (value.length > 2) formatted += "." + value.substring(2, 3)
                .toUpperCase(); // Huruf ketiga
            if (value.length > 3) formatted += "." + value.substring(3, 4); // Angka keempat
            if (value.length > 4) formatted += "." + value.substring(4, 5); // Angka kelima
            if (value.length > 5) formatted += "." + value.substring(5, 6); // Angka keenam
            if (value.length > 6) formatted += "-" + value.substring(6, 9); // Tiga angka terakhir

            nprwInput.val(formatted); // Set nilai input dengan format yang sesuai
        });

        // Submit Form
        $("#submit-form").click(function(e) {
            e.preventDefault(); // Mencegah reload halaman

            const nprwValue = nprwInput.val().trim();
            const nprwRegex = /^\d{2}\.[A-Z]\.\d\.\d\.\d-\d{3}$/; // Format xx.X.x.x.x-xxx

            // Gunakan FormData untuk menyertakan file upload
            let formData = new FormData($("#form-submit")[0]);

            $.ajax({
                type: "POST",
                url: "{{ route('admin.update-warga', ['uuid' => $warga->uuid]) }}",
                data: formData,
                processData: false, // Jangan proses data karena menggunakan FormData
                contentType: false, // Jangan tetapkan content type, FormData akan menanganinya
                success: function(response) {
                    $(".text-danger-600").html(""); // Hapus pesan error sebelumnya
                    if (response.success) {
                        Swal.fire({
                            text: response.message,
                            icon: "success",
                            showConfirmButton: false,
                            timer: 1500,
                        }).then(() => {
                            location.reload(); // Reload halaman setelah alert
                        });
                    } else {
                        Swal.fire({
                            title: "Peringatan",
                            text: response.message || "Terjadi kesalahan.",
                            icon: "warning",
                            showConfirmButton: true,
                        });
                    }
                },
                error: function(xhr) {
                    $(".text-danger-600").html(""); // Hapus pesan error sebelumnya
                    if (xhr.responseJSON?.errors) {
                        $.each(xhr.responseJSON.errors, function(key, value) {
                            $(`.${key}_error`).html(
                                value); // Tampilkan pesan error dari backend
                        });
                    } else {
                        Swal.fire({
                            title: "Kesalahan",
                            text: "Terjadi kesalahan saat mengirim data.",
                            icon: "error",
                            showConfirmButton: true,
                        });
                    }
                },
            });
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
                        url: "{{ route('admin.delete-warga', ['uuid' => $warga->uuid]) }}",
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
                                    window.location.href =
                                        "{{ route('admin.warga') }}";
                                });
                            } else {
                                Swal.fire({
                                    title: "Gagal",
                                    text: response.message ||
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
    });

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
</script>

</body>

</html>

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
                                @if ($user->foto)
                                    <img src="{{ asset('user/' . $user->foto) }}" class="rounded-full"
                                        style="width: 120px; height: 120px;" alt="">
                                @else
                                    <img src="{{ asset('/assets/images/user-grid/user-grid-img13.png') }}"
                                        alt="">
                                @endif
                            </div>
                        </div>
                        <div class="grid">
                            <div class="text-[10px] font-semibold uppercase">Nama Admin</div>
                            <div class="text-base font-normal">{{ $user->name }}</div>
                        </div>
                        <div class="grid">
                            <div class="text-[10px] font-semibold uppercase">Role</div>
                            <div class="text-base font-normal">{{ $user->role }}</div>
                        </div>
                        <div class="grid">
                            <div class="text-[10px] font-semibold uppercase">kelurahan</div>
                            <div class="text-base font-normal">{{ $user->kelurahan ? $user->kelurahan : '-' }}</div>
                        </div>
                        <div class="grid grid-cols-2 gap-1">
                            <div class="col-span-1">
                                <div class="text-[10px] font-semibold uppercase">rt</div>
                                <div class="text-base font-normal">{{ $user->rt ? $user->rt : '-' }}</div>
                            </div>
                            <div class="col-span-1">
                                <div class="text-[10px] font-semibold uppercase">rw</div>
                                <div class="text-base font-normal">{{ $user->rw ? $user->rw : '-' }}</div>
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
                                                            style="background-image: url({{ $user->foto ? asset('user/' . $user->foto) : '/assets/images/user-grid/user-grid-img13.png' }})">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Upload Image End -->
                                            <div class="col-span-2">
                                                <label for="name"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white uppercase">
                                                    nama</label>
                                                <input type="text" name="name" id="name"
                                                    value="{{ $user->name }}"
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
                                                    value="{{ $user->username }}"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                                    placeholder="Masukkan Username" />
                                                <div class="text-danger-600 text-sm username_error">
                                                </div>
                                            </div>
                                            <div class="col-span-2">
                                                <label for="password-lama"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white uppercase">
                                                    Password Lama
                                                </label>
                                                <div class="relative">
                                                    <input type="password" name="password_lama" id="password-lama"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                                        placeholder="Password Lama">
                                                    <span
                                                        class="toggle-password ri-eye-line cursor-pointer absolute end-0 top-1/2 -translate-y-1/2 me-4 text-secondary-light"
                                                        data-toggle="#password-lama"></span>
                                                </div>
                                                <div class="text-danger-600 text-sm password_error"></div>
                                            </div>
                                            <div class="col-span-2">
                                                <label for="password-baru"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white uppercase">
                                                    Password Baru
                                                </label>
                                                <div class="relative">
                                                    <input type="password" name="password" id="password-baru"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                                        placeholder="Password Baru">
                                                    <span
                                                        class="toggle-password ri-eye-line cursor-pointer absolute end-0 top-1/2 -translate-y-1/2 me-4 text-secondary-light"
                                                        data-toggle="#password-baru"></span>
                                                </div>
                                                <div class="text-danger-600 text-sm password_error"></div>
                                            </div>
                                            <div class="col-span-2">
                                                <label class="block text-sm font-medium text-gray-700">ROLE</label>
                                                <div id="role-options"
                                                    class="flex items-center justify-between space-x-4 mt-2">
                                                    <div class="flex gap-2 items-center">
                                                        <input type="radio" id="admin" name="role"
                                                            value="admin"
                                                            {{ $user->role == 'admin' ? 'checked' : '' }}
                                                            class="peer">
                                                        <label for="admin"
                                                            class="cursor-pointer text-gray-600 peer-checked:text-[#096B5A]">
                                                            Admin
                                                        </label>
                                                    </div>
                                                    <div class="flex gap-2 items-center">
                                                        <input type="radio" id="monitoring" name="role"
                                                            value="monitoring"
                                                            {{ $user->role == 'monitoring' ? 'checked' : '' }}
                                                            class="peer">
                                                        <label for="monitoring"
                                                            class="cursor-pointer text-gray-600 peer-checked:text-[#096B5A]">
                                                            Monitoring
                                                        </label>
                                                    </div>
                                                    <div class="flex gap-2 items-center">
                                                        <input type="radio" id="kolektor" name="role"
                                                            value="kolektor"
                                                            {{ $user->role == 'kolektor' ? 'checked' : '' }}
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
                                            <div id="additional-fields"
                                                class="{{ $user->role == 'kolektor' ? '' : 'hidden' }} grid col-span-2 gap-5 w-full">
                                                <div class="col-span-2">
                                                    <label for="kelurahan-modal"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white uppercase">kelurahan</label>
                                                    <select id="kelurahan-modal" name="kelurahan"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                        <option value="Bara-Baraya"
                                                            {{ $user->kelurahan == 'Bara-Baraya' ? 'selected' : '' }}>
                                                            Bara-Baraya</option>
                                                        <option value="Bara-Baraya Timur"
                                                            {{ $user->kelurahan == 'Bara-Baraya Timur' ? 'selected' : '' }}>
                                                            Bara-Baraya Timur</option>
                                                        <option value="Bara-Baraya Selatan"
                                                            {{ $user->kelurahan == 'Bara-Baraya Selatan' ? 'selected' : '' }}>
                                                            Bara-Baraya Selatan</option>
                                                        <option value="Bara-Baraya Utara"
                                                            {{ $user->kelurahan == 'Bara-Baraya Utara' ? 'selected' : '' }}>
                                                            Bara-Baraya Utara</option>
                                                        <option value="Barana"
                                                            {{ $user->kelurahan == 'Barana' ? 'selected' : '' }}>Barana
                                                        </option>
                                                        <option value="Lariang Bangi"
                                                            {{ $user->kelurahan == 'Lariang Bangi' ? 'selected' : '' }}>
                                                            Lariang Bangi</option>
                                                        <option value="Maccini"
                                                            {{ $user->kelurahan == 'Maccini' ? 'selected' : '' }}>
                                                            Maccini
                                                        </option>
                                                        <option value="Maccini Gusung"
                                                            {{ $user->kelurahan == 'Maccini Gusung' ? 'selected' : '' }}>
                                                            Maccini Gusung</option>
                                                        <option value="Maccini Parang"
                                                            {{ $user->kelurahan == 'Maccini Parang' ? 'selected' : '' }}>
                                                            Maccini Parang</option>
                                                        <option value="Maradekaya"
                                                            {{ $user->kelurahan == 'Maradekaya' ? 'selected' : '' }}>
                                                            Maradekaya</option>
                                                        <option value="Maradekaya Selatan"
                                                            {{ $user->kelurahan == 'Maradekaya Selatan' ? 'selected' : '' }}>
                                                            Maradekaya Selatan</option>
                                                        <option value="Maredakaya Utara"
                                                            {{ $user->kelurahan == 'Maredakaya Utara' ? 'selected' : '' }}>
                                                            Maredakaya Utara</option>
                                                        <option value="Maricaya"
                                                            {{ $user->kelurahan == 'Maricaya' ? 'selected' : '' }}>
                                                            Maricaya</option>
                                                        <option value="Maricaya Bar"
                                                            {{ $user->kelurahan == 'Maricaya Bar' ? 'selected' : '' }}>
                                                            Maricaya Bar</option>
                                                    </select>
                                                    <div class="text-danger-600 text-sm kelurahan_error">
                                                    </div>
                                                </div>
                                                <div class="flex col-span-2 gap-1 w-full">
                                                    <div class="col-span-1 w-full">
                                                        <label for="rt-modal"
                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white uppercase">rt</label>
                                                        <input type="number" name="rt" id="rt-modal"
                                                            value="{{ $user->rt }}"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                            placeholder="000">
                                                        <div class="text-danger-600 text-sm rt_error">
                                                        </div>
                                                    </div>
                                                    <div class="col-span-1 w-full">
                                                        <label for="rw-modal"
                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white uppercase">rw</label>
                                                        <input type="number" name="rw" id="rw-modal"
                                                            value="{{ $user->rw }}"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                            placeholder="000">
                                                        <div class="text-danger-600 text-sm rw_error">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div
                                                class="col-span-2 flex {{ $user->role == 'kolektor' ? 'justify-between' : 'justify-end' }}">
                                                @if ($user->role == 'kolektor')
                                                    <button type="button" id="delete"
                                                        class="flex items-center gap-2 text-[#BA1A1A] bg-[#FFDAD6] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2.5 text-center uppercase">
                                                        <iconify-icon icon="mdi:trash" class="menu-icon"
                                                            style="font-size: 20px;"></iconify-icon>
                                                        <span>Hapus</span>
                                                    </button>
                                                @endif
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
            @if ($user->role == 'kolektor')
                <div class="col-span-1">
                    <div class="card border-0 bg-white p-2">
                        <div class="card-header px-0 py-2">
                            <h6 class="text-[#096B5A] text-base font-medium mb-0">Daftar Transaksi</h6>
                        </div>
                        <div class="card-body px-0 py-2 grid gap-2">
                            @foreach ($transaksi as $item_transaksi)
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
                                                    <div class="text-[10px] font-semibold uppercase">no. transaksi
                                                    </div>
                                                    <div class="text-base font-normal">
                                                        {{ $item_transaksi->no_transaksi . '-' . $item_transaksi->nprw }}
                                                    </div>
                                                </div>
                                                <div class="grid">
                                                    <div class="text-[10px] font-semibold uppercase">dibayarkan ke
                                                    </div>
                                                    <div class="text-base font-normal">Kecamatan Makassar</div>
                                                </div>
                                                <div class="grid">
                                                    <div class="text-[10px] font-semibold uppercase">ID PELANGGAN /
                                                        NPWR
                                                    </div>
                                                    <div class="text-base font-normal">{{ $item_transaksi->nama }}
                                                    </div>
                                                    <div class="text-base font-normal">{{ $item_transaksi->nprw }}
                                                    </div>
                                                </div>
                                                <div class="grid">
                                                    <div class="text-[10px] font-semibold uppercase">ALAMAT</div>
                                                    <div class="text-base font-normal">{{ $item_transaksi->alamat }}
                                                    </div>
                                                    <div class="text-base font-normal">RT {{ $item_transaksi->rt }} /
                                                        RW
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
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
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

        // Menampilkan/menghilangkan fields tambahan jika role default saat page load
        const selectedRole = $('input[name="role"]:checked').val();
        if (selectedRole === 'kolektor') {
            $('#additional-fields').removeClass('hidden');
        } else {
            $('#additional-fields').addClass('hidden');
        }

        // Setup CSRF Token
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $("#submit-form").click(function(e) {
            e.preventDefault(); // Mencegah reload halaman

            // Gunakan FormData untuk menyertakan file upload
            let formData = new FormData($("#form-submit")[0]);

            $.ajax({
                type: "POST",
                url: "{{ route('admin.update-user', ['uuid' => $user->uuid]) }}",
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
                            text: response.data || "Terjadi kesalahan.",
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
                        url: "{{ route('admin.delete-user', ['uuid' => $user->uuid]) }}",
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
                                        "{{ route('admin.user') }}";
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

    $(document).ready(function() {
        // Event listener untuk toggle password visibility
        $(".toggle-password").on("click", function() {
            const inputSelector = $(this).attr(
                "data-toggle"); // Ambil selector input dari atribut data-toggle
            const $input = $(inputSelector); // Select input yang terkait
            const $icon = $(this); // Select ikon toggle

            if ($input.attr("type") === "password") {
                // Ubah tipe input menjadi text
                $input.attr("type", "text");
                $icon.removeClass("ri-eye-line").addClass("ri-eye-off-line"); // Ubah ikon ke eye-off
            } else {
                // Ubah tipe input menjadi password
                $input.attr("type", "password");
                $icon.removeClass("ri-eye-off-line").addClass("ri-eye-line"); // Ubah ikon ke eye
            }
        });
    });
</script>

</body>

</html>

<div class="navbar-header border-b border-neutral-200 dark:border-neutral-600">
    <div class="flex items-center justify-between">
        <div class="col-auto">
            <div class="flex flex-wrap items-center gap-[16px]">
                <button type="button" class="sidebar-toggle">
                    <iconify-icon icon="tabler:arrow-bar-left" class="icon non-active"></iconify-icon>
                    <iconify-icon icon="tabler:arrow-bar-right" class="icon active"></iconify-icon>
                </button>
                <button type="button" class="sidebar-mobile-toggle">
                    <iconify-icon icon="heroicons:bars-3-solid" class="icon"></iconify-icon>
                </button>
                <div class="relative">
                    <form class="navbar-search" method="GET" action="{{ route('admin.search') }}">
                        <input type="text" name="search" id="searchInput" autocomplete="off"
                            placeholder="Cari Warga, NPRW, No. Tagihan, No. Transaksi" onkeyup="searchData()"
                            class="w-full px-4 py-2 border border-gray-600 rounded-md bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-400">
                        <iconify-icon icon="ion:search-outline" class="icon"></iconify-icon>
                    </form>

                    <div id="searchResults"
                        class="grid gap-2 mt-4 bg-white p-4 rounded-md hidden absolute w-full shadow-lg">
                        <!-- Hasil pencarian akan tampil di sini -->
                    </div>
                </div>

                <script>
                    function searchData() {
                        let query = document.getElementById('searchInput').value;

                        if (query.length > 2) {
                            // Kirim permintaan AJAX ke server
                            fetch(`/admin/search?warga=${query}`)
                                .then(response => response.json())
                                .then(data => {
                                    let resultsDiv = document.getElementById('searchResults');
                                    resultsDiv.innerHTML = ''; // Kosongkan hasil sebelumnya
                                    resultsDiv.classList.remove('hidden');

                                    if (data.length > 0) {
                                        // Pisahkan hasil berdasarkan kategori
                                        const categories = {
                                            'Warga': data.filter(item => item.type === 'warga'),
                                            'User': data.filter(item => item.type === 'user'),
                                            'UMKM': data.filter(item => item.type === 'umkm'),
                                        };

                                        // Tampilkan hasil per kategori
                                        for (const [category, items] of Object.entries(categories)) {
                                            if (items.length > 0) {
                                                resultsDiv.innerHTML += `
                                                                            <div class="text-[#096B5A] mb-2 font-bold">${category}</div>
                                                                        `;

                                                items.forEach(item => {
                                                    // Menyesuaikan URL gambar dan route sesuai kategori
                                                    let imageUrl =
                                                        'https://api.iconify.design/ion/person-circle.svg'; // Default avatar
                                                    let route = '#'; // Default route jika tidak tersedia

                                                    if (category === 'Warga') {
                                                        imageUrl = item.foto ? `/warga/${item.foto}` : imageUrl;
                                                        route = `/admin/detail-warga/${encodeURIComponent(item.uuid)}`;
                                                    } else if (category === 'User') {
                                                        imageUrl = item.foto ? `/user/${item.foto}` : imageUrl;
                                                        route = `/admin/profil-admin/${encodeURIComponent(item.uuid)}`;
                                                    } else if (category === 'UMKM') {
                                                        imageUrl = item.foto ? `/umkm/${item.foto}` : imageUrl;
                                                        route = `/admin/umkm`;
                                                    }

                                                    // HTML untuk setiap item hasil pencarian
                                                    resultsDiv.innerHTML += `
                                                                                <div ${route ? `onclick="window.location.href='${route}'"` : ''}
                                                                                    class="flex items-center p-2 rounded-md border border-[#096B5A] cursor-pointer hover:bg-gray-100">
                                                                                    <img src="${imageUrl}"
                                                                                        alt="Foto ${item.nama}"
                                                                                        class="shrink-0 me-3 rounded-full w-10 h-10 object-cover">
                                                                                    <div class="grid">
                                                                                        <h6 class="text-[14px] mb-0 font-normal">${item.nama}</h6>
                                                                                        <span class="text-[10px] font-semibold">${item.detail || ''}</span>
                                                                                    </div>
                                                                                </div>
                                                                            `;
                                                });
                                            }
                                        }
                                    } else {
                                        resultsDiv.innerHTML = `<div class="text-gray-500">Tidak ada hasil ditemukan</div>`;
                                    }
                                })
                                .catch(error => console.error('Error:', error));
                        } else {
                            document.getElementById('searchResults').classList.add('hidden');
                        }
                    }
                </script>


            </div>
        </div>
        <div class="col-auto">
            <div class="flex flex-wrap items-center gap-3">
                <button type="button" id="theme-toggle"
                    class="w-10 h-10 bg-neutral-200 dark:bg-neutral-700 dark:text-white rounded-full flex justify-center items-center">
                    <span id="theme-toggle-dark-icon" class="hidden">
                        <i class="ri-sun-line"></i>
                    </span>
                    <span id="theme-toggle-light-icon" class="hidden">
                        <i class="ri-moon-line"></i>
                    </span>
                </button>

                <button data-dropdown-toggle="dropdownProfile"
                    class="flex justify-center items-center gap-1 rounded-md border border-[#096B5A] p-1"
                    type="button">
                    <img src="{{ asset('assets/images/user.png') }}" alt="image"
                        class="w-10 h-10 object-fit-cover rounded-full">
                    <div class="grid justify-items-start">
                        <div class="text-sm font-normal text-[#096B5A] dark:text-white">
                            {{ auth()->guard('user')->user()->name }}</div>
                        <div class="text-[10px] font-semibold text-[#096B5A] dark:text-white">
                            {{ auth()->guard('user')->user()->role }}
                        </div>
                    </div>
                    <iconify-icon icon="eva:arrow-down-fill"
                        class="icon text-[#096B5A] dark:text-white ms-5 me-2"></iconify-icon>
                </button>
                <div id="dropdownProfile"
                    class="z-10 hidden bg-white dark:bg-neutral-700 rounded-lg shadow-lg dropdown-menu-sm p-3">
                    <div
                        class="py-3 px-4 rounded-lg bg-primary-50 dark:bg-primary-600/25 mb-4 flex items-center justify-between gap-2">
                        <div>
                            <h6 class="text-lg text-[#096B5A] font-semibold mb-0">
                                {{ auth()->guard('user')->user()->name }}</h6>
                            <span class="text-[#096B5A]">{{ auth()->guard('user')->user()->role }}</span>
                        </div>
                    </div>

                    <div class="max-h-[400px] overflow-y-auto scroll-sm pe-2">
                        <ul class="flex flex-col">
                            <li>
                                <a class="text-black px-0 py-2 hover:text-primary-600 flex items-center gap-4"
                                    href="{{ route('admin.profil-admin', ['uuid' => auth()->guard('user')->user()->uuid]) }}">
                                    <iconify-icon icon="solar:user-linear"
                                        class="icon text-xl text-[#096B5A]"></iconify-icon> Lihat Profil</a>
                            </li>
                            <li>
                                <a class="text-black px-0 py-2 hover:text-danger-600 flex items-center gap-4"
                                    href="{{ route('logout') }}">
                                    <iconify-icon icon="lucide:power"
                                        class="icon text-xl text-[#BA1A1A]"></iconify-icon> Log Out</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

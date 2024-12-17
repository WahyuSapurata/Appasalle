<!-- meta tags and other links -->
@section('title', $module)

@include('user.partial-html._template-top')

<div class="flex justify-center">
    <!-- Kontainer utama -->
    <div id="card-overflow" class="w-[460px] bg-[#f5fbf7] h-screen px-4 pt-4 pb-[100px] relative overflow-y-auto">

        @section('title-active', $module)
        @include('user.layouts._nav')

        <div class="grid mt-3">
            <a href="{{ route('user.riwayat-transaksi') }}"
                class="flex items-center justify-center gap-2 hover:bg-emerald-300 btn bg-transparent border border-[#096B5A] p-2">
                <iconify-icon icon="meteor-icons:clock-rotate" class="text-[#096B5A]" width="18"
                    height="18"></iconify-icon>
                <span class="text-xs font-medium text-[#096B5A]">Riwayat Transaksi</span>
            </a>
        </div>

        <div class="grid gap-3">
            @forelse ($tagihan as $tahun => $items)
                <div class="card border-0 bg-white shadow-lg p-2 mt-3">
                    <div class="grid gap-2">
                        <!-- Tahun -->
                        <div class="flex">
                            <div class="text-[10px] font-semibold text-[#3F4945]">Tahun {{ $tahun }}</div>
                        </div>

                        <!-- Daftar Tagihan -->
                        @foreach ($items as $item)
                            <div class="flex items-center justify-between cursor-pointer"
                                onclick="window.location.href='{{ route('user.detail-tagihan', ['uuid' => $item->uuid]) }}';">
                                <div class="flex items-center gap-2">
                                    <!-- Status Pembayaran -->
                                    <div
                                        class="h-6 w-6 {{ $item->status === 'Lunas' ? 'bg-[#BFF0B1]' : 'bg-[#FFDAD6]' }} flex items-center justify-center rounded-full">
                                        <iconify-icon
                                            icon="{{ $item->status === 'Lunas' ? 'tabler:check' : 'line-md:remove' }}"
                                            class="menu-icon text-[10px] {{ $item->status === 'Lunas' ? 'text-[#3E6837]' : 'text-[#BA1A1A]' }}"></iconify-icon>
                                    </div>

                                    <!-- Bulan dan Tahun -->
                                    <div class="text-sm font-normal text-[#171D1B]">
                                        {{ \Carbon\Carbon::createFromFormat('Y m d', $item->tanggal_tagihan)->formatLocalized('%B %Y') }}
                                    </div>
                                </div>

                                <!-- Jumlah Tagihan -->
                                <div class="text-sm font-normal text-[#171D1B]">Rp
                                    {{ number_format(Auth::guard('warga')->user()->tarif, 0, ',', '.') }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @empty
                <div class="col-span-2 text-4xl font-bold text-center text-slate-400 w-full mt-5">Belum ada Tagihan
                </div>
            @endforelse
        </div>

        @include('user.layouts._footer')

        @include('user.layouts._sidebar')

    </div>
</div>

@include('user.partial-html._template-bottom')

</body>

</html>

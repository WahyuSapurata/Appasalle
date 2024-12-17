<!-- meta tags and other links -->
@section('title', $module)

@include('user.partial-html._template-top')

<div class="flex justify-center">
    <!-- Kontainer utama -->
    <div id="card-overflow" class="w-[460px] bg-[#f5fbf7] h-screen px-4 pt-4 pb-[100px] relative overflow-y-auto">

        @section('title-active', $module)
        @include('user.layouts._nav')

        <div class="card border-0 bg-white shadow-lg mt-3">
            @foreach ($transaksi as $item)
                <div class="grid gap-1 p-2 border-b-2 border-b-[#BEC9C6]">
                    <div class="flex items-center justify-between">
                        <div class="text-sm font-normal">Transaksi
                            {{ $item->status == 'Lunas' ? 'Berhasil' : ($item->status == 'Proses' ? 'Sedang Di Proses' : ($item->status == 'Gagal' ? 'Gagal' : '')) }}
                        </div>
                        <div
                            class="h-6 w-6 {{ $item->status == 'Lunas' ? 'bg-[#BFF0B1]' : ($item->status == 'Proses' ? 'bg-[#CDE8DF]' : ($item->status == 'Gagal' ? 'bg-[#FFDAD6]' : '')) }} flex items-center justify-center rounded-full">
                            <iconify-icon
                                icon="{{ $item->status == 'Lunas' ? 'tabler:check' : ($item->status == 'Proses' ? 'mage:reload' : ($item->status == 'Gagal' ? 'line-md:remove' : '')) }}"
                                class="menu-icon text-[10px] {{ $item->status == 'Lunas' ? 'text-[#3E6837]' : ($item->status == 'Proses' ? 'text-[#426277]' : ($item->status == 'Gagal' ? 'text-[#BA1A1A]' : '')) }}"></iconify-icon>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="text-xs font-normal">Retribusi
                            {{ \Carbon\Carbon::createFromFormat('Y m d', $item->tanggal_tagihan)->formatLocalized('%B %Y') }}
                        </div>
                        <div class="text-xs font-bold">Rp
                            {{ number_format(Auth::guard('warga')->user()->tarif, 0, ',', '.') }}</div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</div>

@include('user.partial-html._template-bottom')

</body>

</html>

<!-- meta tags and other links -->
@section('title', $module)

@include('user.partial-html._template-top')

<div class="flex justify-center">
    <!-- Kontainer utama -->
    <div id="card-overflow" class="w-[460px] bg-[#f5fbf7] h-screen px-4 pt-4 pb-[100px] relative overflow-y-auto">

        @section('title-active', $module)
        @include('user.layouts._nav')

        <div class="grid grid-cols-2 mt-3 gap-2 w-full">
            @forelse ($umkm as $item)
                <div class="col-span-1 card w-full h-[220px] border-0 rounded-lg grid shadow-lg cursor-pointer"
                    onclick="window.location.href='{{ route('user.detail-umkm', ['uuid' => $item->uuid]) }}';">
                    <div class="w-full h-[168px] bg-gray-300 rounded-lg flex items-center justify-center">
                        @if ($item->foto)
                            <img src="{{ asset('umkm/' . $item->foto) }}" class="w-full h-[168px] rounded-lg"
                                alt="">
                        @else
                            <iconify-icon icon="lucide:image"
                                class="menu-icon text-[100px] text-gray-500"></iconify-icon>
                        @endif
                    </div>
                    <div class="grid justify-center">
                        <span class="text-lg font-bold">{{ $item->nama_umkm }}</span>
                    </div>
                </div>
            @empty
                <div class="col-span-2 text-4xl font-bold text-center text-slate-400 w-full">Belum ada UMKM</div>
            @endforelse
        </div>

        @include('user.layouts._footer')

        @include('user.layouts._sidebar')

    </div>
</div>

@include('user.partial-html._template-bottom')

</body>

</html>

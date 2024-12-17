<!-- meta tags and other links -->
@section('title', $module)

@include('kolektor.partial-html._template-top')

<div class="flex justify-center">
    <!-- Kontainer utama -->
    <div id="card-overflow" class="w-[460px] bg-[#f5fbf7] h-screen px-4 pt-4 pb-[10px] relative overflow-y-auto">

        @section('title-active', $module)
        @include('kolektor.layouts._nav')

        <div class="grid gap-3 mt-3">

            <div class="card border-0 bg-white p-2 shadow-lg">
                <div class="grid gap-3">
                    <!-- Upload Image Start -->
                    <div class="flex justify-center">
                        <div class="avatar-upload">
                            <div class="avatar-preview">
                                <div id="imagePreview"
                                    style="background-image: url({{ asset('user/' . auth()->guard('user')->user()->foto) }})">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Upload Image End -->
                    <div class="grid">
                        <div class="text-[10px] font-semibold uppercase">Nama</div>
                        <div class="text-base font-normal">{{ auth()->guard('user')->user()->name }}</div>
                    </div>
                    <div class="grid">
                        <div class="text-[10px] font-semibold uppercase">Role</div>
                        <div class="text-base font-normal">{{ auth()->guard('user')->user()->role }}</div>
                    </div>
                    <div class="grid grid-cols-2 gap-2">
                        <div class="grid col-span-1">
                            <div class="text-[10px] font-semibold uppercase">Rt</div>
                            <div class="text-base font-normal">{{ auth()->guard('user')->user()->rt }}</div>
                        </div>
                        <div class="grid col-span-1">
                            <div class="text-[10px] font-semibold uppercase">Rw</div>
                            <div class="text-base font-normal">{{ auth()->guard('user')->user()->rw }}</div>
                        </div>
                    </div>
                    <div class="grid">
                        <div class="text-[10px] font-semibold uppercase">Kelurahan</div>
                        <div class="text-base font-normal">{{ auth()->guard('user')->user()->kelurahan }}</div>
                    </div>
                </div>
            </div>

            <div class="grid gap-5">
                <a href="{{ route('logout-kolektor') }}"
                    class="flex items-center justify-center gap-2 hover:bg-[#FFDAD6] btn bg-transparent border border-[#BA1A1A] p-2">
                    <iconify-icon icon="material-symbols:text-select-move-back-word-rounded" class="text-[#BA1A1A]"
                        width="18" height="18"></iconify-icon>
                    <span class="text-xs font-medium text-[#BA1A1A]">Keluar</span>
                </a>
            </div>

        </div>
    </div>
</div>

@include('kolektor.partial-html._template-bottom')

<script></script>

</body>

</html>

<!-- meta tags and other links -->
@section('title', $module)

@include('user.partial-html._template-top')

<div class="flex justify-center">
    <div class="w-[460px] bg-[#096B5A] h-screen p-6 grid content-between">
        <div class="bg-white rounded-lg flex py-2 justify-center gap-6">
            <img src="{{ asset('assets/images/pemkot.png') }}" class="w-[48px]" alt="">
            <img src="{{ asset('assets/images/makassar.png') }}" class="w-[48px]" alt="">
        </div>
        <div class="flex justify-center">
            <img src="{{ asset('assets/images/logo-user.png') }}" alt="">
        </div>
        <div>
            <div>
                <div id="targetDiv"
                    class="bg-white p-4 rounded-2xl hidden opacity-0 translate-y-10 transition-transform duration-1000 ease-in-out">
                    <div class="text-[#096B5A] text-base font-normal">Hai!</div>
                    <form action="{{ route('login.login-proses-user') }}" method="POST" class="grid gap-3 mt-3">
                        @csrf
                        <div>
                            <input type="text" name="resrtribusi"
                                class="form-control h-[40px] text-[10px] font-semibold bg-neutral-50 dark:bg-dark-2 rounded-xl"
                                placeholder="Masukkan No. Retribusi">
                            @error('resrtribusi')
                                <div class="text-danger-600 text-sm">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <button type="submit"
                            class="btn bg-[#096B5A] text-white h-[40px] flex justify-center items-center">Masuk</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('user.partial-html._template-bottom')

<style>
    /* Tambahkan animasi transisi ke elemen */
    #targetDiv {
        transition: opacity 1s ease, transform 9s ease;
        /* Efek transisi lebih lambat */
        opacity: 0;
        /* Awalnya transparan */
        transform: translateY(40px);
        /* Awalnya geser ke bawah */
    }
</style>

<script>
    // Tunggu 10 detik, lalu tampilkan elemen dengan animasi
    setTimeout(function() {
        $('#targetDiv')
            .removeClass('hidden') // Hapus kelas hidden agar elemen terlihat
            .css({
                opacity: 1, // Ubah opacity menjadi 1 untuk fade in
                transform: 'translateY(0)' // Geser elemen ke posisi aslinya
            });
    }, 1000);
</script>

</body>

</html>

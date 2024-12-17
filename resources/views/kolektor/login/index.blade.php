<!-- meta tags and other links -->
@section('title', $module)

@include('kolektor.partial-html._template-top')

<div class="flex justify-center">
    <div class="w-[460px] bg-[#A1F2DC] h-screen p-6 grid content-between">
        <div class="bg-white rounded-lg flex py-2 justify-center gap-6">
            <img src="{{ asset('assets/images/pemkot.png') }}" class="w-[48px]" alt="">
            <img src="{{ asset('assets/images/makassar.png') }}" class="w-[48px]" alt="">
        </div>
        <div class="flex justify-center">
            <img src="{{ asset('assets/images/logo-kolektor.png') }}" alt="">
        </div>
        <div>
            <div>
                <div id="targetDiv"
                    class="bg-white p-4 rounded-2xl hidden opacity-0 translate-y-10 transition-transform duration-1000 ease-in-out">
                    <div class="text-[#096B5A] text-base font-normal">Hai!</div>
                    <form action="{{ route('login.login-proses-kolektor') }}" method="POST" class="grid gap-3 mt-3">
                        @csrf
                        <div class="mb-4 grid gap-1">
                            <div class="icon-field relative">
                                <span
                                    class="absolute start-4 top-1/2 -translate-y-1/2 pointer-events-none flex text-xl">
                                    <iconify-icon icon="mage:user" class="text-[#096B5A]"></iconify-icon>
                                </span>
                                <input type="text" name="username"
                                    class="ps-11 form-control h-[56px] border-neutral-300 bg-neutral-50 dark:bg-dark-2 rounded-xl"
                                    placeholder="Username">
                            </div>
                            @error('username')
                                <div class="text-danger-600 text-sm">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-4 grid gap-1">
                            <div class="relative">
                                <div class="icon-field">
                                    <span
                                        class="absolute start-4 top-1/2 -translate-y-1/2 pointer-events-none flex text-xl">
                                        <iconify-icon icon="solar:lock-password-outline"
                                            class="text-[#096B5A]"></iconify-icon>
                                    </span>
                                    <input type="password" name="password"
                                        class="form-control h-[56px] ps-11 border-neutral-300 bg-neutral-50 dark:bg-dark-2 rounded-xl"
                                        id="your-password" placeholder="Password">
                                </div>
                                <span
                                    class="toggle-password ri-eye-line cursor-pointer absolute end-0 top-1/2 -translate-y-1/2 me-4 text-secondary-light"
                                    data-toggle="#your-password"></span>
                            </div>
                            @error('password')
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

@include('kolektor.partial-html._template-bottom')

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

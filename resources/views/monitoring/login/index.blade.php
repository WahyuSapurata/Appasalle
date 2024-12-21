<!-- meta tags and other links -->
@section('title', $module)

@include('admin.partial-html._template-top')

<section class="bg-[#F5FBF7] dark:bg-dark-2 flex flex-wrap items-center justify-center min-h-[100vh]">
    <div class="py-6 px-4 flex flex-col justify-center bg-white shadow-md shadow-gray-500 rounded-lg">
        <div class="w-[590px] lg:max-w-[464px]">
            <div class="text-center mb-2">
                <a href="index.html" class="mb-2.5 max-w-[290px]">
                    <img src="{{ asset('assets/images/logo-login.png') }}" class="w-[180px]" alt="">
                </a>
            </div>
            <form action="{{ route('login.login-proses-monitoring') }}" method="POST">
                @csrf
                <div class="mb-4 grid gap-1">
                    <div class="icon-field relative">
                        <span class="absolute start-4 top-1/2 -translate-y-1/2 pointer-events-none flex text-xl">
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
                            <span class="absolute start-4 top-1/2 -translate-y-1/2 pointer-events-none flex text-xl">
                                <iconify-icon icon="solar:lock-password-outline" class="text-[#096B5A]"></iconify-icon>
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
                    class="btn btn-primary justify-center text-sm btn-sm px-3 py-4 w-full rounded-xl font-semibold">Login</button>
            </form>
            <hr class="my-5 border-gray-300">
            <div class="flex gap-6 justify-center">
                <img src="{{ asset('assets/images/pemkot.png') }}" class="w-[48px] h-[48px]" alt="">
                <img src="{{ asset('assets/images/makassar.png') }}" class="w-[48px] h-[48px]" alt="">
            </div>
        </div>
    </div>
</section>

@include('admin.partial-html._template-bottom')
<script>
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

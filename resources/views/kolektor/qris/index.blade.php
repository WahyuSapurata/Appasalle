<!-- meta tags and other links -->
@section('title', $module)

@include('kolektor.partial-html._template-top')

<div class="flex justify-center">
    <!-- Kontainer utama -->
    <div id="card-overflow" class="w-[460px] bg-[#f5fbf7] h-screen px-4 pt-4 pb-[20px] relative overflow-y-auto">
        <div class="grid mt-3 gap-2">
            <div class="flex justify-end items-center">
                <div class="flex items-center gap-2">
                    <iconify-icon icon="material-symbols:share-outline" class="text-[#096B5A] cursor-pointer"
                        width="24" height="24" onclick="shareImage()"></iconify-icon>
                    <iconify-icon icon="material-symbols:download" class="text-[#096B5A] cursor-pointer" width="24"
                        height="24" onclick="downloadImage()"></iconify-icon>
                </div>
            </div>
            <div class="text-[#096B5A] text-2xl font-normal">{{ $module }}</div>
        </div>

        <div id="qr-card" class="grid gap-3">
            <div class="mt-3">
                <img src="{{ asset('assets/images/qris.png') }}" class="w-full" alt="">
            </div>
            <div class="card border-0 bg-white shadow-lg p-2">
                <div class="grid gap-2">
                    <div class="grid">
                        <div class="text-[10px] font-semibold uppercase">Jumlah pembayaran</div>
                        <div class="text-base font-normal">Rp {{ number_format($transaksi->terbayarkan, 0, ',', '.') }}
                        </div>
                    </div>
                    <div class="grid">
                        <div class="text-[10px] font-semibold uppercase">no. transaksi </div>
                        <div class="text-base font-normal">{{ $transaksi->no_transaksi }}</div>
                    </div>
                    <div class="grid">
                        <div class="text-[10px] font-semibold uppercase">dibayarkan ke</div>
                        <div class="text-base font-normal">Kecamatan Makassar</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid gap-3 mt-2">
            <a href="{{ route('kolektor.bukti-transaksi', ['uuid' => $transaksi->uuid]) }}"
                class="flex items-center justify-center gap-2 hover:bg-emerald-300 btn bg-[#096B5A] border border-[#096B5A] p-2">
                <span class="text-xs font-medium text-white">Kirim Bukti Pembayaran</span>
            </a>
        </div>
    </div>

</div>
</div>

@include('kolektor.partial-html._template-bottom')
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script>
    function downloadImage() {
        const element = document.getElementById('qr-card'); // Elemen yang ingin di-download
        html2canvas(element).then(canvas => {
            const link = document.createElement('a');
            link.download = 'qr-code.png'; // Nama file
            link.href = canvas.toDataURL('image/png');
            link.click();
        });
    }

    function shareImage() {
        const element = document.getElementById('qr-card'); // Elemen yang ingin dibagikan
        html2canvas(element).then(canvas => {
            canvas.toBlob(blob => {
                const file = new File([blob], 'qr-code.png', {
                    type: 'image/png'
                });
                if (navigator.share) {
                    navigator.share({
                        files: [file],
                        title: 'QR Code',
                        text: 'Lihat QR Code ini',
                    }).catch(console.error);
                } else {
                    Swal.fire({
                        title: "Terjadi Kesalahan",
                        text: "Browser tidak mendukung fitur share.",
                        icon: "error",
                        showConfirmButton: false,
                        timer: 1500,
                    });
                }
            });
        });
    }
</script>

</body>

</html>

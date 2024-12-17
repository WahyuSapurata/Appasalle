/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/views/admin/partial-html/_template-top.blade.php",
        "./resources/views/admin/partial-html/_template-bottom.blade.php",
        "./resources/views/admin/login/index.blade.php",
        "./resources/views/admin/layouts/_breadcrumb.blade.php",
        "./resources/views/admin/layouts/_footer.blade.php",
        "./resources/views/admin/layouts/_nav.blade.php",
        "./resources/views/admin/layouts/_sidebar.blade.php",
        "./resources/views/admin/dashboard/index.blade.php",
        "./resources/views/admin/tunggakan/index.blade.php",
        "./resources/views/admin/transaksi/index.blade.php",
        "./resources/views/admin/warga/index.blade.php",
        "./resources/views/admin/detailwarga/index.blade.php",
        "./resources/views/admin/umkm/index.blade.php",
        "./resources/views/admin/profiladmin/index.blade.php",
        "./resources/views/admin/user/index.blade.php",

        "./resources/views/user/partial-html/_template-top.blade.php",
        "./resources/views/user/partial-html/_template-bottom.blade.php",
        "./resources/views/user/layouts/_breadcrumb.blade.php",
        "./resources/views/user/layouts/_footer.blade.php",
        "./resources/views/user/layouts/_nav.blade.php",
        "./resources/views/user/layouts/_sidebar.blade.php",
        "./resources/views/user/login/index.blade.php",
        "./resources/views/user/dashboard/index.blade.php",
        "./resources/views/user/profil/index.blade.php",
        "./resources/views/user/tagihan/index.blade.php",
        "./resources/views/user/detailtagihan/index.blade.php",
        "./resources/views/user/pembayaran/index.blade.php",
        "./resources/views/user/qris/index.blade.php",
        "./resources/views/user/buktitransaksi/index.blade.php",
        "./resources/views/user/prosestransaksi/index.blade.php",

        "./resources/views/kolektor/partial-html/_template-top.blade.php",
        "./resources/views/kolektor/partial-html/_template-bottom.blade.php",
        "./resources/views/kolektor/layouts/_breadcrumb.blade.php",
        "./resources/views/kolektor/layouts/_footer.blade.php",
        "./resources/views/kolektor/layouts/_nav.blade.php",
        "./resources/views/kolektor/layouts/_sidebar.blade.php",
        "./resources/views/kolektor/login/index.blade.php",
        "./resources/views/kolektor/dashboard/index.blade.php",
        "./resources/views/kolektor/transaksi/index.blade.php",
        "./resources/views/kolektor/detail_transaksi/index.blade.php",
        "./resources/views/kolektor/warga/index.blade.php",
        "./resources/views/kolektor/pembayaran/index.blade.php",
        "./resources/views/kolektor/qris/index.blade.php",
        "./resources/views/kolektor/buktitransaksi/index.blade.php",
        "./resources/views/kolektor/prosestransaksi/index.blade.php",
    ],
    theme: {
        extend: {},
    },
    plugins: [],
}

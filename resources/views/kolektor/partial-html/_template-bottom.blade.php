  <!-- jQuery library js -->
  <script src="{{ asset('assets/js/lib/jquery-3.7.1.min.js') }}"></script>
  <!-- Apex Chart js -->
  <script src="{{ asset('assets/js/lib/apexcharts.min.js') }}"></script>
  <!-- Data Table js -->
  <script src="{{ asset('assets/js/lib/simple-datatables.min.js') }}"></script>
  <!-- Iconify Font js -->
  <script src="{{ asset('assets/js/lib/iconify-icon.min.js') }}"></script>
  <!-- jQuery UI js -->
  <script src="{{ asset('assets/js/lib/jquery-ui.min.js') }}"></script>
  <!-- Vector Map js -->
  <script src="{{ asset('assets/js/lib/jquery-jvectormap-2.0.5.min.js') }}"></script>
  <script src="{{ asset('assets/js/lib/jquery-jvectormap-world-mill-en.js') }}"></script>
  <!-- Popup js -->
  <script src="{{ asset('assets/js/lib/magnifc-popup.min.js') }}"></script>
  <!-- Slick Slider js -->
  <script src="{{ asset('assets/js/lib/slick.min.js') }}"></script>
  <!-- prism js -->
  <script src="{{ asset('assets/js/lib/prism.js') }}"></script>
  <!-- file upload js -->
  <script src="{{ asset('assets/js/lib/file-upload.js') }}"></script>
  <!-- audioplayer -->
  <script src="{{ asset('assets/js/lib/audioplayer.js') }}"></script>

  <script src="{{ asset('assets/js/flowbite.min.js') }}"></script>
  <!-- main js -->
  <script src="{{ asset('assets/js/app.js') }}"></script>

  @if ($message = Session::get('failed'))
      <script>
          document.addEventListener('DOMContentLoaded', function() {
              Swal.fire({
                  title: "Eror",
                  text: {!! json_encode($message) !!},
                  icon: "warning",
                  showConfirmButton: false,
                  timer: 1500,
              });
          });
      </script>
  @endif

  @if ($message = Session::get('success'))
      <script>
          document.addEventListener('DOMContentLoaded', function() {
              Swal.fire({
                  title: "Sukses",
                  text: {!! json_encode($message) !!},
                  icon: "success",
                  showConfirmButton: false,
                  timer: 1500,
              });
          });
      </script>
  @endif

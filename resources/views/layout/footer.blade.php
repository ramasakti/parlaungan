        <div class="mx-4">
          @yield('konten')
        </div>
        <hr>
        <footer class="ftco-footer ftco-bg-dark ftco-section mt-5">
            <div class="container px-md-5">
              <div class="row mb-5">
                  <div class="col-md">
                  <div class="ftco-footer-widget mb-4">
                      <h4 class="ftco-heading-2">Kontak Kami</h4>
                      <div class="block-23 mb-3">
                          <ul>
                          <li><a href="#" class="uk-icon-link uk-margin-small-right" uk-icon="location"></a><span class="text">Jl. Berbek I 2-4 Berbek Waru Sidoarjo</span></li>
                          <li><a href="#" class="uk-icon-link uk-margin-small-right" uk-icon="receiver"></a><span class="text">031 8668 298</span></a></li>
                          <li><a href="#" class="uk-icon-link uk-margin-small-right" uk-icon="mail"></a><span class="text">admin@smaispa.sch.id</span></a></li>
                          </ul>
                      </div>
                  </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-12">
                  <p>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a class="text-decoration-none" href="https://colorlib.com" target="_blank">Colorlib</a>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                  </p>
                  </div>
              </div>
            </div>
        </footer>
        <hr>
    </div><!-- END COLORLIB-MAIN -->
</div><!-- END COLORLIB-PAGE -->

<!--===============================================================================================-->
<script src="/css/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="/css/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="/css/vendor/bootstrap/js/popper.js"></script>
<script src="/css/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="/css/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="/css/vendor/daterangepicker/moment.min.js"></script>
<script src="/css/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
<script src="/css/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
<script src="https://smaispa.sch.id/form/js/main.js"></script>
<!-- loader -->
{{-- <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div> --}}

<script>
  var slideIndex = 1;
  showDivs(slideIndex);
  
  function plusDivs(n) {
    showDivs(slideIndex += n);
  }
  
  function showDivs(n) {
    var i;
    var x = document.getElementsByClassName("mySlides");
    if (n > x.length) {slideIndex = 1}
    if (n < 1) {slideIndex = x.length}
    for (i = 0; i < x.length; i++) {
      x[i].style.display = "none";  
    }
    x[slideIndex-1].style.display = "block";  
  }
</script>

<script type="text/javascript">
  var rupiah = document.getElementById('rupiah');
  rupiah.addEventListener('keyup', function(e){
      // tambahkan 'Rp.' pada saat form di ketik
      // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
      rupiah.value = formatRupiah(this.value, '');
  });

  /* Fungsi formatRupiah */
  function formatRupiah(angka, prefix){
      var number_string = angka.replace(/[^,\d]/g, '').toString(),
      split   		= number_string.split(','),
      sisa     		= split[0].length % 3,
      rupiah     		= split[0].substr(0, sisa),
      ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

      // tambahkan titik jika yang di input sudah menjadi angka ribuan
      if(ribuan){
          separator = sisa ? '.' : '';
          rupiah += separator + ribuan.join('.');
      }

      rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
      return prefix == undefined ? rupiah : (rupiah ? '' + rupiah : '');
  }
</script>
<script src="{{ asset('/sw.js') }}"></script>
<script>
  if (!navigator.serviceWorker.controller) {
      navigator.serviceWorker.register("/sw.js").then(function (reg) {
          console.log("Service worker has been registered for scope: " + reg.scope);
      });
  }
</script>
</body>
</html>
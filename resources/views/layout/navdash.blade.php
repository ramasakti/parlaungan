
<div id="colorlib-page">
    <a href="#" class="js-colorlib-nav-toggle colorlib-nav-toggle"><i></i></a>
    <aside id="colorlib-aside" role="complementary" class="js-fullheight text-center">
        <h5 id="colorlib-logo"><a href="/profile"><span class="img" style="background-image: url(img/default-user.jpg);"></span>{{ session('username') }}</a></h5>
        <nav id="colorlib-main-menu" role="navigation">
            <ul>
                <li class="{{ ($navactive === 'dashboard') ? 'colorlib-active' : '' }}"><a href="/dashboard">Dashboard</a></li>
                @switch(session('status'))
                    @case('Admin')
                        <li class="{{ ($navactive === 'web') ? 'colorlib-active' : '' }}"><a href="/web">Web</a></li>
                        <li class="{{ ($navactive === 'sekolah') ? 'colorlib-active' : '' }}"><a href="/sekolah">Sekolah</a></li>
                        <li class="{{ ($navactive === 'keuangan') ? 'colorlib-active' : '' }}"><a href="/keuangan">Keuangan</a></li>
                        <li class="{{ ($navactive === 'user') ? 'colorlib-active' : '' }}"><a href="/user">User</a></li>
                        <li class="{{ ($navactive === 'siswa') ? 'colorlib-active' : '' }}"><a href="/siswa">Siswa</a></li>
                        <li class="{{ ($navactive === 'absen') ? 'colorlib-active' : '' }}"><a href="/absen">Absen</a></li>
                        <li class="{{ ($navactive === 'jadwal') ? 'colorlib-active' : '' }}"><a href="/jadwal">Jadwal</a></li>
                        <li class="{{ ($navactive === 'jurnal') ? 'colorlib-active' : '' }}"><a href="/jurnal">Jurnal</a></li>
                    @break
                    @case('Bendahara')
                        <li class="{{ ($navactive === 'keuangan') ? 'colorlib-active' : '' }}"><a href="/keuangan">Keuangan</a></li>
                    @break                  
                    @case('Kurikulum')
                        <li class="{{ ($navactive === 'sekolah') ? 'colorlib-active' : '' }}"><a href="/sekolah">Sekolah</a></li>
                        <li class="{{ ($navactive === 'jadwal') ? 'colorlib-active' : '' }}"><a href="/jadwal">Jadwal</a></li>
                        <li class="{{ ($navactive === 'jurnal') ? 'colorlib-active' : '' }}"><a href="/jurnal">Jurnal</a></li>
                    @break                  
                    @case('Kesiswaan')
                        <li class="{{ ($navactive === 'web') ? 'colorlib-active' : '' }}"><a href="/web">Web</a></li>
                        <li class="{{ ($navactive === 'sekolah') ? 'colorlib-active' : '' }}"><a href="/sekolah">Sekolah</a></li>
                        <li class="{{ ($navactive === 'siswa') ? 'colorlib-active' : '' }}"><a href="/siswa">Siswa</a></li>
                        <li class="{{ ($navactive === 'absen') ? 'colorlib-active' : '' }}"><a href="/absen">Absen</a></li>
                    @break                  
                    @case('Guru')
                        <li class="{{ ($navactive === 'jadwal') ? 'colorlib-active' : '' }}"><a href="/jadwal">Jadwal</a></li>
                        <li class="{{ ($navactive === 'jurnal') ? 'colorlib-active' : '' }}"><a href="/jurnal">Jurnal</a></li>
                    @break   
                    @case('Siswa')   
                        <li class="{{ ($navactive === 'jadwal') ? 'colorlib-active' : '' }}"><a href="/jadwal">Jadwal</a></li>
                        <li class="{{ ($navactive === 'jurnal') ? 'colorlib-active' : '' }}"><a href="/jurnal">Jurnal</a></li> 
                    @break           
                @endswitch
            </ul>
        </nav>
    </aside> <!-- END COLORLIB-ASIDE -->
    <div id="colorlib-main">
        <section class="ftco-section ftco-bread">
            <div class="container">
                <div class="row no-gutters slider-text justify-content-center align-items-center">
                    <div class="col-md-8 ftco-animate">
                        <p class="breadcrumbs"><span class="mr-2"><a href="/">Home</a></span> <span>{{ $title }}</span></p>
                        <h4 class="bread">{{ $title }}</h4>
                    </div>
                </div>
            </div>
        </section>
        <section class="ftco-section-3">
            <div class="photograhy">
                <div>
                    @yield('konten')
                </div>
            </div>
        </section>
    </div><!-- END COLORLIB-MAIN -->
</div><!-- END COLORLIB-PAGE -->
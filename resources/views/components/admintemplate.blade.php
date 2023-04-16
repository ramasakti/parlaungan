<!doctype html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ $title }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="SMA Islam Parlaungan" content="Berkarya, Berkarakter, Berakhlakul Karimah">
    {{-- Data Tables --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <!-- PWA  -->
    <meta name="theme-color" content="#FFFFFF"/>
    <link rel="apple-touch-icon" href="{{ asset('/img/logo.png') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">
    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.15.24/dist/css/uikit.min.css" />
    {{-- AdminLTE --}}
    <link rel="shortcut icon" type="image/png" href="/adminlte/images/icon/favicon.ico">
    <link rel="stylesheet" href="/adminlte/css/bootstrap.min.css">
    <link rel="stylesheet" href="/adminlte/css/font-awesome.min.css">
    <link rel="stylesheet" href="/adminlte/css/themify-icons.css">
    <link rel="stylesheet" href="/adminlte/css/metisMenu.css">
    <link rel="stylesheet" href="/adminlte/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/adminlte/css/slicknav.min.css">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- others css -->
    <link rel="stylesheet" href="/adminlte/css/typography.css">
    <link rel="stylesheet" href="/adminlte/css/default-css.css">
    <link rel="stylesheet" href="/adminlte/css/styles.css">
    <link rel="stylesheet" href="/adminlte/css/responsive.css">
    <!-- modernizr css -->
    <script src="/adminlte/js/vendor/modernizr-2.8.3.min.js"></script>
    {{-- TinyMCE --}}
    <script src="https://cdn.tiny.cloud/1/zgg0gxpkj4s833bnso32wri5w42hrq17ebnjci64yppegu0j/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
        <div class="sidebar-menu">
            <div class="sidebar-header">
                <div class="logo">
                    <a href="#"><img src="/img/logo.png" class="uk-border-circle" alt="logo"></a>
                </div>
            </div>
            <div class="main-menu">
                <div class="menu-inner">
                    <nav>
                        <ul class="metismenu" id="menu">
                            <li class="{{ ($navactive === 'dashboard' ? 'active' : '') }}">
                                <a href="/dashboard">
                                    <span>Dashboard</span>
                                </a>
                                <li class="{{ ($navactive === 'web' ? 'active' : '') }}">
                                    <a href="/web"><span>Web</span></a>
                                </li>
                            </li>
                            @php
                                if (date('d') <= 15) {
                                    $mulai = date('Y-m-d', strtotime('-1 month', strtotime(date('Y-m-15'))));
                                    $sampai = date('Y-m-15');
                                }else{
                                    $mulai = date('Y-m-15');
                                    $sampai = date('Y-m-d', strtotime('+1 month', strtotime(date('Y-m-15'))));
                                }
                            @endphp
                            @switch(session('status'))
                                @case('Admin')
                                    <li class="{{ ($navactive === 'user' ? 'active' : '') }}">
                                        <a href="/user"><span>User</span></a>
                                    </li>
                                    <li class="{{ ($navactive === 'sekolah' ? 'active' : '') }}">
                                        <a href="javascript:void(0)" aria-expanded="true"><span>Sekolah</span></a>
                                        <ul class="collapse">
                                            <li><a href="/sekolah"><span>Harian & Libur</span></a></li>
                                            <li><a href="/rapat"><span>Rapat</span></a></li>
                                            <li><a href="/arsip"><span>Administrasi Surat</span></a></li>
                                            <li><a href="#"><span>E Library</span></a></li>
                                        </ul>
                                    </li>
                                    <li class="{{ ($navactive === 'siswa' ? 'active' : '') }}">
                                        <a href="javascript:void(0)" aria-expanded="true"><span>Siswa</span></a>
                                        <ul class="collapse">
                                            <li><a href="/siswa">Data Siswa</a></li>
                                            <li><a href="/absen">Absen Siswa</a></li>
                                            <li><a href="/absen/rekap">Rekap Absen Siswa</a></li>
                                            <li>
                                                <a href="/siswa/keuangan">Keuangan Siswa</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="{{ ($navactive === 'guru' ? 'active' : '') }}">
                                        <a href="javascript:void(0)" aria-expanded="true"><span>Guru</span></a>
                                        <ul class="collapse">
                                            <li><a href="/guru">Data Guru</a></li>
                                            <li><a href="/guru/keuangan?dari={{ $mulai }}&sampai={{ $sampai }}">Keuangan Guru</a></li>
                                        </ul>
                                    </li>
                                    <li class="{{ ($navactive === 'akademik' ? 'active' : '') }}">
                                        <a href="javascript:void(0)" aria-expanded="true"><span>Akademik</span></a>
                                        <ul class="collapse">
                                            <li><a href="/jadwal">Jadwal Pelajaran</a></li>
                                            <li><a href="/jurnal">Jurnal Kelas</a></li>
                                        </ul>
                                    </li>
                                    @break
                                @case('Bendahara')
                                    <li class="{{ ($navactive === 'siswa' ? 'active' : '') }}">
                                        <a href="javascript:void(0)" aria-expanded="true"><span>Siswa</span></a>
                                        <ul class="collapse">
                                            <li><a href="/siswa">Data Siswa</a></li>
                                            <li><a href="/absen">Absen Siswa</a></li>
                                            <li><a href="/absen/rekap">Rekap Absen Siswa</a></li>
                                            <li><a href="/siswa/keuangan">Keuangan Siswa</a></li>
                                        </ul>
                                    </li>
                                    <li class="{{ ($navactive === 'guru' ? 'active' : '') }}">
                                        <a href="javascript:void(0)" aria-expanded="true"><span>Guru</span></a>
                                        <ul class="collapse">
                                            <li><a href="/guru">Data Guru</a></li>
                                            <li><a href="/guru/keuangan?dari={{ date('Y-m-15') }}&sampai={{ date('Y-m-15') }}">Keuangan Guru</a></li>
                                        </ul>
                                    </li>
                                    @break
                                @case('Kurikulum')
                                    <li class="{{ ($navactive === 'sekolah' ? 'active' : '') }}">
                                        <a href="javascript:void(0)" aria-expanded="true"><span>Sekolah</span></a>
                                        <ul class="collapse">
                                            <li><a href="/sekolah"><span>Harian & Libur</span></a></li>
                                            <li><a href="/rapat"><span>Rapat</span></a></li>
                                            <li><a href="/arsip"><span>Administrasi Surat</span></a></li>
                                            <li><a href="#"><span>E Library</span></a></li>
                                        </ul>
                                    </li>
                                    <li class="{{ ($navactive === 'guru' ? 'active' : '') }}">
                                        <a href="javascript:void(0)" aria-expanded="true"><span>Guru</span></a>
                                        <ul class="collapse">
                                            <li><a href="/guru">Data Guru</a></li>
                                            <li><a href="/guru/keuangan?dari={{ date('Y-m-15') }}&sampai={{ date('Y-m-15') }}">Keuangan Guru</a></li>
                                        </ul>
                                    </li>
                                    <li class="{{ ($navactive === 'akademik' ? 'active' : '') }}">
                                        <a href="javascript:void(0)" aria-expanded="true"><span>Akademik</span></a>
                                        <ul class="collapse">
                                            <li><a href="/jadwal">Jadwal Pelajaran</a></li>
                                            <li><a href="/jurnal">Jurnal Kelas</a></li>
                                        </ul>
                                    </li>
                                    @if (session('piket'))
                                        <li class="{{ ($navactive === 'siswa' ? 'active' : '') }}">
                                            <a href="/absen"><span>Absen Siswa</span></a>
                                        </li>
                                    @endif
                                    @break    
                                @case('Kesiswaan')
                                    <li class="{{ ($navactive === 'sekolah' ? 'active' : '') }}">
                                        <a href="javascript:void(0)" aria-expanded="true"><span>Sekolah</span></a>
                                        <ul class="collapse">
                                            <li><a href="/sekolah"><span>Harian & Libur</span></a></li>
                                            <li><a href="/rapat"><span>Rapat</span></a></li>
                                            <li><a href="/arsip"><span>Administrasi Surat</span></a></li>
                                            <li><a href="#"><span>E Library</span></a></li>
                                        </ul>
                                    </li>
                                    <li class="{{ ($navactive === 'siswa' ? 'active' : '') }}">
                                        <a href="javascript:void(0)" aria-expanded="true"><span>Siswa</span></a>
                                        <ul class="collapse">
                                            <li><a href="/siswa">Data Siswa</a></li>
                                            <li><a href="/absen">Absen Siswa</a></li>
                                            <li><a href="/absen/rekap">Rekap Absen Siswa</a></li>
                                            <li><a href="/siswa/keuangan">Keuangan Siswa</a></li>
                                        </ul>
                                    </li>
                                    @break    
                                @case('Guru')
                                    @if (session('walas'))
                                        <li class="{{ ($navactive === 'siswa' ? 'active' : '') }}">
                                            <a href="javascript:void(0)" aria-expanded="true"><span>{{ session('walas')->tingkat }} {{ session('walas')->jurusan }}</span></a>
                                            <ul class="collapse">
                                                <li><a href="/absen?id_kelas={{ session('walas')->id_kelas }}">Absen {{ session('walas')->tingkat }} {{ session('walas')->jurusan }}</a></li>
                                                <li><a href="/siswa/keuangan">Keuangan {{ session('walas')->tingkat }} {{ session('walas')->jurusan }}</a></li>
                                            </ul>
                                        </li>
                                    @else
                                        @if (session('piket'))
                                            <li class="{{ ($navactive === 'siswa' ? 'active' : '') }}">
                                                <a href="/absen"><span>Absen Siswa</span></a>
                                                <li><a href="/absen/rekap">Rekap Absen Siswa</a></li>
                                            </li>
                                        @endif
                                    @endif
                                    <li class="{{ ($navactive === 'akademik' ? 'active' : '') }}">
                                        <a href="javascript:void(0)" aria-expanded="true"><span>Akademik</span></a>
                                        <ul class="collapse">
                                            <li><a href="/jadwal">Jadwal Pelajaran</a></li>
                                            <li><a href="/jurnal">Jurnal Kelas</a></li>
                                        </ul>
                                    </li>
                                    @break    
                            @endswitch
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- sidebar menu area end -->
        <!-- main content area start -->
        <div class="main-content">
            <!-- header area start -->
            <div class="header-area">
                <div class="row align-items-center">
                    <!-- nav and search button -->
                    <div class="col-md-6 col-sm-8 clearfix">
                        <div class="nav-btn pull-left">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                    <!-- profile info & task notification -->
                    <div class="col-md-6 col-sm-4 clearfix">
                        <ul class="notification-area pull-right">
                    </div>
                </div>
            </div>
            <!-- header area end -->
            <!-- page title area start -->
            <div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">
                            <h4 class="page-title pull-left">{{ $title }}</h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="/">Home</a></li>
                                <li><span>{{ request()->path() }}</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 clearfix">
                        <div class="user-profile pull-right">
                            <img class="avatar user-thumb" src="/adminlte/images/author/avatar.png" alt="avatar">
                            <h4 class="user-name dropdown-toggle" data-toggle="dropdown">{{ session('username') }}<i class="fa fa-angle-down"></i></h4>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="/profile">Profile</a>
                                <a class="dropdown-item" href="/logout">Log Out</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page title area end -->
            <div class="main-content-inner ">
                <!-- MAIN CONTENT GOES HERE -->
                {{ $slot }}
            </div>
        </div>
        <!-- main content area end -->

        <!-- footer area start-->
        <footer>
            <div class="footer-area">
                <p>Dibuat dan Dikembangkan oleh <b>Staf Data, Informasi, Pengembangan, dan Infrastruktur Teknologi - SMA Islam Parlaungan</b></p>
            </div>
        </footer>
        <!-- footer area end-->
    </div>
    <!-- page container area end -->
    
    <!-- UIkit JS -->
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.15.24/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.15.24/dist/js/uikit-icons.min.js"></script>

    <!-- offset area end -->
    <!-- jquery latest version -->
    <script src="/adminlte/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap 4 js -->
    <script src="/adminlte/js/popper.min.js"></script>
    <script src="/adminlte/js/bootstrap.min.js"></script>
    <script src="/adminlte/js/owl.carousel.min.js"></script>
    <script src="/adminlte/js/metisMenu.min.js"></script>
    <script src="/adminlte/js/jquery.slimscroll.min.js"></script>
    <script src="/adminlte/js/jquery.slicknav.min.js"></script>

    <!-- start chart js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <!-- start highcharts js -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <!-- start zingchart js -->
    <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
    <script>
        zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
        ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
    </script>
    <!-- all line chart activation -->
    <script src="/adminlte/js/line-chart.js"></script>
    <!-- all pie chart -->
    <script src="/adminlte/js/pie-chart.js"></script>
    <!-- others plugins -->
    <script src="/adminlte/js/plugins.js"></script>
    <script src="/adminlte/js/scripts.js"></script>
    {{-- Data Tables --}}
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

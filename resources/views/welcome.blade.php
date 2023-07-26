<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- PWA  -->
    <meta name="theme-color" content="#FFFFFF"/>
    <link rel="apple-touch-icon" href="{{ asset('/img/logo.png') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">

    <!-- Primary Meta Tags -->
    <title>SMA Islam Parlaungan</title>
    <meta name="title" content="SMA Islam Parlaungan">
    <meta name="description" content="Berkarya, berkarakter, berakhlakul karimah">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://smaispa.sch.id/">
    <meta property="og:title" content="SMA Islam Parlaungan">
    <meta property="og:description" content="Berkarya, berkarakter, berakhlakul karimah">
    <meta property="og:image" content="https://smaispa.sch.id/steller/imgs/lambang.png">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://smaispa.sch.id/">
    <meta property="twitter:title" content="SMA Islam Parlaungan">
    <meta property="twitter:description" content="Berkarya, berkarakter, berakhlakul karimah">
    <meta property="twitter:image" content="https://smaispa.sch.id/steller/imgs/lambang.png">

    <!-- font icons -->
    <link rel="stylesheet" href="./steller/vendors/themify-icons/css/themify-icons.css">
    <!-- Bootstrap + Steller main styles -->
	<link rel="stylesheet" href="./steller/css/steller.css">

    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.15.24/dist/css/uikit.min.css" />
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="40" id="home">

    <!-- Page navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" data-spy="affix" data-offset-top="0">
        <div class="container">
            <a class="navbar-brand" href="#"><img src="./steller/imgs/lambang.png" alt="Logo SMA Islam Parlaungan"></a>
            <button class="navbar-toggler" id="togglerNav" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#service">Filosofi</a>
                    </li>                   
                    <li class="nav-item">
                        <a class="nav-link" href="#portfolio">Galeri</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#testmonial">Testmonial</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#blog">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                    @if (session()->has('username'))
                        <li class="nav-item">
                            <a class="- btn btn-primary rounded mb-2" href="/dashboard" uk-toggle>Dashboard</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="- btn btn-primary rounded mb-2" id="modalLogin" onclick="closeNav()" href="#modal-login" uk-toggle>Login</a>
                            @include('modal-login')
                        </li>
                    @endif
                </ul>
            </div>
        </div>          
    </nav>
    <!-- End of page navibation -->

    <!-- Page Header -->
    <header class="header" id="home">
        <div class="container">
            <div class="infos">
                <h6 class="title">SMA Islam</h6>
                <h6 class="title uk-margin-remove-top">Parlaungan</h6>

                <div class="buttons pt-3">
                    <button class="btn btn-primary rounded">PPDB</button>
                    <button class="btn btn-dark rounded">BROSUR</button>
                </div>      

                <div class="socials mt-4">
                    <a class="social-item" href="https://instagram.com/officialsmaispa"><i class="ti-instagram"></i></a>
                    <a class="social-item" href="https://www.youtube.com/@officialsmaislamparlaungan3823"><i class="ti-youtube"></i></a>
                    <a class="social-item" href="https://www.facebook.com/profile.php?id=100087308974868"><i class="ti-facebook"></i></a>
                </div>
            </div>              
            <div class="img-holder">
                <img height="700px" src="./steller/imgs/banner.svg" alt="">
            </div>      
        </div>  

        <!-- Header-widget -->
        <div class="widget">
            <div class="widget-item">
                <h2>124</h2>
                <p>Happy Clients</p>
            </div>
            <div class="widget-item">
                <h2>456</h2>
                <p>Project Completed</p>
            </div>
            <div class="widget-item">
                <h2>789</h2>
                <p>Awards Won</p>
            </div>
        </div>
    </header>
    <!-- End of Page Header -->
    
    <!-- About section -->
    <section id="about" class="section mt-3">
        <div class="container mt-5">
            <div class="row text-center text-md-left">
                <div class="col-md-3">
                    <img src="./steller/imgs/diniyah.jpg" alt="" class="img-thumbnail mb-4">
                    <img src="./steller/imgs/diniyah-2.jpg" alt="" class="img-thumbnail mb-4">
                </div>
                <div class="pl-md-4 col-md-9">
                    <h6 class="title">Program Diniyah</h6>
                    <p class="subtitle">Pembelajaran Mengaji Berdiferensiasi</p>
                    <p>Program Diniyah merupakan program unggulan SMA Islam Parlaungan. Program ini dilaksanakan setiap pagi sebelum siswa siswi memulai pembelajaran. Program Diniyah merupakan bagian dari kegiatan belajar mengajar di SMA Islam Parlaungan yang telah terintegrasi dengan kurikulum sebagai muatan lokal. Pada program ini siswa siswi SMA Islam Parlaungan akan belajar mengaji sesuai dengan tingkat kemampuannya masing masing. </p>
                    <p>Tingkat pertama yakni kelas dasar untuk siswa siswi yang belum bisa membaca Al Quran. Pada tingkat ini siswa siswi akan belajar tilawati. Tingkat kedua atau reguler yakni siswa siswi yang sudah bisa membaca Al Quran dengan lancar. Pada tingkat ini siswa siswi akan mempelajari tajwid atau hukum bacaan pada Al Quran. Kemudian tingkat terakhir atau akselerasi yakni siswa siswi yang telah mahir. Pada tingkat ini siswa siswi akan diterjunkan untuk mengajar teman sebayanya dan bahkan diturunkan untuk mengajar di TPQ.</p>
                </div>
            </div>
            <div class="row text-center text-md-left">
                <div class="col-md-3">
                    <img src="./steller/imgs/berkarak.svg" alt="" class="img-thumbnail mb-4">
                </div>
                <div class="pl-md-4 col-md-9">
                    <h6 class="title">Karya Tulis Ilmiah</h6>
                    <p class="subtitle">Tentang Kami</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Provident, pariatur, aperiam aut autem voluptas odit. Odio ducimus delectus totam sed aliquam sequi praesentium mollitia, illum repudiandae quidem quod, magni magnam.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim, eius, nam. Quo praesentium qui temporibus voluptatum, facilis aliquid eligendi fugiat beatae neque inventore non. Laborum repellendus consequatur ullam voluptatum asperiores.</p>
                </div>
            </div>
            <div class="row text-center text-md-left">
                <div class="col-md-3">
                    <img src="./steller/imgs/berakhlak.svg" alt="" class="img-thumbnail mb-4">
                </div>
                <div class="pl-md-4 col-md-9">
                    <h6 class="title">Enterpreneur</h6>
                    <p class="subtitle">Tentang Kami</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Provident, pariatur, aperiam aut autem voluptas odit. Odio ducimus delectus totam sed aliquam sequi praesentium mollitia, illum repudiandae quidem quod, magni magnam.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim, eius, nam. Quo praesentium qui temporibus voluptatum, facilis aliquid eligendi fugiat beatae neque inventore non. Laborum repellendus consequatur ullam voluptatum asperiores.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Service section -->
    <section id="service" class="section">
        <div class="container text-center">
            <h6 class="section-title mb-4">Filosofi</h6>
            <p class="mb-5 pb-4">Berkarya, Berkarakter, Berakhlakhul Karimah</p>

            <div class="row justify-content-center">
                <!-- <div class="col-sm-6 col-md-3 mb-4">
                    <div class="custom-card card border">
                        <div class="card-body">
                            <i class="icon ti-crown"></i>
                            <h5>UI/UX Design</h5>
                        </div>
                    </div>
                </div> -->
                <div class="col-sm-6 col-md-3 mb-4">
                    <div class="custom-card card border">
                        <div class="card-body">
                            <i class="icon ti-wand"></i>
                            <h5>Berkarya</h5>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3 mb-4">
                    <div class="custom-card card border">
                        <div class="card-body">
                            <i class="icon ti-face-smile"></i>
                            <h5>Berkarakter</h5>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3 mb-4">
                    <div class="custom-card card border">
                        <div class="card-body">
                            <i class="icon ti-book"></i>
                            <h5>Berakhlakhul Karimah</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End of Sectoin -->

    <!-- Skills section -->
    <!-- <section class="section">
        <div class="container text-center">
            <h6 class="section-title mb-4">Why Choose me</h6>
            <p class="mb-5 pb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. In alias dignissimos. <br> rerum commodi corrupti, temporibus non quam.</p>

            <div class="row text-left">
                <div class="col-sm-6">
                    <h6 class="mb-3">Photoshop</h6>
                    <div class="progress">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 89%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><span>89%</span></div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <h6 class="mb-3">Web Design</h6>
                    <div class="progress">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 83%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><span>83%</span></div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <h6 class="mb-3">App Design</h6>
                    <div class="progress">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 95%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><span>95%</span></div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <h6 class="mb-3">SEO</h6>
                    <div class="progress">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 90%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><span>90%</span></div>
                    </div>
                </div>
            </div>  
        </div>
    </section> -->
    <!-- End of Skills sections -->

    <!-- Portfolio section -->
    <section id="portfolio" class="section">
        <div class="container text-center">
            <h6 class="section-title mb-4">Galeri</h6>
            <p class="mb-5 pb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. In alias dignissimos. <br> rerum commodi corrupti, temporibus non quam.</p>

            <div class="row">
                <div class="col-sm-4">
                    <div class="img-wrapper">
                        <img src="./steller/imgs/folio-1.jpg" alt="">
                        <div class="overlay">
                            <div class="overlay-infos">
                                <h5>Project Title</h5>
                                <a href="javascript:void(0)"><i class="ti-zoom-in"></i></a>
                                <a href="javascript:void(0)"><i class="ti-link"></i></a>
                            </div>  
                        </div>
                    </div>
                    <div class="img-wrapper">
                        <img src="./steller/imgs/folio-2.jpg" alt="">
                        <div class="overlay">
                            <div class="overlay-infos">
                                <h5>Project Title</h5>
                                <a href="javascript:void(0)"><i class="ti-zoom-in"></i></a>
                                <a href="javascript:void(0)"><i class="ti-link"></i></a>
                            </div>                              
                        </div>
                    </div>                  
                </div>
                <div class="col-sm-4">
                    <div class="img-wrapper">
                        <img src="./steller/imgs/folio-3.jpg" alt="">
                        <div class="overlay">
                            <div class="overlay-infos">
                                <h5>Project Title</h5>
                                <a href="javascript:void(0)"><i class="ti-zoom-in"></i></a>
                                <a href="javascript:void(0)"><i class="ti-link"></i></a>
                            </div>  
                        </div>
                    </div>
                    <div class="img-wrapper">
                        <img src="./steller/imgs/folio-4.jpg" alt="">
                        <div class="overlay">
                            <div class="overlay-infos">
                                <h5>Project Title</h5>
                                <a href="javascript:void(0)"><i class="ti-zoom-in"></i></a>
                                <a href="javascript:void(0)"><i class="ti-link"></i></a>
                            </div>                              
                        </div>
                    </div>                  
                </div>
                <div class="col-sm-4">
                    <div class="img-wrapper">
                        <img src="./steller/imgs/folio-5.jpg" alt="">
                        <div class="overlay">
                            <div class="overlay-infos">
                                <h5>Project Title</h5>
                                <a href="javascript:void(0)"><i class="ti-zoom-in"></i></a>
                                <a href="javascript:void(0)"><i class="ti-link"></i></a>
                            </div>  
                        </div>
                    </div>
                    <div class="img-wrapper">
                        <img src="./steller/imgs/folio-6.jpg" alt="">
                        <div class="overlay">
                            <div class="overlay-infos">
                                <h5>Project Title</h5>
                                <a href="javascript:void(0)"><i class="ti-zoom-in"></i></a>
                                <a href="javascript:void(0)"><i class="ti-link"></i></a>
                            </div>                              
                        </div>
                    </div>                  
                </div>
            </div>

        </div>
    </section>
    <!-- End of portfolio section -->

    <!-- Testmonial Section -->
    <section id="testmonial" class="section">
        <div class="container text-center">
            <h6 class="section-title mb-4">Apa Kata Orang Tentang Kami?</h6>
            <p class="mb-5 pb-4">Testimoni, SMA Islam Parlaungan</p>


            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="card testmonial-card border">
                            <div class="card-body">
                                <img src="./steller/imgs/avatar-1.jpg" alt="">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam nostrum voluptates in enim vel amet?</p>
                                <h1 class="title">Emma Re</h1>
                                <h1 class="subtitle">Graphic Designer</h1>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="card testmonial-card border">
                            <div class="card-body">
                                <img src="./steller/imgs/avatar-2.jpg" alt="">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam nostrum voluptates in enim vel amet?</p>
                                <h1 class="title">James Bert</h1>
                                <h1 class="subtitle">Web Designer</h1>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="card testmonial-card border">
                            <div class="card-body">
                                <img src="./steller/imgs/avatar-3.jpg" alt="">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam nostrum voluptates in enim vel amet?</p>
                                <h1 class="title">Michael Abra</h1>
                                <h1 class="subtitle">Web Developer</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End of testmonial section -->

    <!-- Blog Section -->
    <section id="blog" class="section">
        <div class="container text-center">
            <h6 class="section-title mb-4">Parlaungan Update</h6>
            <p class="mb-5 pb-4">Update berita tentang SMA Islam Parlaungan</p>

            <div class="row text-left">
                <div class="col-md-4">
                    <div class="card border mb-4">
                        <img src="./steller/imgs/blog-1.jpg" alt="" class="card-img-top w-100">
                        <div class="card-body">
                            <h5 class="card-title">Designe for Everyone</h5>
                            <div class="post-details">
                                <a href="javascript:void(0)">Posted By: Admin</a>
                                <a href="javascript:void(0)"><i class="ti-thumb-up"></i> 456</a>
                                <a href="javascript:void(0)"><i class="ti-comment"></i> 123</a>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut ad vel dolorum, iusto velit, minima? Voluptas nemo harum impedit nisi.</p>
                            <a href="javascript:void(0)">Read More..</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border mb-4">
                        <img src="./steller/imgs/blog-2.jpg" alt="" class="card-img-top w-100">
                        <div class="card-body">
                            <h5 class="card-title">Web Layouts</h5>
                            <div class="post-details">
                                <a href="javascript:void(0)">Posted By: Admin</a>
                                <a href="javascript:void(0)"><i class="ti-thumb-up"></i> 456</a>
                                <a href="javascript:void(0)"><i class="ti-comment"></i> 123</a>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut ad vel dolorum, iusto velit, minima? Voluptas nemo harum impedit nisi.</p>
                            <a href="javascript:void(0)">Read More..</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border mb-4">
                        <img src="./steller/imgs/blog-3.jpg" alt="" class="card-img-top w-100">
                        <div class="card-body">
                            <h5 class="card-title">Bootstrap Framework</h5>
                            <div class="post-details">
                                <a href="javascript:void(0)">Posted By: Admin</a>
                                <a href="javascript:void(0)"><i class="ti-thumb-up"></i> 456</a>
                                <a href="javascript:void(0)"><i class="ti-comment"></i> 123</a>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut ad vel dolorum, iusto velit, minima? Voluptas nemo harum impedit nisi.</p>
                            <a href="javascript:void(0)">Read More..</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Hire me section -->
    <section class="bg-gray p-0 section">
        <div class="container">
            <div class="card bg-primary">
                <div class="card-body text-light">
                    <div class="row align-items-center">
                        <div class="col-sm-9 text-center text-sm-left">
                            <h5 class="mt-3">Join with us!</h5>
                            <p class="mb-3">Mari bergabung dan berkarya bersama SMA Islam Parlaungan</p>
                        </div>
                        <div class="col-sm-3 text-center text-sm-right">
                            <button class="btn btn-light rounded">PPDB</button>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </section>      
    <!-- End od Hire me section. -->

    <!-- Contact Section -->
    <section id="contact" class="position-relative section">
        <div class="container text-center">
            <h6 class="section-title mb-4">Kontak Kami</h6>
            <p class="mb-5 pb-4">Tinggalkan pesan!<br> Kirimkan kritik dan saran kepada kami pada form di bawah ini</p>

            <div class="contact text-left">
                <div class="form">
                    <h6 class="subtitle">Available 24/7</h6>
                    <h6 class="section-title mb-4">Kirim Pesan</h6>
                    <form action="/saran" method="post">
                        <div class="form-group">
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
                        </div>
                        <div class="form-group">
                            <textarea name="contact-message" id="" cols="30" rows="5" class="form-control" placeholder="Message"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block rounded w-lg">Send Message</button>
                    </form>
                </div>
                <div class="contact-infos">
                    <div class="item">
                        <i class="ti-location-pin"></i>
                        <div class="">
                            <h5>Alamat</h5>
                            <p>Jl. Berbek I No. 2 - 4 Waru 61256 Sidoarjo</p>
                        </div>                          
                    </div>
                    <div class="item">
                        <i class="ti-mobile"></i>
                        <div>
                            <h5>Telp</h5>
                            <p>031 8668298</p>
                        </div>                          
                    </div>
                    <div class="item">
                        <i class="ti-email"></i>
                        <div class="mb-0">
                            <h5>Email</h5>
                            <p>admin@smaispa.sch.id</p>
                        </div>
                    </div>
                </div>                  
            </div>
        </div>  
        <div id="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.0449583563723!2d112.75798391477532!3d-7.348848594696815!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fb2f27eae595%3A0x355fe4fdf318c115!2sSMP-SMA%20Islam%20Parlaungan!5e0!3m2!1sid!2sid!4v1676137180758!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>      
    </section>
    <!-- End of Contact Section -->

    <!-- Page Footer -->
    <footer class="page-footer">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <p>Copyright <script>document.write(new Date().getFullYear())</script> &copy; <a href="https://developer.smaispa.sch.id" target="_blank">Staf Data Informasi Pengembangan dan Infrastruktur Teknologi - SMA Islam Parlaungan</a></p>
                </div>
                <div class="col-sm-6">
                    <div class="socials">
                        <a class="social-item" href="https://instagram.com/officialsmaispa"><i class="ti-instagram"></i></a>
                        <a class="social-item" href="https://www.youtube.com/@officialsmaislamparlaungan3823"><i class="ti-youtube"></i></a>
                        <a class="social-item" href="https://www.facebook.com/profile.php?id=100087308974868"><i class="ti-facebook"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer> 
    <!-- End of page footer -->
	
	<!-- core  -->
    <script src="./steller/vendors/jquery/jquery-3.4.1.js"></script>
    <script src="./steller/vendors/bootstrap/bootstrap.bundle.js"></script>
    
    <!-- bootstrap 3 affix -->
	<script src="./steller/vendors/bootstrap/bootstrap.affix.js"></script>

    <!-- steller js -->
    <script src="./steller/js/steller.js"></script>

    <!-- UIkit JS -->
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.15.24/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.15.24/dist/js/uikit-icons.min.js"></script>

    <script>
        const modalLogin = document.getElementById('modalLogin')
        
        const closeNav = () => {
            togglerNav.click()
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
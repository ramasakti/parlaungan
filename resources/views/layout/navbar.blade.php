    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand me-5 text-decoration-none" href="#">SMA Islam Parlaungan</a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ ($title === 'Home | SMA Islam Parlaungan') ? 'active' : '' }} text-decoration-none" aria-current="page" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ ($title === 'Galeri | SMA Islam Parlaungan') ? 'active' : '' }} text-decoration-none " href="/galeri">Galeri</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ ($title === 'Blog | SMA Islam Parlaungan') ? 'active' : '' }} text-decoration-none " href="/blog">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ ($title === 'About | SMA Islam Parlaungan') ? 'active' : '' }} text-decoration-none " href="/about">About</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto mt-0 me-5">    
                    <li class="nav-item">
                        <a class="nav-link {{ ($title === 'Login | SMA Islam Parlaungan') ? 'active' : '' }} text-decoration-none" href="/dashboard">{{ (session()->has('username')) ? session('username') : 'Login' }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

@include('template.header')
<nav id="navbar" class="navbar navbar-expand-lg fixed-top shadow-sm">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center text-white" href="#">
            <img src="{{ asset('storage/assets/logo-jateng.png') }}" alt="Logo Pemerintah">
            <div class="ms-3">
                <h6 class="mb-0">Portal Resmi Pemerintah</h6>
                <p class="mb-0">Monitoring dan Evaluasi Program Bantuan Sosial</p>
            </div>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link text-white" href="#about">Tentang</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#services">Layanan</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link text-white dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Laporan
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('reports.input') }}">Input Laporan</a></li>
                        <li><a class="dropdown-item" href="{{ route('reports.show') }}">Tampilkan Laporan</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white" href="#contact">Kontak</a>
                </li>
                <li class="nav-item">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger nav-link text-white border-0">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
<main>

    <section id="about">
        <div>
            <h1 class="mb-4">Tentang Kami</h1>
            <h6>Portal ini merupakan sumber informasi resmi pemerintah yang menyediakan berita terkini mengenai bantuan
                sosial seperti <br> Monitoring dan Evaluasi Program Bantuan Sosial.</h6>
        </div>
    </section>


    <section id="services" class="py-5 bg-light">
        <div class="container text-center">
            <h2 class="mb-4">Layanan Kami</h2>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <img src="{{ asset('storage/assets/layananadmin.jpeg') }}" alt="Layanan 1" class="img-fluid mb-2">
                    <h4>Layanan Administrasi</h4>
                    <p>Pengurusan dokumen resmi secara online.</p>
                </div>
                <div class="col-md-4 mb-3">
                    <img src="{{ asset('storage/assets/informasi.jpeg') }}" alt="Layanan 2" class="img-fluid mb-2">
                    <h4>Informasi Publik</h4>
                    <p>Akses informasi terkait program pemerintah.</p>
                </div>
                <div class="col-md-4 mb-3">
                    <img src="{{ asset('storage/assets/bantuan.jpeg') }}" alt="Layanan 3" class="img-fluid mb-2">
                    <h4>Pusat Bantuan</h4>
                    <p>Layanan pengaduan dan bantuan masyarakat.</p>
                </div>
            </div>
        </div>
    </section>
    <section id="contact" class="py-5 bg-light">
        <div class="container text-center">
            <h2 class="mb-4">Kontak Kami</h2>
            <p>Hubungi kami melalui saluran resmi di bawah ini:</p>
            <ul class="list-unstyled">
                <li>Email: info@pemerintah.go.id</li>
                <li>Telepon: (021) 12345678</li>
                <li>Alamat: Jl. Merdeka No.1, Jakarta</li>
            </ul>
        </div>
    </section>
</main>
@include('template.footer')

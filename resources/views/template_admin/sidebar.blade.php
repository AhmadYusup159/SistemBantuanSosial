<div class="container-fluid">
    <div class="row">
        <nav class="col-md-3 col-lg-2 bg-light sidebar py-4">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ url('/admin/dashboard') }}">Data Laporan</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="statistikDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Statistik
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="statistikDropdown">
                        <li><a class="dropdown-item" href="{{ url('/admin/statistikpelaporan') }}">Pelaporan</a></li>
                        <li><a class="dropdown-item" href="{{ url('/admin/statistikpenerima') }}">Penerima</a></li>
                        <li><a class="dropdown-item" href="{{ url('/admin/statistikpenyaluran') }}">Penyaluran</a></li>
                    </ul>
                </li>
            </ul>
        </nav>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid m-2">
        <a class="navbar-brand" href="#">Apotek</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a id="keluhanPasien" class="nav-link" href="#">Keluhan Pasien</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./dokter.php">Dokter</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Pegawai
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a id="daftarPegawai" class="dropdown-item" href="../page/pegawai.php">Daftar Pegawai</a></li>
                        <li><a id="daftarUser" class="dropdown-item" href="#">Daftar User</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Pembelian
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a id="daftarPembelianOffline" class="dropdown-item" href="../page/pembelianOffline.php">Pembelian Offline</a></li>
                        <li><a id="daftarPembelianOnline" class="dropdown-item" href="../page/pembelianOnline.php">Pembellian Online</a></li>
                        <li><a id="daftarDelivery" class="dropdown-item" href="#">Delivery</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a id="fakturPmbelianOffline" class="dropdown-item" href="../page/fakturPembelianOffline.php">Faktur Pembelian Offline</a></li>
                        <li><a id="fakturPembelianOnline" class="dropdown-item" href="">Faktur Pembelian Online</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Produk di Jual
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a href="./product.php" id="daftarProduk" class="dropdown-item">Produk</a></li>
                        <li><a href ="./supplier.php" id="daftarSupplier" class="dropdown-item" href="#">Supplier</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a id="fakturSupplier" class="dropdown-item" href="#">Faktur Supplier</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
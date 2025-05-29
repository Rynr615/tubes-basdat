<?php
require_once '../db/config.php';
require_once '../function/func_pembelianOnline.php';

$produkList = getAllProduk();
$userList = getAllUser();
$pegawaiList = getKurir();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'insertPembelianOnline') {
    $idUser   = $_POST['idUser']; 
    $tglPembelian = $_POST['tglPembelian'];
    $jenisPembayaran = $_POST['jenisPembayaran'];
    $idPegawai = $_POST['IDbagian'];
    $kodeProdukArr = $_POST['kodeProduk'];
    $jumlahArr = $_POST['jumlahProduk'];

    if (insertPembelianOnline($conn, $idUser, $idPegawai, $tglPembelian, $jenisPembayaran, $kodeProdukArr, $jumlahArr)) {
        echo "<script>alert('Transaksi berhasil ditambahkan!'); window.location.href = './pembelianOnline.php';</script>";
        exit;
    } else {
        echo "<script>alert('Terjadi kesalahan saat menambahkan transaksi.');</script>";
    }
}

?>

<?php include '../layouts/header.php'; ?>
<?php include '../layouts/navbar.php'; ?>

<div class="container mt-2 p-5 w-50">
    <h2>Tambah Transaksi Pembelian Online</h2>
    <form method="POST">
        <input type="hidden" name="action" value="insertPembelianOnline">

        <div class="mb-3">
            <label for="idUser">ID User</label>
            <select name="idUser" class="form-control" required>
                <option value="">-- Pilih User --</option>
                <?php foreach ($userList as $user): ?>
                    <option value="<?= $user['ID_User'] ?>">
                        <?= $user['ID_User'] ?> - <?= $user['Username'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div class="mb-3">
            <label for="kurir">Kurir</label>
            <select name="IDbagian" class="form-control" required>
                <option value="">-- Pilih Kurir --</option>
                <?php foreach ($pegawaiList as $pegawai): ?>
                    <option value="<?= $pegawai['idPegawai'] ?>">
                        <?= $pegawai['IDbagian'] ?> - <?= $pegawai['nama'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="tglPembelian">Tanggal Pembelian</label>
            <input type="date" class="form-control" name="tglPembelian" required>
        </div>

        <div class="mb-3">
            <label for="jenisPembayaran">Jenis Pembayaran</label>
            <select class="form-control" name="jenisPembayaran" required>
                <option value="">-- Pilih Jenis Pembayaran --</option>
                <option value="Transfer Bank">Transfer Bank</option>
                <option value="E-Wallet">E-Wallet</option>
                <option value="COD">Cash on Delivery</option>
            </select>
        </div>

        <hr>
        <h5>Produk yang Dibeli</h5>
        <div id="produkContainer">
            <div class="produkItem row mb-3">
                <div class="col-md-6">
                    <select name="kodeProduk[]" class="form-control" required>
                        <option value="">-- Pilih Produk --</option>
                        <?php foreach ($produkList as $produk): ?>
                            <option value="<?= $produk['KodeProduk'] ?>">
                                <?= $produk['KodeProduk'] ?> - <?= $produk['Nama'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <input type="number" name="jumlahProduk[]" class="form-control" placeholder="Jumlah" required>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-danger btnRemove">-</button>
                </div>
            </div>
        </div>

        <button type="button" class="btn btn-secondary" id="btnAddProduk">+ Tambah Produk</button>

        <div class="mt-4">
            <button type="submit" class="btn btn-success">Simpan Transaksi</button>
        </div>
    </form>
</div>

<script>
document.getElementById('btnAddProduk').addEventListener('click', function () {
    const container = document.getElementById('produkContainer');
    const newItem = container.children[0].cloneNode(true);
    newItem.querySelector('input').value = '';
    newItem.querySelector('select').selectedIndex = 0;
    container.appendChild(newItem);
});

document.addEventListener('click', function (e) {
    if (e.target.classList.contains('btnRemove') && document.querySelectorAll('.produkItem').length > 1) {
        e.target.closest('.produkItem').remove();
    }
});
</script>

<?php include '../layouts/footer.php'; ?>

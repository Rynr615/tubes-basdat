<?php
require_once '../db/config.php';
require_once '../function/func_pembelianOffline.php';

// Ambil data produk & pegawai untuk pilihan
$produkList = getAllProduk();
$pegawaiList = getAllPegawai();
?>

<?php include '../layouts/header.php'; ?>
<?php include '../layouts/navbar.php'; ?>

<div class="container mt-2 p-5 w-50">
    <h2>Tambah Transaksi Pembelian Offline</h2>

    <form action="../function/func_pembelianOffline.php" method="POST">
        <input type="hidden" name="action" value="insertPembelian">

        <!-- Data Header -->
        <div class="mb-3">
            <label for="idPegawai">ID Pegawai</label>
            <select class="form-control" name="idPegawai" required>
                <option value="">-- Pilih Pegawai --</option>
                <?php foreach ($pegawaiList as $pegawai): ?>
                    <option value="<?= $pegawai['idPegawai'] ?>">
                        <?= $pegawai['idPegawai'] ?> - <?= $pegawai['nama'] ?>
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
                <option value="">-- Pilih Jenis --</option>
                <option value="Cash">Cash</option>
                <option value="QRIS">QRIS</option>
                <option value="Debit">Debit</option>
            </select>
        </div>

        <hr>
        <h4>Produk yang Dibeli</h4>

        <div id="produkContainer">
            <div class="produkItem row mb-3">
                <div class="col-md-5">
                    <select class="form-control" name="kodeProduk[]" required>
                        <option value="">-- Pilih Produk --</option>
                        <?php foreach ($produkList as $produk): ?>
                            <option value="<?= $produk['KodeProduk'] ?>">
                                <?= $produk['KodeProduk'] ?> - <?= $produk['Nama'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="number" class="form-control" name="jumlahProduk[]" placeholder="Jumlah" required>
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

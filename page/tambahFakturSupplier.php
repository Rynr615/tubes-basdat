<?php
require_once '../db/config.php';
require_once '../function/func_fakturSupplier.php';

$suppliers = getAllSupplier();
$produkList = getAllProduk();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'insertFaktur') {
    $kodeSupplier = $_POST['kodeSupplier'];
    $tanggal = $_POST['tanggal'];
    $produkArr = $_POST['kodeProduk'];
    $totalPembayaran = 0;
    $detailData = [];

    if (!produkSesuaiSupplier($conn, $kodeSupplier, $produkArr)) {
        echo "<script>alert('Produk yang dipilih tidak sesuai dengan supplier!'); window.location.href = 'tambahFakturSupplier.php';</script>";
        exit;
    }


    $result = getDetailProdukFromKode($conn, $produkArr);
    $totalPembayaran = $result['total'];
    $detailData = $result['detail'];
    
    simpanFakturSupplier($conn, $kodeSupplier, $tanggal, $totalPembayaran, $detailData);
}
?>

<?php include '../layouts/header.php'; ?>
<?php include '../layouts/navbar.php'; ?>

<div class="container mt-2 p-5 w-50">
    <h2>Tambah Faktur Supplier</h2>
    <form method="POST">
        <input type="hidden" name="action" value="insertFaktur">

        <div class="mb-3">
            <label for="kodeSupplier">Supplier</label>
            <select name="kodeSupplier" class="form-control" required>
                <option value="">-- Pilih Supplier --</option>
                <?php foreach ($suppliers as $supplier): ?>
                <option value="<?= $supplier['KodeSupplier'] ?>">
                    <?= $supplier['KodeSupplier'] ?> - <?= $supplier['Nama'] ?>
                </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="tanggal">Tanggal</label>
            <input type="date" class="form-control" name="tanggal" required>
        </div>

        <hr>
        <h5>Produk</h5>
        <div id="produkContainer">
            <div class="row produkItem mb-2">
                <div class="col-md-10">
                    <select name="kodeProduk[]" class="form-control" required>
                        <option value="">-- Pilih Produk --</option>
                        <?php foreach ($produkList as $produk): ?>
                        <option value="<?= $produk['KodeProduk'] ?>">
                            <?= $produk['KodeSupplier'] ?> - <?= $produk['KodeProduk'] ?> - <?= $produk['Nama'] ?> -
                            Rp<?= number_format($produk['Harga'], 0, ',', '.') ?> - Stok: <?= $produk['Stok'] ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-danger btnRemove">-</button>
                </div>
            </div>
        </div>


        <button type="button" class="btn btn-secondary" id="btnAddProduk">+ Tambah Produk</button>

        <div class="mt-4">
            <button type="submit" class="btn btn-success">Simpan Faktur</button>
        </div>
    </form>
</div>

<script>
document.getElementById('btnAddProduk').addEventListener('click', function() {
    const container = document.getElementById('produkContainer');
    const newItem = container.children[0].cloneNode(true);
    newItem.querySelector('select').selectedIndex = 0;
    container.appendChild(newItem);
});

document.addEventListener('click', function(e) {
    if (e.target.classList.contains('btnRemove') && document.querySelectorAll('.produkItem').length > 1) {
        e.target.closest('.produkItem').remove();
    }
});
</script>

<?php include '../layouts/footer.php'; ?>
<?php
include_once '../function/func_produk.php';
$produkList = showDataProduk();
$supplierList = showSupplier();
?>

<?php require_once("../db/config.php"); ?>

<?php include '../layouts/header.php' ?>
<?php include '../layouts/navbar.php' ?>

<div class="container mt-2 p-5 w-50">
    <div class="d-flex flex-row justify-content-between mt-5">
        <h2>Tambah Produk</h2>
    </div>
    <form action="../function/func_produk.php" method="POST">
        <input type="hidden" name="action" value="insert">

        <div class="mb-3">
            <!-- namaProduk -->
            <label for="namaProduk" class="form-label">Nama Produk</label>
            <input type="text" class="form-control" name="namaProduk" placeholder="Masukkan nama produk...">

            <!-- Jenis -->
            <label for="jenis" class="form-label">Jenis Produk</label>
            <select name="jenis" class="form-control" required>
                <option value="">-- Pilih Jenis Produk --</option>
                <option value="BHP">BHP</option>
                <option value="Obat">Obat</option>
            </select>


            <!-- Harga -->
            <label for="harga" class="form-label">Harga Produk</label>
            <input type="text" class="form-control" name="harga" placeholder="Masukkan harga...">

            <!-- Fungsi -->
            <label for="fungsi" class="form-label">Fungsi Produk</label>
            <input type="text" class="form-control" name="fungsi" placeholder="Masukkan fungsi...">

            <!-- Stok -->
            <label for="stok" class="form-label">Stok Produk</label>
            <input type="text" class="form-control" name="stok" placeholder="Masukkan stok...">

            <!-- Expired -->
            <label for="expired" class="form-label">Expired</label>
            <input type="date" class="form-control" name="expired" placeholder="Masukkan expired...">

            <!-- KodeSupplier -->
            <label for="kurir">Kode Supplier</label>
            <select name="kodeSupplier" class="form-control" required>
                <option value="">-- Pilih Supplier --</option>
                <?php foreach ($supplierList as $supplier): ?>
                    <option value="<?= $supplier['KodeSupplier'] ?>">
                        <?= $supplier['KodeSupplier'] ?> - <?= $supplier['Nama'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <button class="btn btn-primary" type="submit">Simpan Data</button>
        </div>
    </form>
</div>

<?php include '../layouts/footer.php' ?>
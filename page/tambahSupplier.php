<?php
include_once '../function/func_supplier.php';
?>

<?php require_once("../db/config.php"); ?>

<?php include '../layouts/header.php' ?>
<?php include '../layouts/navbar.php' ?>

<div class="container mt-2 p-5 w-50">
    <div class="d-flex flex-row justify-content-between mt-5">
        <h2>Tambah Supplier</h2>
    </div>
    <form action="../function/func_supplier.php" method="POST">
        <input type="hidden" name="action" value="insert">

        <div class="mb-3">
            <!-- Kode Supplier -->
            <label for="kodeSupplier" class="form-label">Kode Supplier</label>
            <input type="text" class="form-control" name="kodeSupplier" placeholder="Masukkan kode supplier..." required>

            <!-- Nama Supplier -->
            <label for="namaSupplier" class="form-label">Nama Supplier</label>
            <input type="text" class="form-control" name="namaSupplier" placeholder="Masukkan nama supplier..." required>

            <!-- No HP -->
            <label for="NoHP" class="form-label">No HP</label>
            <input type="text" class="form-control" name="NoHP" placeholder="Masukkan nomor HP..." required>

            <!-- Alamat -->
            <label for="Alamat" class="form-label">Alamat</label>
            <textarea class="form-control" name="Alamat" rows="3" placeholder="Masukkan alamat..." required></textarea>
        </div>

        <div class="mb-3">
            <button class="btn btn-primary" type="submit">Simpan Data</button>
        </div>
    </form>
</div>


<?php include '../layouts/footer.php' ?>
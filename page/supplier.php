<?php
include_once '../function/func_supplier.php';
$suppliers = showDataSupplier();
?>

<?php require_once("../db/config.php"); ?>

<?php include '../layouts/header.php' ?>
<?php include '../layouts/navbar.php' ?>

<div class="container">
    <div class="d-flex flex-row justify-content-between mt-5">
        <h2>Daftar Supplier</h2>
        <a href="tambahSupplier.php" class="btn btn-primary p-2">Tambah Data</a>
    </div>
    <table class="table table-striped table-hover mt-1">
        <thead>
            <tr class="table-secondary">
                <th scope="col">Kode Supplier</th>
                <th scope="col">Nama Supplier</th>
                <th scope="col">NoHp</th>
                <th scope="col">Alamat</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($suppliers)): ?>
            <?php foreach ($suppliers as $index => $supplier): ?>
            <tr>
                <td><?= htmlspecialchars($supplier['KodeSupplier']) ?></td>
                <td><?= htmlspecialchars($supplier['Nama']) ?></td>
                <td><?= htmlspecialchars($supplier['NoHP']) ?></td>
                <td><?= htmlspecialchars($supplier['Alamat']) ?></td>
                <td>
                    <a href="./editSupplier.php?KodeSupplier=<?= $supplier['KodeSupplier'] ?>" class="btn btn-warning">Edit</a>
                    <a href="./hapusSupplier.php?action=delete&KodeSupplier=<?= $supplier['KodeSupplier'] ?>" onclick="return confirm('Yakin ingin menghapus data ini?')" class="btn btn-danger">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php else: ?>
            <tr>
                <td colspan="9">Tidak ada data</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include '../layouts/footer.php' ?>
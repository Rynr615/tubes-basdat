<?php
include_once '../function/func_produk.php';
$produkList = showDataProduk();
?>

<?php require_once("../db/config.php"); ?>

<?php include '../layouts/header.php' ?>
<?php include '../layouts/navbar.php' ?>

<div class="container">
    <div class="d-flex flex-row justify-content-between mt-5">
        <h2>Daftar Produk</h2>
        <a href="tambahProduk.php" class="btn btn-primary p-2">Tambah Data</a>
    </div>
    <table class="table table-striped table-hover mt-1">
        <thead>
            <tr class="table-secondary">
                <th scope="col">Kode Produk</th>
                <th scope="col">Nama Produk</th>
                <th scope="col">Jenis</th>
                <th scope="col">Harga</th>
                <th scope="col">Fungsi</th>
                <th scope="col">Stok</th>
                <th scope="col">Expired</th>
                <th scope="col">Kode Supplier</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($produkList)): ?>
            <?php foreach ($produkList as $index => $produk): ?>
            <tr>
                <td><?= htmlspecialchars($produk['KodeProduk']) ?></td>
                <td><?= htmlspecialchars($produk['Nama']) ?></td>
                <td><?= htmlspecialchars($produk['Jenis']) ?></td>
                <td><?= htmlspecialchars($produk['Harga']) ?></td>
                <td><?= htmlspecialchars($produk['Fungsi']) ?></td>
                <td><?= htmlspecialchars($produk['Stok']) ?></td>
                <td><?= htmlspecialchars($produk['Expired']) ?></td>
                <td><?= htmlspecialchars($produk['KodeSupplier']) ?></td>
                <td>
                    <a href="./editProduk.php?KodeProduk=<?= $produk['KodeProduk'] ?>" class="btn btn-warning">Edit</a>
                    <a href="./hapusProduk.php?action=delete&KodeProduk=<?= $produk['KodeProduk'] ?>" onclick="return confirm('Yakin ingin menghapus data ini?')" class="btn btn-danger">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php else: ?>
            <tr>
                <td colspan="9">Tidak ada data produk</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include '../layouts/footer.php' ?>
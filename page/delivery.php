<?php
include_once '../function/func_delivery.php';
$deliveries = showData();
?>

<?php require_once("../db/config.php"); ?>

<?php include '../layouts/header.php' ?>
<?php include '../layouts/navbar.php' ?>

<div class="container">
    <div class="d-flex flex-row justify-content-between mt-5">
        <h2>Daftar Pengiriman</h2>
    </div>
    <table class="table table-striped table-hover mt-1">
        <thead>
            <tr class="table-secondary">
                <th scope="col">Resi</th>
                <th scope="col">ID Pembelian</th>
                <th scope="col">Username Pembeli</th>
                <th scope="col">Nama Kurir</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($deliveries)): ?>
                <?php foreach ($deliveries as $delivery): ?>
                    <tr>
                        <td><?= htmlspecialchars($delivery['Resi']) ?></td>
                        <td><?= htmlspecialchars($delivery['idPembelian']) ?></td>
                        <td><?= htmlspecialchars($delivery['username_pembeli'] ?? '-') ?></td>
                        <td><?= htmlspecialchars($delivery['nama_kurir'] ?? '-') ?></td>
                        <td>
                            <a href="./detailPembelianOnline.php?idPembelian=<?= $delivery['idPembelian'] ?>" class="btn btn-info btn-sm">Lihat Detail</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">Tidak ada data pengiriman</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include '../layouts/footer.php' ?>
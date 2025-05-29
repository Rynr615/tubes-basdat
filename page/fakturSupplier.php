<?php
include_once '../function/func_fakturSupplier.php';
require_once '../db/config.php';

$fakturList = showFakturSupplier();
?>

<?php include '../layouts/header.php' ?>
<?php include '../layouts/navbar.php' ?>

<div class="container mt-5">
    <div class="d-flex flex-row justify-content-between">
        <h2>Daftar Faktur Supplier</h2>
        <a href="tambahFakturSupplier.php" class="btn btn-primary">Tambah Faktur</a>
    </div>

    <table class="table table-striped table-hover mt-3">
        <thead>
            <tr class="table-secondary">
                <th>No Faktur</th>
                <th>Tanggal</th>
                <th>Kode Supplier</th>
                <th>Total Pembayaran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($fakturList)): ?>
                <?php foreach ($fakturList as $faktur): ?>
                    <tr>
                        <td><?= htmlspecialchars($faktur['NoFaktur']) ?></td>
                        <td><?= htmlspecialchars($faktur['Tanggal']) ?></td>
                        <td><?= htmlspecialchars($faktur['KodeSupplier']) ?></td>
                        <td>Rp <?= number_format($faktur['TotalPembayaran'], 0, ',', '.') ?></td>
                        <td>
                            <a href="detailFakturSupplier.php?NoFaktur=<?= $faktur['NoFaktur'] ?>" class="btn btn-info btn-sm">Lihat Detail</a>
                            <a href="editFakturSupplier.php?NoFaktur=<?= $faktur['NoFaktur'] ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="hapusFakturSupplier.php?NoFaktur=<?= $faktur['NoFaktur'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus faktur ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="5">Tidak ada data faktur supplier.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include '../layouts/footer.php' ?>

<?php
include_once '../function/func_pembelianOffline.php';
$offlineBuys = showDataHeaderPembelianOffline();
?>

<?php include '../layouts/header.php'; ?>
<?php include '../layouts/navbar.php'; ?>

<div class="container">
    <div class="d-flex flex-row justify-content-between mt-5">
        <h2>Daftar Transaksi Pembelian Offline</h2>
        <a href="tambahPembelianOffline.php" class="btn btn-primary p-2">Tambah Data</a>
    </div>

    <table class="table table-striped table-hover mt-3">
        <thead class="table-secondary">
            <tr>
                <th>No Transaksi</th>
                <th>ID Pegawai</th>
                <th>Tanggal Pembelian</th>
                <th>Jenis Pembayaran</th>
                <th>Total Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($offlineBuys)): ?>
                <?php foreach ($offlineBuys as $offline): ?>
                    <tr>
                        <td><?= htmlspecialchars($offline['NoTransaksi']) ?></td>
                        <td><?= htmlspecialchars($offline['idPegawai']) ?></td>
                        <td><?= htmlspecialchars($offline['tglPembelian']) ?></td>
                        <td><?= htmlspecialchars($offline['jenisPembayaran']) ?></td>
                        <td><?= htmlspecialchars($offline['totalHarga']) ?></td>
                        <td>
                            <a href="detailPembelianOffline.php?NoTransaksi=<?= $offline['NoTransaksi'] ?>" class="btn btn-info btn-sm">Lihat Detail</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="6">Tidak ada data transaksi</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include '../layouts/footer.php'; ?>

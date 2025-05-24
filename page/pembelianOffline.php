<?php
include_once '../function/func_pembelianOffline.php';
$offlineBuys = showDataPembelianOffline();
?>

<?php require_once("../db/config.php"); ?>

<?php include '../layouts/header.php' ?>
<?php include '../layouts/navbar.php' ?>

<div class="container">
    <div class="d-flex flex-row justify-content-between mt-5">
        <h2>Daftar Pegawai</h2>
        <a href="tambahPembelianOffline.php" class="btn btn-primary p-2">Tambah Data</a>
    </div>
    <table class="table table-striped table-hover mt-1">
        <thead>
            <tr class="table-secondary">
                <th scope="col">No Transaksi</th>
                <th scope="col">Kode Produk</th>
                <th scope="col">Id Pegawai</th>
                <th scope="col">Jumlah Produk</th>
                <th scope="col">Tanggal Pembelian</th>
                <th scope="col">Jenis Pembayaran</th>
                <th scope="col">Total Harga</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($offlineBuys)): ?>
                <?php foreach ($offlineBuys as $offlineBuy): ?>
                    <tr>
                        <td><?= htmlspecialchars($offlineBuy['NoTransaksi']) ?></td>
                        <td><?= htmlspecialchars($offlineBuy['kodeProduk']) ?></td>
                        <td><?= htmlspecialchars($offlineBuy['idPegawai']) ?></td>
                        <td><?= htmlspecialchars($offlineBuy['jumlahProduk']) ?></td>
                        <td><?= htmlspecialchars($offlineBuy['tglPembelian']) ?></td>
                        <td><?= htmlspecialchars($offlineBuy['jenisPembayaran']) ?></td>
                        <td><?= htmlspecialchars($offlineBuy['totalHarga']) ?></td>
                        <td>
                            <a href="./editPegawai.php?NoTransaksi=<?= $offlineBuy['NoTransaksi'] ?>" class="btn btn-warning">Edit</a>
                            <a href="./hapusPegawai.php?NoTransaksi=<?= $offlineBuy['NoTransaksi'] ?>" class="btn btn-danger" onclick="return confirm('Yakin mau hapus pegawai ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="9">Tidak ada data pegawai</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include '../layouts/footer.php' ?>

<?php
include_once '../function/func_pembelianOnline.php';
$onlineBuys = showDataPembelianOnline();
?>

<?php require_once("../db/config.php"); ?>

<?php include '../layouts/header.php' ?>
<?php include '../layouts/navbar.php' ?>

<div class="container">
    <div class="d-flex flex-row justify-content-between mt-5">
        <h2>Daftar Pembelian Online</h2>
        <a href="tambahPembelianOffline.php" class="btn btn-primary p-2">Tambah Data</a>
    </div>
    <table class="table table-striped table-hover mt-1">
        <thead>
            <tr class="table-secondary">
                <th scope="col">ID Pembelian</th>
                <th scope="col">ID User</th>
                <th scope="col">Kode Produk</th>
                <th scope="col">Tanggal Pembelian</th>
                <th scope="col">Jenis Pembayaran</th>
                <th scope="col">Total Harga</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($onlineBuys)): ?>
                <?php foreach ($onlineBuys as $onlineBuy): ?>
                    <tr>
                        <td><?= htmlspecialchars($onlineBuy['idPembelian']) ?></td>
                        <td><?= htmlspecialchars($onlineBuy['idUser']) ?></td>
                        <td><?= htmlspecialchars($onlineBuy['kodeProduk']) ?></td>
                        <td><?= htmlspecialchars($onlineBuy['tglPembelian']) ?></td>
                        <td><?= htmlspecialchars($onlineBuy['jenisPembayaran']) ?></td>
                        <td><?= htmlspecialchars($onlineBuy['totalHarga']) ?></td>
                        <td>
                            <a href="./editPegawai.php?idPembelian=<?= $onlineBuy['idPembelian'] ?>" class="btn btn-warning">Edit</a>
                            <a href="./hapusPegawai.php?idPembelian=<?= $onlineBuy['idPembelian'] ?>" class="btn btn-danger" onclick="return confirm('Yakin mau hapus pegawai ini?')">Hapus</a>
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

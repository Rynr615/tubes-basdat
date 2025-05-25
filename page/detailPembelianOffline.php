<?php
require_once '../db/config.php';
require_once '../function/func_pembelianOffline.php';

$noTransaksi = $_GET['NoTransaksi'] ?? null;
if (!$noTransaksi) {
    echo "<script>alert('No Transaksi tidak ditemukan!'); window.location.href = 'pembelianOffline.php';</script>";
    exit;
}

$detailList = showDetailPembelianOffline($noTransaksi);
$headerInfo = getInfoHeaderPembelian($noTransaksi);
?>

<?php include '../layouts/header.php'; ?>
<?php include '../layouts/navbar.php'; ?>

<div class="container mt-5">
    <h2>Detail Transaksi No: <?= htmlspecialchars($noTransaksi) ?></h2>
    <p><strong>ID Pegawai:</strong> <?= $headerInfo['idPegawai'] ?></p>
    <p><strong>Tanggal:</strong> <?= $headerInfo['tglPembelian'] ?></p>
    <p><strong>Jenis Pembayaran:</strong> <?= $headerInfo['jenisPembayaran'] ?></p>
    <p><strong>Total Harga:</strong> Rp <?= number_format($headerInfo['totalHarga'], 0, ',', '.') ?></p>

    <h4 class="mt-4">Produk yang Dibeli:</h4>
    <table class="table table-striped mt-2">
        <thead>
            <tr class="table-secondary">
                <th>Kode Produk</th>
                <th>Nama Produk</th>
                <th>Jumlah Produk</th>
                <th>Sub Total</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($detailList)): ?>
                <?php foreach ($detailList as $item): ?>
                    <tr>
                        <td><?= htmlspecialchars($item['kodeProduk']) ?></td>
                        <td><?= htmlspecialchars($item['nama']) ?></td>
                        <td><?= htmlspecialchars($item['jumlahProduk']) ?></td>
                        <td>Rp <?= number_format($item['subTotal'], 0, ',', '.') ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="4">Tidak ada data detail produk.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <a href="pembelianOffline.php" class="btn btn-secondary mt-3">← Kembali ke Daftar Transaksi</a>
</div>

<?php include '../layouts/footer.php'; ?>

<?php
require_once '../db/config.php';
require_once '../function/func_fakturSupplier.php';

$noFaktur = $_GET['NoFaktur'] ?? null;
if (!$noFaktur) {
    echo "<script>alert('No Faktur tidak ditemukan!'); window.location.href = 'fakturSupplier.php';</script>";
    exit;
}

$detailList = showDetailFakturSupplier($noFaktur);
$headerInfo = getInfoHeaderFakturSupplier($noFaktur);
?>

<?php include '../layouts/header.php'; ?>
<?php include '../layouts/navbar.php'; ?>

<div class="container mt-5">
    <h2>Detail Faktur: <?= htmlspecialchars($noFaktur) ?></h2>
    <p><strong>Kode Supplier:</strong> <?= $headerInfo['KodeSupplier'] ?></p>
    <p><strong>Tanggal:</strong> <?= $headerInfo['Tanggal'] ?></p>
    <p><strong>Total Pembayaran:</strong> Rp <?= number_format($headerInfo['TotalPembayaran'], 0, ',', '.') ?></p>

    <h4 class="mt-4">Produk yang Dibeli:</h4>
    <table class="table table-striped mt-2">
        <thead>
            <tr class="table-secondary">
                <th>Kode Produk</th>
                <th>Nama Produk</th>
                <th>Jumlah</th>
                <th>Sub Total</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($detailList)): ?>
                <?php foreach ($detailList as $item): ?>
                    <tr>
                        <td><?= htmlspecialchars($item['KodeProduk']) ?></td>
                        <td><?= htmlspecialchars($item['NamaProduk']) ?></td>
                        <td><?= htmlspecialchars($item['Jumlah']) ?></td>
                        <td>Rp <?= number_format($item['SubTotal'], 0, ',', '.') ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="4">Tidak ada data detail produk.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <a href="fakturSupplier.php" class="btn btn-secondary mt-3">← Kembali ke Daftar Faktur</a>
</div>

<?php include '../layouts/footer.php'; ?>

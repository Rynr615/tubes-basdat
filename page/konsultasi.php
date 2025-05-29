<?php
require_once '../db/config.php';
include_once '../function/func_konsultasi.php';

$datas = showData();
?>

<?php include '../layouts/header.php'; ?>
<?php include '../layouts/navbar.php'; ?>

<div class="container">
    <div class="d-flex flex-row justify-content-between mt-5">
        <h2>Daftar Keluhan Pengguna</h2>
        <a href="tambahKonsultasi.php" class="btn btn-primary p-2">Tambah Data</a>
    </div>
    <table class="table table-striped table-hover mt-1">
        <thead>
            <tr class="table-secondary">
                <th scope="col">No Konsultasi</th>
                <th scope="col">Nama User</th>
                <th scope="col">Nama Dokter</th>
                <th scope="col">Spesialis</th>
                <th scope="col">Keluhan</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($datas)): ?>
                <?php foreach ($datas as $data): ?>
                    <tr>
                        <td><?= htmlspecialchars($data['No_Konsultasi']) ?></td>
                        <td><?= htmlspecialchars($data['NamaUser']) ?></td>
                        <td><?= htmlspecialchars($data['NamaDokter']) ?></td>
                        <td><?= htmlspecialchars($data['Spesialis']) ?></td>
                        <td><?= htmlspecialchars($data['Keluhan_Pasien']) ?></td>
                        <td>
                            <a href="./editKonsultasi.php?No_Konsultasi=<?= $data['No_Konsultasi'] ?>" class="btn btn-warning">Edit</a>
                            <a href="./hapusKonsultasi.php?No_Konsultasi=<?= $data['No_Konsultasi'] ?>" class="btn btn-danger" onclick="return confirm('Yakin mau hapus konsultasi ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">Tidak ada data</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include '../layouts/footer.php'; ?>

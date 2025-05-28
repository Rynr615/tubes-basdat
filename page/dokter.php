<?php
include_once '../function/func_dokter.php';
$datas = showData();
?>

<?php require_once("../db/config.php"); ?>

<?php include '../layouts/header.php' ?>
<?php include '../layouts/navbar.php' ?>

<div class="container">
    <div class="d-flex flex-row justify-content-between mt-5">
        <h2>Daftar Dokter</h2>
        <a href="tambahDokter.php" class="btn btn-primary p-2">Tambah Data</a>
    </div>
    <table class="table table-striped table-hover mt-1">
        <thead>
            <tr class="table-secondary">
                <th scope="col">NIP</th>
                <th scope="col">Nama</th>
                <th scope="col">Jenis Kelamin</th>
                <th scope="col">Spesialis</th>
                <th scope="col">No. Hp</th>
                <th scope="col">Alamat</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($datas)): ?>
                <?php foreach ($datas as $data): ?>
                    <tr>
                        <td><?= htmlspecialchars($data['NIP']) ?></td>
                        <td><?= htmlspecialchars($data['Nama']) ?></td>
                        <td><?= htmlspecialchars($data['JenisKelamin']) ?></td>
                        <td><?= htmlspecialchars($data['Spesialis']) ?></td>
                        <td><?= htmlspecialchars($data['NoHP']) ?></td>
                        <td><?= htmlspecialchars($data['Alamat']) ?></td>
                        <td>
                            <a href="./editDokter.php?NIP=<?= $data['NIP'] ?>" class="btn btn-warning">Edit</a>
                            <a href="./hapusDokter.php?NIP=<?= $data['NIP'] ?>" class="btn btn-danger" onclick="return confirm('Yakin mau hapus pegawai ini?')">Hapus</a>
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
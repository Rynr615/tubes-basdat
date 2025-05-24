<?php
include_once '../function/func_pegawai.php';
$pegawaiList = showDataPegawai();
$detailsBagian = showDetailPegawai();
?>

<?php require_once("../db/config.php"); ?>

<?php include '../layouts/header.php' ?>
<?php include '../layouts/navbar.php' ?>

<div class="container">
    <div class="d-flex flex-row justify-content-between mt-5">
        <h2>Detail Bagian Pegawai</h2>
        <a href="tambahBagian.php" class="btn btn-primary p-2">Tambah Data</a>
    </div>
    <table class="table table-striped table-hover mt-1">
        <thead>
            <tr class="table-secondary">
                <th scope="col">ID Bagian</th>
                <th scope="col">Nama</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($detailsBagian)): ?>
                <?php foreach ($detailsBagian as $detail): ?>
                    <tr>
                        <td><?= htmlspecialchars($detail['ID']) ?></td>
                        <td><?= htmlspecialchars($detail['bagian']) ?></td>
                        <td>
                            <a href="./editBagian.php?ID=<?= $detail['ID'] ?>" class="btn btn-warning">Edit</a>
                            <a href="hapusDetail.php?ID=<?= $detail['ID'] ?>" class="btn btn-danger" onclick="return confirm('Yakin mau hapus bagian ini?')">Hapus</a>
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


<div class="container">
    <div class="d-flex flex-row justify-content-between mt-5">
        <h2>Daftar Pegawai</h2>
        <a href="tambahPegawai.php" class="btn btn-primary p-2">Tambah Data</a>
    </div>
    <table class="table table-striped table-hover mt-1">
        <thead>
            <tr class="table-secondary">
                <th scope="col">ID Pegawai</th>
                <th scope="col">Nama</th>
                <th scope="col">Tanggal Lahir</th>
                <th scope="col">Usia</th>
                <th scope="col">No HP</th>
                <th scope="col">ID Bagian</th>
                <th scope="col">Alamat</th>
                <th scope="col">Jenis Kelamin</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($pegawaiList)): ?>
                <?php foreach ($pegawaiList as $pegawai): ?>
                    <tr>
                        <td><?= htmlspecialchars($pegawai['idPegawai']) ?></td>
                        <td><?= htmlspecialchars($pegawai['nama']) ?></td>
                        <td><?= htmlspecialchars($pegawai['tglLahir']) ?></td>
                        <td><?= htmlspecialchars($pegawai['usia']) ?></td>
                        <td><?= htmlspecialchars($pegawai['noHp']) ?></td>
                        <td><?= htmlspecialchars($pegawai['IDbagian']) ?></td>
                        <td><?= htmlspecialchars($pegawai['alamat']) ?></td>
                        <td><?= htmlspecialchars($pegawai['jenisKelamin']) ?></td>
                        <td>
                            <a href="./editPegawai.php?idPegawai=<?= $pegawai['idPegawai'] ?>" class="btn btn-warning">Edit</a>
                            <a href="./hapusPegawai.php?idPegawai=<?= $pegawai['idPegawai'] ?>" class="btn btn-danger" onclick="return confirm('Yakin mau hapus pegawai ini?')">Hapus</a>
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

<?php
require_once '../db/config.php';
include_once '../function/func_user.php';

$users = showDataUser();
?>

<?php include '../layouts/header.php'; ?>
<?php include '../layouts/navbar.php'; ?>

<div class="container mt-5">
    <div class="d-flex flex-row justify-content-between mt-5">
        <h2>Daftar User</h2>
        <a href="tambahUser.php" class="btn btn-primary p-2">Tambah Data</a>
    </div>
    <table class="table table-striped table-hover mt-2">
        <thead>
            <tr class="table-secondary">
                <th scope="col">No</th>
                <th scope="col">Id User</th>
                <th scope="col">Email</th>
                <th scope="col">Username</th>
                <th scope="col">JenisKelamin</th>
                <th scope="col">Alamat</th>
                <th scope="col">No. Hp</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($users)): ?>
            <?php foreach ($users as $index => $user): ?>
            <tr>
                <th scope="row"><?= $index + 1 ?></th>
                <td><?= htmlspecialchars($user['ID_User']) ?></td>
                <td><?= htmlspecialchars($user['Email']) ?></td>
                <td><?= htmlspecialchars($user['Username']) ?></td>
                <td><?= htmlspecialchars($user['JenisKelamin']) ?></td>
                <td><?= htmlspecialchars($user['Alamat']) ?></td>
                <td><?= htmlspecialchars($user['NoHP']) ?></td>
                <td>
                    <a href="editUser.php?ID_User=<?= $user['ID_User'] ?>" type="button" class="btn btn-warning">Edit</a>
                    <a href="hapusUser.php?ID_User=<?= $user['ID_User'] ?>" type="button" class="btn btn-danger" onclick="return confirm('Yakin mau hapus pegawai ini?')">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php else: ?>
            <tr>
                <td colspan="9">Tidak ada data user</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include '../layouts/footer.php'; ?>
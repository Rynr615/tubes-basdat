<?php
include_once './function/func.php';
$users = showDataUser();
?>

<div class="container mt-5">
    <table class="table table-striped table-hover">
        <thead>
            <tr class="table-secondary">
                <th scope="col">Id User</th>
                <th scope="col">Email</th>
                <th scope="col">Username</th>
                <th scope="col">JenisKelamin</th>
                <th scope="col">Fungsi</th>
                <th scope="col">Stok</th>
                <th scope="col">Expired</th>
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
                <td><?= htmlspecialchars($user['noHP']) ?></td>
                <td>
                    <button type="button" class="btn btn-warning">Edit</button>
                    <button type="button" class="btn btn-danger">Hapus</button>
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
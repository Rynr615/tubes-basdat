<?php
require_once '../db/config.php';
require_once '../function/func_user.php';

// Jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'tambahUser') {
    $idUser = generateUserId();
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $jenisKelamin = $_POST['jenisKelamin'];
    $alamat = $_POST['alamat'];
    $noHp = $_POST['noHp'];

    if (insertUser($conn, $idUser, $email, $username, $password, $jenisKelamin, $alamat, $noHp)) {
        echo "<script>alert('User berhasil ditambahkan!'); window.location.href = './user.php';</script>";
        exit;
    } else {
        echo "<script>alert('Gagal menambahkan user.');</script>";
    }
}

function generateUserId() {
    return str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);
}
?>

<?php include '../layouts/header.php'; ?>
<?php include '../layouts/navbar.php'; ?>

<div class="container mt-2 p-5 w-50">
    <h2>Tambah Data User</h2>
    <form method="POST">
        <input type="hidden" name="action" value="tambahUser">

        <div class="mb-3">
            <label>Email:</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Username:</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Password:</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Jenis Kelamin:</label>
            <select class="form-control" name="jenisKelamin" required>
                <option value="">-- Pilih Jenis Kelamin --</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Alamat:</label>
            <input type="text" name="alamat" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>No. HP:</label>
            <input type="text" name="noHp" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Simpan Data</button>
    </form>
</div>

<?php include '../layouts/footer.php'; ?>

<?php
require_once '../db/config.php';
include_once '../function/func_user.php';

if (!isset($_GET['ID_User'])) {
    echo "ID_User tidak ditemukan.";
    exit;
}

$idUser = $_GET['ID_User'];
$query = "SELECT * FROM user WHERE ID_User = '$idUser'";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    echo "User tidak ditemukan";
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idUser = $_POST['idUser']; // Perbaikan disini
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $jenisKelamin = $_POST['jenisKelamin'];
    $alamat = $_POST['alamat'];
    $noHp = $_POST['noHp'];

    if (updateUser($conn, $idUser, $email, $username, $password, $jenisKelamin, $alamat, $noHp)) {
        echo "<script>alert('Data user berhasil diperbarui!'); window.location.href = './user.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data user.');</script>";
    }
}

?>

<?php include '../layouts/header.php'; ?>
<?php include '../layouts/navbar.php'; ?>
<div class="container mt-2 p-5 w-50">
    <h2>Edit Data User</h2>
    <form method="POST">
        <input type="hidden" name="idUser" value="<?= $data['ID_User'] ?>">

        <div class="mb-3">
            <label>Email:</label>
            <input type="email" name="email" class="form-control" value="<?= $data['Email'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Username:</label>
            <input type="text" name="username" class="form-control" value="<?= $data['Username'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Password:</label>
            <input type="password" name="password" class="form-control" value="<?= $data['Password'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Jenis Kelamin:</label>
            <select class="form-control" name="jenisKelamin" required>
                <option value="Laki-laki" <?= $data['JenisKelamin'] == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki
                </option>
                <option value="Perempuan" <?= $data['JenisKelamin'] == 'Perempuan' ? 'selected' : '' ?>>Perempuan
                </option>
            </select>
        </div>
        <div class="mb-3">
            <label>Alamat:</label>
            <input type="text" name="alamat" class="form-control" value="<?= $data['Alamat'] ?>" required>
        </div>
        <div class="mb-3">
            <label>No. HP:</label>
            <input type="text" name="noHp" class="form-control" value="<?= $data['NoHP'] ?>" required>
        </div>

        <button type="submit" class="btn btn-success">Simpan Data</button>
    </form>
</div>

<?php include '../layouts/footer.php'; ?>
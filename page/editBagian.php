<?php
require_once '../db/config.php';
include_once '../function/func_pegawai.php';

if (isset($_GET['ID'])) {
    $id = $_GET['ID'];
    $bagian = getBagianById($conn, $id);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $namaBagian = $_POST['bagian'];

        if (updateBagian($conn, $id, $namaBagian)) {
            echo "<script>alert('Data bagian berhasil diperbarui!'); window.location.href = './pegawai.php';</script>";
        } else {
            echo "<script>alert('Gagal memperbarui data bagian.');</script>";
        }
    }
} else {
    echo "ID Bagian tidak ditemukan.";
    exit;
}
?>

<?php include '../layouts/header.php'; ?>
<?php include '../layouts/navbar.php'; ?>

<div class="container mt-2 p-5 w-50">
    <h2>Edit Data Bagian</h2>
    <form method="POST">
        <div class="mb-3">
            <label>Nama Bagian:</label>
            <input type="text" name="bagian" class="form-control" value="<?= $bagian['bagian'] ?>" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
    </form>
</div>
<?php include '../layouts/footer.php'; ?>

<?php
include_once '../function/func_pegawai.php';
?>

<?php require_once("../db/config.php"); ?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'tambahBagian') {
    $bagian = $_POST['bagian'];

    $id = generateBagianID($conn);

    if (insertBagian($conn, $id, $bagian)) {
        echo "<script>alert('Bagian berhasil ditambahkan!'); window.location.href = 'pegawai.php';</script>";
        exit;
    } else {
        echo "<script>alert('Gagal menambahkan bagian.');</script>";
    }
}
?>


<?php include '../layouts/header.php' ?>
<?php include '../layouts/navbar.php' ?>

<div class="container mt-2 p-5 w-50">
    <h2>Tambah Bagian</h2>
    <form method="POST">
        <input type="hidden" name="action" value="tambahBagian">
        <div class="mb-3">
            <label>Nama Bagian:</label>
            <input type="text" class="form-control" name="bagian" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan Bagian</button>
    </form>
</div>

<?php include '../layouts/footer.php'; ?>
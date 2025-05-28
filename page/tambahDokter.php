<?php
include_once '../function/func_dokter.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];

    if ($action == 'tambahDokter') {
        $nip = $_POST['nip'];
        $nama = $_POST['nama'];
        $jenisKelamin = $_POST['jenisKelamin'];
        $spesialis = $_POST['spesialis'];
        $noHp = $_POST['noHp'];
        $alamat = $_POST['alamat'];

        if (insertDokter($conn, $nip, $nama, $jenisKelamin, $spesialis, $noHp, $alamat)) {
            echo "<script>alert('Dokter berhasil ditambahkan!'); window.location.href = './dokter.php';</script>";
        } else {
            echo "<script>alert('Gagal menambahkan dokter!');</script>";
        }
    }
}
?>

<?php require_once("../db/config.php"); ?>

<?php include '../layouts/header.php' ?>
<?php include '../layouts/navbar.php' ?>

<div class="container mt-2 p-5 w-50">
    <h2>Tambah Dokter</h2>
    <form method="POST">
        <input type="hidden" name="action" value="tambahDokter">
        <div class="mb-3">
            <label>NIP:</label>
            <input type="text" class="form-control" name="nip" required>

            <label>Nama:</label>
            <input type="text" class="form-control" name="nama" required>

            <label>Jenis Kelamin:</label>
            <select class="form-control" name="jenisKelamin" required>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>

            <label>Spesialis:</label>
            <input type="text" class="form-control" name="spesialis" required>

            <label>No HP:</label>
            <input type="text" class="form-control" name="noHp" required>

            <label>Alamat:</label>
            <textarea class="form-control" name="alamat" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Data</button>
    </form>
</div>

<?php include '../layouts/footer.php'; ?>
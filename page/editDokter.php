<?php
require_once '../db/config.php';
include_once '../function/func_dokter.php';

if (isset($_GET['NIP'])) {
    $nip = $_GET['NIP'];

if(!$nip) {
    echo "NIP tidak ditemukan";
    exit;
}

$query = "SELECT * FROM dokter WHERE NIP = '$nip'";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if(!$data) {
    echo "Produk tidak ditemukan";
    exit;
}

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nipLama = $_POST['nipLama'];
        $nipBaru = $_POST['nipBaru'];
        $nama = $_POST['nama'];
        $jenisKelamin = $_POST['jenisKelamin'];
        $spesialis = $_POST['spesialis'];
        $noHp = $_POST['noHp'];
        $alamat = $_POST['alamat'];

        if (updateDokter($conn, $nipLama, $nipBaru, $nama, $jenisKelamin, $spesialis, $noHp, $alamat)) {
            echo "<script>alert('Data dokter berhasil diperbarui!'); window.location.href = './dokter.php';</script>";
        } else {
            echo "<script>alert('Gagal memperbarui data dokter.');</script>";
        }
    }
} else {
    echo "NIP dokter tidak ditemukan.";
    exit;
}
?>

<?php include '../layouts/header.php'; ?>
<?php include '../layouts/navbar.php'; ?>
<div class="container mt-2 p-5 w-50">
    <h2>Edit Data Dokter</h2>
    <form method="POST">
        <input type="hidden" name="nipLama" value="<?= $data['NIP'] ?>">
        <div class="mb-3">
            <label>NIP:</label>
            <input type="text" name="nipBaru" class="form-control" value="<?= $data['NIP'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Nama:</label>
            <input type="text" name="nama" class="form-control" value="<?= $data['Nama'] ?>" required>
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
            <label>Spesialis:</label>
            <input type="text" name="spesialis" class="form-control" value="<?= $data['Spesialis'] ?>" required>
        </div>
        <div class="mb-3">
            <label>No HP:</label>
            <input type="text" name="noHp" class="form-control" value="<?= $data['NoHP'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Alamat:</label>
            <input type="text" name="alamat" class="form-control" value="<?= $data['Alamat'] ?>" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
    </form>
</div>
<?php include '../layouts/footer.php'; ?>
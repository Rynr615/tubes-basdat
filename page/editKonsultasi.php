<?php

require_once '../db/config.php';
include_once '../function/func_konsultasi.php';

if (isset($_GET['No_Konsultasi'])) {
    $No_Konsultasi = $_GET['No_Konsultasi'];

    if(!$No_Konsultasi) {
        echo "No_Konsultasi tidak ditemukan";
        exit;
    }

    $dokters = showDataDokter();

    $query = "SELECT * FROM konsultasi WHERE No_Konsultasi = '$No_Konsultasi'";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);

    if(!$data) {
        echo "Data tidak ditemukan";
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $No_Konsultasi = $_POST['noKonsultasi'];
        $NIP = $_POST['nip'];
        $ID_User = $_POST['idUser'];
        $Keluhan_Pasien = $_POST['keluhan'];

        if (updateKeluhan($conn, $No_Konsultasi, $NIP, $ID_User, $Keluhan_Pasien)) {
            echo "<script>alert('Data konsultasi berhasil diperbarui!'); window.location.href = './konsultasi.php';</script>";
        } else {
            echo "<script>alert('Gagal memperbarui data konsultasi.');</script>";
        }
    }
} else {
    echo "Data tidak ditemukan.";
    exit;
}

?>

<?php include '../layouts/header.php'; ?>
<?php include '../layouts/navbar.php'; ?>

<div class="container mt-2 p-5 w-50">
    <h2>Edit Data Dokter</h2>
    <form method="POST">
        <input type="hidden" name="noKonsultasi" value="<?= $data['No_Konsultasi'] ?>">
        <div class="mb-3">
            <label for="nip">NIP Dokter</label>
            <select name="nip" class="form-control" required>
                <option value="">-- Pilih Dokter --</option>
                <?php foreach ($dokters as $dokter): ?>
                    <option value="<?= $dokter['NIP'] ?>">
                        <?= $dokter['NIP'] ?> - <?= $dokter['Nama'] ?> - <?= $dokter['Spesialis'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label>Id User:</label>
            <input type="text" name="idUser" class="form-control" value="<?= $data['ID_User'] ?>" readonly required>
        </div>
        <div class="mb-3">
            <label>Keluhan:</label>
            <input type="text" name="keluhan" class="form-control" value="<?= $data['Keluhan_Pasien'] ?>" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
    </form>
</div>

<?php include '../layouts/footer.php'; ?>
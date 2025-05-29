<?php
require_once '../db/config.php';
require_once '../function/func_konsultasi.php';

$users = showDataUser();
$dokters = showDataDokter();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'tambahKonsultasi') {
    $idUser = $_POST['idUser'];
    $nip = $_POST['nip'];
    $keluhan = $_POST['keluhan'];

    if (insertKonsultasi($conn, $idUser, $nip, $keluhan)) {
        echo "<script>alert('Data konsultasi berhasil ditambahkan!'); window.location.href = './konsultasi.php';</script>";
        exit;
    } else {
        echo "<script>alert('Gagal menambahkan data konsultasi.');</script>";
    }
}
?>

<?php include '../layouts/header.php'; ?>
<?php include '../layouts/navbar.php'; ?>

<div class="container mt-2 p-5 w-50">
    <h2>Tambah Data Konsultasi</h2>
    <form method="POST">
        <input type="hidden" name="action" value="tambahKonsultasi">

        <div class="mb-3">
            <label for="idUser">ID User</label>
            <select name="idUser" class="form-control" required>
                <option value="">-- Pilih User --</option>
                <?php foreach ($users as $user): ?>
                    <option value="<?= $user['ID_User'] ?>">
                        <?= $user['ID_User'] ?> - <?= $user['Username'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

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
            <label for="keluhan">Keluhan Pasien</label>
            <textarea name="keluhan" class="form-control" rows="4" placeholder="Masukkan keluhan pasien..." required></textarea>
        </div>

        <button type="submit" class="btn btn-success">Simpan Data</button>
    </form>
</div>

<?php include '../layouts/footer.php'; ?>

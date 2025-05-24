<?php
require_once '../db/config.php';
include_once '../function/func_pegawai.php';

if (isset($_GET['idPegawai'])) {
    $idPegawai = $_GET['idPegawai'];
    $pegawai = getPegawaiById($conn, $idPegawai);
    $bagianList = showDetailPegawai();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nama = $_POST['nama'];
        $tglLahir = $_POST['tglLahir'];
        $usia = $_POST['usia'];
        $noHp = $_POST['noHp'];
        $idBagian = $_POST['IDbagian'];
        $alamat = $_POST['alamat'];
        $jenisKelamin = $_POST['jenisKelamin'];

        if (updatePegawai($conn, $idPegawai, $nama, $tglLahir, $usia, $noHp, $idBagian, $alamat, $jenisKelamin)) {
            echo "<script>alert('Data pegawai berhasil diperbarui!'); window.location.href = './pegawai.php';</script>";
        } else {
            echo "<script>alert('Gagal memperbarui data pegawai.');</script>";
        }
    }
} else {
    echo "ID Pegawai tidak ditemukan.";
    exit;
}
?>

<?php include '../layouts/header.php'; ?>
<?php include '../layouts/navbar.php'; ?>
<div class="container mt-2 p-5 w-50">
    <h2>Edit Data Pegawai</h2>
    <form method="POST">
        <div class="mb-3">
            <label>Nama:</label>
            <input type="text" name="nama" class="form-control" value="<?= $pegawai['nama'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Tanggal Lahir:</label>
            <input type="date" name="tglLahir" class="form-control" value="<?= $pegawai['tglLahir'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Usia:</label>
            <input type="number" name="usia" class="form-control" value="<?= $pegawai['usia'] ?>" required>
        </div>
        <div class="mb-3">
            <label>No HP:</label>
            <input type="text" name="noHp" class="form-control" value="<?= $pegawai['noHp'] ?>" required>
        </div>
        <div class="mb-3">
            <label>ID Bagian:</label>
            <select name="IDbagian" class="form-control" required>
                <?php foreach ($bagianList as $bagian): ?>
                    <option value="<?= $bagian['ID'] ?>" <?= $pegawai['IDbagian'] == $bagian['ID'] ? 'selected' : '' ?>>
                        <?= $bagian['bagian'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label>Alamat:</label>
            <input type="text" name="alamat" class="form-control" value="<?= $pegawai['alamat'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Jenis Kelamin:</label>
            <select class="form-control" name="jenisKelamin" required>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
    </form>
</div>
<?php include '../layouts/footer.php'; ?>

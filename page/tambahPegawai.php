<?php
include_once '../function/func_pegawai.php';
?>

<?php require_once("../db/config.php"); ?>

<?php include '../layouts/header.php' ?>
<?php include '../layouts/navbar.php' ?>

<div class="container mt-2 p-5 w-50">
    <h2>Tambah Pegawai</h2>
    <form method="POST">
        <input type="hidden" name="action" value="tambahPegawai">
        <div class="mb-3">
            <label>Nama:</label>
            <input type="text" class="form-control" name="nama" required>

            <label>Tanggal Lahir:</label>
            <input type="date" class="form-control" name="tglLahir" required>

            <label>Usia:</label>
            <input type="number" class="form-control" name="usia" required>

            <label>No HP:</label>
            <input type="text" class="form-control" name="noHp" required>

            <label>ID Bagian:</label>
            <select name="IDbagian" class="form-control" required>
                <option value="">-- Pilih Bagian --</option>
                <?php 
                    $bagians = showDetailPegawai();
                    foreach ($bagians as $bagian):
                ?>
                <option value="<?= htmlspecialchars($bagian['ID']) ?>">
                    <?= htmlspecialchars($bagian['bagian']) ?>
                </option>
                <?php endforeach; ?>
            </select>



            <label>Alamat:</label>
            <textarea class="form-control" name="alamat" required></textarea>

            <label>Jenis Kelamin:</label>
            <select class="form-control" name="jenisKelamin" required>
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Pegawai</button>
    </form>
</div>

<?php include '../layouts/footer.php'; ?>
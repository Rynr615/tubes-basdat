<?php include "../layouts/header.php"; ?>
<?php include "../layouts/navbar.php"; ?>
<?php include "../function/func.php";

?>

<?php 

$kodeProduk = $_GET['KodeProduk'] ?? null;

if(!$kodeProduk) {
    echo "Kode produk tidak ditemukan";
    exit;
}

$query = "SELECT * FROM produk WHERE KodeProduk = '$kodeProduk'";
$result = mysqli_query($conn, $query);
$produk = mysqli_fetch_assoc($result);

if(!$produk) {
    echo "Produk tidak ditemukan";
    exit;
}


?>


<div class="container mt-2 p-5 w-50">
    <form action="../function/func.php" method="POST">
        <input type="hidden" name="action" value="edit">
        <input type="hidden" name="kodeProduk" value="<?= $produk['KodeProduk']; ?>">

        <div class="mb-3">
            <!-- namaProduk -->
            <label for="namaProduk" class="form-label">Nama Produk</label>
            <input type="text" class="form-control" name="namaProduk" value="<?= htmlspecialchars($produk['Nama']) ?>" placeholder="Masukkan nama produk...">
            
            <!-- Jenis -->
            <label for="jenis" class="form-label">Jenis Produk</label>
            <input type="text" class="form-control" name="jenis" value="<?= htmlspecialchars($produk['Jenis']) ?>" placeholder="Masukkan jenis...">
            
            <!-- Harga -->
            <label for="harga" class="form-label">Harga Produk</label>
            <input type="text" class="form-control" name="harga" value="<?= htmlspecialchars($produk['Harga']) ?>" placeholder="Masukkan harga...">
            
            <!-- Fungsi -->
            <label for="fungsi" class="form-label">Fungsi Produk</label>
            <input type="text" class="form-control" name="fungsi" value="<?= htmlspecialchars($produk['Fungsi']) ?>" placeholder="Masukkan fungsi...">
            
            <!-- Stok -->
            <label for="stok" class="form-label">Stok Produk</label>
            <input type="text" class="form-control" name="stok" value="<?= htmlspecialchars($produk['Stok']) ?>" placeholder="Masukkan stok...">
            
            <!-- Expired -->
            <label for="expired" class="form-label">Expired</label>
            <input type="date" class="form-control" name="expired" value="<?= htmlspecialchars($produk['Expired']) ?>" placeholder="Masukkan expired...">
            
            <!-- KodeSupplier -->
            <label for="kodeSupplier" class="form-label">Kode Supplier</label>
            <input type="text" class="form-control" name="kodeSupplier" value="<?= htmlspecialchars($produk['KodeSupplier']) ?>">
        </div>

        <div class="mb-3">
            <button class="btn btn-primary" type="submit">Simpan</button>
        </div>
    </form>
</div>

<?php include "../layouts/footer.php"; ?>

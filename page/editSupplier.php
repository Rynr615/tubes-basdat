<?php include "../layouts/header.php"; ?>
<?php include "../layouts/navbar.php"; ?>
<?php include "../function/func_supplier.php";

?>

<?php 

$kodeSupplier = $_GET['KodeSupplier'] ?? null;

if(!$kodeSupplier) {
    echo "Kode supplier tidak ditemukan";
    exit;
}

$query = "SELECT * FROM supplier WHERE KodeSupplier = '$kodeSupplier'";
$result = mysqli_query($conn, $query);
$supplier = mysqli_fetch_assoc($result);

if(!$supplier) {
    echo "Produk tidak ditemukan";
    exit;
}


?>


<div class="container mt-2 p-5 w-50">
    <form action="../function/func_supplier.php" method="POST">
        <input type="hidden" name="action" value="edit">
        
        <div class="mb-3">
            <!-- KodeSupplier -->
            <label for="kodeSupplier" class="form-label">Kode Supplier</label>
            <input type="text" class="form-control" name="kodeSupplier" value="<?= $supplier['KodeSupplier']; ?>">

            <!-- namaSupplier -->
            <label for="namaSupplier" class="form-label">Nama Supplier</label>
            <input type="text" class="form-control" name="namaSupplier" value="<?= htmlspecialchars($supplier['Nama']) ?>" placeholder="Masukkan nama...">
            
            <!-- noHp -->
            <label for="NoHP" class="form-label">No Hp</label>
            <input type="text" class="form-control" name="NoHP" value="<?= htmlspecialchars($supplier['NoHP']) ?>" placeholder="Masukkan nomor telepon...">
            
            <!-- alamat -->
            <label for="Alamat" class="form-label">Alamat Produk</label>
            <input type="text" class="form-control" name="Alamat" value="<?= htmlspecialchars($supplier['Alamat']) ?>" placeholder="Masukkan alamat...">
        </div>

        <div class="mb-3">
            <button class="btn btn-primary" type="submit">Simpan</button>
        </div>
    </form>
</div>

<?php include "../layouts/footer.php"; ?>

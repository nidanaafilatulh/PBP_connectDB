<?php 
    require_once "db_login.php";
    $id = $_GET['id'];
    $query = mysqli_query($koneksi, "SELECT * FROM buku WHERE id='$id'");
    $data = mysqli_fetch_array($query);
    $id = $data['id'];
    $judul = $data['judul'];
    $pengarang = $data['pengarang'];
    $penerbit = $data['penerbit'];
    $tahun = $data['tahun'];
    $harga = $data['harga'];
    $stok = $data['stok'];
    $gambar = $data['gambar'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buku</title>
</head>
<body>
    
</body>
</html>
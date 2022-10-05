<?php
session_start();

include 'connection.php';

$duplicate = true;

# Fungsi: Jika kode masuk yang dihasilkan dari random duplikat, maka kode akan me-looping sampai mendapatkan kode masuk yang tidak duplikat 
while($duplicate == true){
    $random_number = rand();

    $checkKodeMasuk = mysqli_query($conn, "select id_masuk from masuk where id_masuk = $random_number");
    $checkRowKodeMasuk = mysqli_num_rows($checkKodeMasuk);

    $checkKendaraan = mysqli_query($conn, "select kendaraan from masuk where kendaraan = 'motor'");
    $checkRowKendaraan = mysqli_num_rows($checkKendaraan);

    # Fungsi: Mengecek apakah parkiran motor penuh atau tidak
    if($checkRowKendaraan == 100){
        $duplicate = false;
        header('location: masukParkir.php?full=true');
    }

    # Fungsi: Memasukkan data ke database jika kode masuk tidak duplikat
        elseif($checkRowKodeMasuk == 0){
        $query = mysqli_query($conn, "insert into masuk(id_masuk, kendaraan) values ($random_number, 'motor')");
        $_SESSION['id_masuk'] = $random_number;
        $duplicate = false;
        header('location: success.php');

    # Fungsi: Mengembalikan nilai true pada duplicate agar di-looping kembali
    } else {
        $duplicate = true;
    }
}
<?php

session_start();
include 'connection.php';

$id_masuk = $_SESSION['id_masuk'];

$query = mysqli_query($conn, "SELECT * FROM masuk WHERE id_masuk = $id_masuk");

$ambil = mysqli_fetch_array($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="successStyle.css">
    <title>Success</title>
</head>
<body>
    <div class="layarDepan">
        <h1>Selamat Datang!</h1>
        <p><b>Kode Masuk: </b> <?php echo $ambil['id_masuk']; ?> </p>
        <p><b>Waktu Masuk: </b> <?php echo $ambil['waktu_masuk'] ?> </p>
        <p><b>Kendaraan: </b> <?php echo $ambil['kendaraan']; ?> </p>
    </div>
</body>
</html>
<?php
session_start();

include 'connection.php';

$random_number = rand(1, 1000);
$query = mysqli_query($conn, "insert into masuk(id_masuk, kendaraan) values ($random_number, 'mobil')");

$_SESSION['id_masuk'] = $random_number;

header('location: success.php');
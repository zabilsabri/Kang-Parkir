<?php

include 'connection.php';
if(isset($_POST['submit'])){
    $kode = $_POST['kode']; 

    $query = mysqli_query($conn, "select * from masuk where id_masuk = $kode");
    $ambil = mysqli_fetch_array($query);

    $waktu_masuk_string = $ambil['waktu_masuk'];
    
    date_default_timezone_set("Asia/Makassar");
    $today_date_string = date('Y/m/d H:i:s');
    
    $waktu_masuk_time = strtotime($waktu_masuk_string);
    $today_date_time = strtotime($today_date_string);

    $diff = abs($waktu_masuk_time - $today_date_time);

    $years = round($diff / (365*60*60*24));
    $months = round(($diff - $years * 365*60*60*24) / (30*60*60*24));
    $days = round(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
    $hours = round(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24)/ (60*60));

    if($ambil['kendaraan'] == "motor"){
        $total = (($years * 8760) + ($months * 730) + ($days * 24) + $hours) * 3000;
    } else {
        $total = (($years * 8760) + ($months * 730) + ($days * 24) + $hours) * 5000;
    }
}

error_reporting(E_ERROR | E_PARSE);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="keluarParkirStyle.css">
    <title>Keluar Parkir</title>
</head>
<body>
        <div class="inputKode">
            <form class="row g-2" method="POST" action="keluarParkir.php">
                <div class="col-auto">
                    <label for="inputPassword2" class="visually-hidden">Password</label>
                    <input type="text" class="form-control" name="kode" placeholder="Input Code">
                </div>
                <div class="col-auto">
                    <button type="submit" name="submit" class="btn btn-primary mb-3">Confirm Code</button>
                </div>
            </form>
        </div>
        <div class="layarDepan">
            <div class="struk">
                <h1 class="struk-heading">Struk</h1>
                <p><b>1. Kode Masuk: </b> <?php echo $ambil['id_masuk']; ?></p>
                <p><b>2. Waktu Masuk: </b> <?php echo $ambil['waktu_masuk']; ?> </p>
                <p><b>3. Kendaraan: </b> <?php echo $ambil['kendaraan']; ?> </p>
                <hr>
                <p><b>Total: </b> <h2> Rp. <?php echo $total; ?> </h2> </p>
            </div>
        </div>
</body>
</html>
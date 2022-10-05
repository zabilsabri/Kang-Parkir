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
                    <input type="text" class="form-control" name="kode" placeholder="Input Code">
                </div>
                <div class="col-auto">
                    <button type="submit" name="submit2" class="btn btn-primary mb-3">Confirm Code</button>
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
            <div class="d-grid gap-2 col-6 mx-auto" style="margin-top: 20px;">
                <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#bukaportal">Buka Portal</button>
            </div>
        </div>

<div class="modal fade" id="bukaportal" tabindex="-1" aria-labelledby="bukaportalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="bukaportalLabel">PORTAL TERBUKA!</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p style="text-align: center;">Hati - Hati kepala</p>
      </div>
      <div class="modal-footer">
        <form action="keluarParkir.php" method="POST">
            <button class="btn btn-secondary" type="submit" name="deleteData">Tutup</button>
        </form>
        </div>
    </div>
  </div>
</div>
</body>
</html>


<?php
session_start();

include 'connection.php';

# Fungsi: Menghitung biaya parkiran customer berdasarkan berapa lama di dalam parkiran
if(isset($_POST['submit2'])){
    $kode = $_POST['kode'];

    $_SESSION['kodeKeluar'] = $kode;

    $query = mysqli_query($conn, "select * from masuk where id_masuk = $kode");

    $ambil = mysqli_fetch_assoc($query);

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

# Fungsi: Menghapus data jika customer sudah keluar dari parkiran
if(isset($_POST['deleteData'])){

    $kode = $_SESSION['kodeKeluar'];

    $deleteData = mysqli_query($conn, "delete from masuk where id_masuk = $kode");
    header('location: keluarParkir.php');
}

error_reporting(E_ERROR | E_PARSE);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="masukParkirStyle.css">
    <title>Parkir Bang!</title>
</head>
<body>
    <nav class="navbar bg-light">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">Kang Parkir</span>
        </div>
    </nav>
    <div class="layarDepan">
        <h1>SELAMAT DATANG!</h1>
        <h3>Silahkan Pilih Kendaraan Anda</h3>
        <div class="button">
            <a href="masukParkirMobilBE.php"><img src="picture/mobil.png" style="border: black solid;" height="150px" width="250px" alt="mobil"></a>
            <a href="masukParkirMotorBE.php"><img src="picture/motor.png" style="border: black solid;" height="150px" width="250px" alt="motor"></a>
        </div>
    </div>

    <div class="alertBox">
        <?php if(isset($_GET['full'])){ ?>
        <b>Maaf Parkiran Untuk Kendaraan Anda Sudah Penuh</b>
        <?php } ?>
    </div>

</body>
</html>
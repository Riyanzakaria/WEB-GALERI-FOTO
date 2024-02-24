<?php
session_start();
$userid = $_SESSION['id'];
include 'db.php';
if($_SESSION['status_login'] != true){
  echo '<script>window.location="login.php"</script>';
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap demo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
  <header>
    <nav class="navbar navbar-expand-lg py-3 " style="background-color: #8AAAE5">
      <div class="container">      
        <a class="navbar-brand" href="dashboard.php" style="font-weight: 900">GALERI FOTO</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0" style="font-weight: 600">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="dashboard.php">Dashboard</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Data
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="data-image.php">Data Foto</a></li>
                <li><a class="dropdown-item" href="data-album.php">Data Album</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="galeri.php">Galeri</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="profil.php">Profil</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="keluar.php">Log Out</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <div class="container">
    <div class="p-3 mt-5 rounded-3 shadow-sm" style="background-color: #8AAAE5">
      <div class="container-fluid py-5">
        <h5 class="fs-4">Selamat Datang <?php echo $_SESSION['a_global']->username ?></h5>
        <h1 class="display-4 fw-bold">Galeri Foto</h1>
        <h5 class="col-md-9 ">Website yang digunakan untuk mengunggah Album dan Foto-foto anda.</h5>
      </div>
    </div>
    <h2 class=" my-4 fw-bold">Kategori</h2>
    <div class="p-3 rounded-3 shadow">
      <div class="container-fluid py-2">
        <div class="row">
          <?php
          $kategori = mysqli_query($conn, "SELECT * FROM album 
            ORDER BY album_id DESC");
          if(mysqli_num_rows($kategori) > 0){ 
            while($k = mysqli_fetch_array($kategori)){
              ?>
              <div class="col-md-2">
                <div class="card " style="border-color: black; ">
                  <a href="galeri.php?kat=<?php echo $k['album_id']; ?>">
                    <img src="img/album.png" class="card-img-top p-sm-2 p-md-4" alt="Gambar Kategori 1">
                  </a>

                  <div class="card-body">
                    <h6 class="card-title fw-bold text-center"><?php echo $k['nama_album']; ?></h6>
                  </div>
                </div>
              </div>
            <?php }}else{ ?>
              <p>Kategori Tidak Ada</p>
            <?php } ?>
          </div> 
        </div>
      </div>
      <h2 class=" my-4 fw-bold">Foto</h2>
      <div class="p-3 my-4 rounded-3 shadow">
        <div class="container-fluid py-2">
          <div class="row">
           <?php
           $foto = mysqli_query($conn, "SELECT * FROM foto ORDER BY foto_id DESC LIMIT 20"); 
           if(mysqli_num_rows($foto) > 0){ 
            while($p = mysqli_fetch_array($foto)){
              ?>
              <div class="col-md-3">
                <div class="card" style="">
                  <a href="detail-image.php?id=<?php echo $p['foto_id']; ?>">
                    <img src="foto/<?php echo $p['lokasi_file']; ?>" class="card-img-top p-sm-2 p-md-4" alt="..." style="object-fit: cover; height: 250px; width: 100%;">
                  </a>
                  <div class="card-body">
                    <h5 class="card-title fw-bold"> <?php echo $p['judul_foto']; ?></h5>
                    <p class="card-text m-0"><?php echo $p['tanggal_unggah']; ?></p>
                  </div>
                  <div class="card-footer">
                    <a href="proses_like.php?foto_id=<?php echo $p['foto_id']
                   ?> " type="submit" name="su"><i class=" bi bi-heart"></i></a>
                   <a href=""><i class="ms-2 bi bi-chat-left"></i></a> 2 Komentar
                 </div>
               </div>
             </div>
           <?php }}else{ ?>
            <p>Foto Tidak Ada</p>
          <?php } ?>
        </div>
      </div>
    </div>



  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>
<?php
error_reporting(0);
include 'db.php';

$kontak = mysqli_query($conn, "SELECT * FROM user WHERE user_id = 2");
$a = mysqli_fetch_object($kontak);
// Inisialisasi variabel search
$search = isset($_GET['search']) ? $_GET['search'] : '';
$kat = isset($_GET['kat']) ? $_GET['kat'] : '';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Web Galeri Foto</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/style.css"> 
</head>

<body>
  <!-- Header -->
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

  <!-- Search -->
  <div class="search">
    <div class="container my-3">
      <form class="d-flex" action="galeri.php">
        <input type="text" name="search" class=" form-control" placeholder="Cari Foto" value="<?php
        echo $_GET['search'] ?>" />
        <input type="hidden" name="kat" value="<?php echo $_GET['kat'] ?>" />
        <input type="submit" class="btn btn-primary" name="cari" value="Cari Foto" />
      </form>
    </div>
  </div>

  <!-- New Product -->
  <div class="section">
    <div class="container">
      <h3>Galeri Foto</h3>
      <div class="p-3 my-4 rounded-3 shadow">
        <div class="container-fluid py-2">
          <div class="row">
           <?php
           if($_GET['search'] != '' || $_GET['kat'] != ''){
            $where = "AND judul_foto LIKE '%".$_GET['search']."%' AND 
            album_id LIKE '%".$_GET['kat']."%' ";
          }

          $foto = mysqli_query($conn, "SELECT foto.*, user.username FROM foto
            JOIN user ON foto.user_id = user.user_id $where ORDER BY foto_id DESC LIMIT 8"); 
          if(mysqli_num_rows($foto) > 0){ 
            while($p = mysqli_fetch_array($foto)){
              ?>
              <div class="col-md-3">
                <div class="card" style="">
                  <a href="detail-image.php?id=<?php echo $p['foto_id']; ?>">
                    <img src="foto/<?php echo $p['lokasi_file']; ?>" class="card-img-top p-sm-2 p-md-4" alt="..." style="object-fit: cover; height: 250px; width: 100%;">
                  </a>
                  <div class="card-body">
                    <h5 class="card-title fw-bold"> <?php echo substr($p['judul_foto'], 0, 30) ?></h5>
                    <h5 class="card-title fw-bold">Nama User :  <?php echo $p['username']; ?></h5>
                    <p class="card-text m-0"><?php echo $p['tanggal_unggah']; ?></p>
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

  <!-- Footer -->
  <footer>
    <div class="container">
      <small>Copyright &copy; 2024 - Web Galeri Foto.</small>
    </div>
  </footer>
</body>
</html>
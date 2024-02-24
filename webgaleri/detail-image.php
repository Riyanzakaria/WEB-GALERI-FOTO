<?php
// Include file database
include 'db.php';

// Periksa apakah pengguna telah login
session_start();
if($_SESSION['status_login'] != true){
  echo '<script>window.location="login.php"</script>';
}


// Tangani pengiriman formulir komentar
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['comment'])) {
    $photo_id = $_GET['id'];
    $user_id = $_SESSION['user_id'];
    $comment = $_POST['comment'];

    // Simpan komentar ke dalam tabel komentar_foto
    $sql = "INSERT INTO komentar_foto (photo_id, user_id, comment) VALUES ('$photo_id', '$user_id', '$comment')";
    mysqli_query($conn, $sql);
}

// Tangani pengiriman formulir like
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['like'])) {
    $photo_id = $_GET['id'];
    $user_id = $_SESSION['user_id'];

    // Periksa apakah pengguna sudah memberikan like sebelumnya
    $sql = "SELECT * FROM like_foto WHERE photo_id = '$photo_id' AND user_id = '$user_id'";
    $result = mysqli_query($conn, $sql);

    // Jika belum memberikan like, simpan like ke dalam tabel like_foto
    if (mysqli_num_rows($result) == 0) {
        $sql = "INSERT INTO like_foto (photo_id, user_id) VALUES ('$photo_id', '$user_id')";
        mysqli_query($conn, $sql);
    }
}

// Lakukan query untuk mendapatkan detail foto
if (isset($_GET['id'])) {
    $query = "SELECT foto.*, user.username FROM foto JOIN user ON foto.user_id = user.user_id WHERE foto_id = " . $_GET['id'];
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $foto = mysqli_fetch_assoc($result);
    } else {
        echo "Foto tidak ditemukan.";
        exit();
    }
} else {
    echo "ID foto tidak diberikan.";
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Foto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</style>
</head>
<header>
    <nav class="navbar navbar-expand-lg py-3" style="background-color: #8AAAE5">
      <div class="container">      
        <a class="navbar-brand" href="dashboard.php" style="font-weight: 900">GALERI FOTO</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
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
<body>
    <div class="container mt-4">
        <div class="col-md-12 ">
            <div class="card shadow">
                <div class="row p-5">
                    <!-- Foto section -->
                    <div class="col-md-7">
                        <img src="foto/<?php echo $foto['lokasi_file']; ?>" class="card-img-top" alt="Foto">
                    </div>
                    <!-- Detail section -->
                    <div class="col-md-5">
                        <!-- Detail foto -->
                        <h4 class="card-title display-5 fw-bold"><?php echo $foto['judul_foto']; ?></h4>
                        <p class="card-text mb-1">Deskripsi: <?php echo $foto['deskripsi_foto']; ?></p>
                        <p class="card-text mb-1">Uploader: <?php echo $foto['username']; ?></p>
                        <p class="card-text mb-1">Tanggal Unggah: <?php echo $foto['tanggal_unggah']; ?></p>
                        
                        <!-- Formulir komentar -->
                        <form action="detail-image.php?id=<?php echo $_GET['id']; ?>" method="POST">
                            <div class="mb-3">
                                <label for="comment" class="form-label">Komentar:</label>
                                <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Kirim Komentar</button>
                        </form>

                        <!-- Tombol Like -->
                        <form action="detail-image.php?id=<?php echo $_GET['id']; ?>" method="POST">
                            <input type="hidden" name="like">
                            <button type="submit" class="btn btn-primary">Like</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center mt-5 text-muted">
      Copyright &copy; 2017-2021 &mdash; Riyan Zakaria Web Galeri 
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>
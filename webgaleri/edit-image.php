
<?php
session_start();
include 'db.php';
if($_SESSION['status_login'] != true){
    echo '<script>window.location="login.php"</script>';
}

// Ambil data foto yang ingin diedit
$produk = mysqli_query($conn, "SELECT foto.*, album.nama_album FROM foto JOIN album ON foto.album_id = album.album_id  WHERE foto.foto_id ='".$_GET['id']."'");
if(mysqli_num_rows($produk) == 0){
    echo '<script>window.location="data-image.php"</script>';
}
$p = mysqli_fetch_object($produk);

// Query untuk mengambil semua album
$query = "SELECT * FROM album";
$result = mysqli_query($conn, $query);

// Periksa apakah query berhasil dieksekusi
if (!$result) {
    die("Query error: " . mysqli_error($conn));
}

// Nilai default untuk dropdown album
$defaultValue = $p->album_id; // Nilai album yang saat ini dipilih untuk foto yang diedit

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head> 
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <title>Edit Image | WEB Galeri Foto</title> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <link rel="stylesheet" type="text/css" href="css/style.css"> 
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
    <!-- content --> 
    <section class="h-100">
        <div class="container mt-3 h-100">
            <div class="row justify-content-sm-center h-100" >
                <div class="">
                    <div class="card shadow-lg">
                        <div class="card-body px-5 py-4">
                            <h1 class="fs-4 card-title fw-bold mb-4">Edit Image</h1>
                            <form method="POST" enctype="multipart/form-data" action="">
                                <div class="row">
                                    <input type="hidden" name="user_id" value="<?php echo $_SESSION['a_global']->user_id ?>">
                                    <div class="col-md-12 mb-3">
                                        <label class="mb-2 text-muted" for="nama">Judul</label>
                                        <input type="text" name="judul_foto" value="<?php echo $p->judul_foto ?>" class="form-control" required>
                                        <div class="invalid-feedback">
                                            Name is required    
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="mb-2 text-muted" for="Deskripsi">Deskripsi</label>
                                        <textarea class="form-control" name="deskripsi_foto"><?php echo $p->deskripsi_foto ?></textarea>
                                        <div class="invalid-feedback">
                                            Deskripsi is invalid
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="mb-2 text-muted" for="kategori">Pilih Kategori</label>
                                        <select class="form-control" name="album_id">
                                            <?php
                                            // Loop melalui hasil query untuk menambahkan opsi pada dropdown/select
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                // Tambahkan opsi ke dropdown/select untuk setiap baris
                                                echo '<option value="' . $row['album_id'] . '"';
                                                // Periksa apakah ini adalah nilai default, jika ya, tambahkan atribut 'selected'
                                                if ($row['album_id'] == $defaultValue) {
                                                    echo ' selected';
                                                }
                                                echo '>' . $row['nama_album'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="mb-2 col-md-12 text-muted" for="Gambar">Upload Gambar</label>
                                        <img class="mb-2" src="foto/<?php echo $p->lokasi_file ?>" width="150px" />
                                        <input type="hidden" name="lokasi_file_lama" value="<?php echo $p->lokasi_file ?>">
                                        <input type="file" name="lokasi_file" class="form-control">
                                        <div class="invalid-feedback">
                                            Gambar is invalid
                                        </div>
                                    </div>
                                    <div class="align-items-center d-flex">
                                        <button type="submit" name="submit" value="Submit" class="btn btn-primary ms-auto">
                                            Submit    
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <?php
                            if(isset($_POST['submit'])){
                                // menampung inputan dari form
                                $judulfoto  = $_POST['judul_foto'];
                                $deskripsifoto   = $_POST['deskripsi_foto']; 
                                $tanggalunggah  = date('y-m-d');
                                $albumid     = $_POST['album_id'];
                                $userid      = $_POST['user_id'];

                                // menampung data file yang diupload 
                                if(isset($_FILES['lokasi_file']['name']) && !empty($_FILES['lokasi_file']['name'])) {
                                    // Jika ada file gambar yang diunggah baru
                                    $foto = $_FILES['lokasi_file']['name'];
                                    $tmp = $_FILES['lokasi_file']['tmp_name'];
                                    $lokasi = './foto/';
                                    $namafoto = rand().'-'.$foto;

                                    // Simpan file yang diunggah baru ke direktori yang ditentukan
                                    move_uploaded_file($tmp, $lokasi.$namafoto);
                                } else {
                                    // Jika tidak ada file gambar yang diunggah baru, gunakan foto sebelumnya
                                    $namafoto = $p->lokasi_file;
                                }

                                // melakukan update ke database
                                $update = mysqli_query($conn, "UPDATE foto SET
                                    judul_foto       = '".$judulfoto."',
                                    deskripsi_foto   = '".$deskripsifoto."',
                                    tanggal_unggah   = '".$tanggalunggah."',
                                    lokasi_file   = '".$namafoto."',
                                    album_id         = '".$albumid."',
                                    user_id          = '".$userid."'
                                    WHERE foto_id    = '".$p->foto_id."'
                                ");

                                if($update){
                                    echo '<script>alert("Ubah data berhasil")</script>';
                                    echo '<script>window.location="data-image.php"</script>';
                                } else {
                                    echo 'gagal'.mysqli_error($conn);
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-5 text-muted">
                    Copyright &copy; 2017-2021 &mdash; Riyan Zakaria Web Galeri 
                </div>
            </div>
        </div>
    </div>
</section>

<!-- footer -->
<script src="js/login.js"></script>

</body>
</html>
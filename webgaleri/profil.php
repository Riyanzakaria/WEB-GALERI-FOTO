<?php
session_start();
include 'db.php';
if($_SESSION['status_login'] != true){
    echo '<script>window.location="login.php"</script>';
}
$query = mysqli_query($conn, "SELECT * FROM user WHERE user_id ='".$_SESSION['id']."'");
// var_dump($_SESSION['id']);
if(mysqli_num_rows($query) > 0) { // Periksa apakah hasil query tidak kosong
    $d = mysqli_fetch_object($query);

    // Sekarang Anda dapat menggunakan variabel $d dengan aman
    // Pastikan untuk melakukan ini hanya setelah Anda yakin bahwa $d memiliki nilai yang valid
    ?>
    <!-- Konten HTML di sini -->
    <?php
} else {
    // Handle kasus di mana tidak ada hasil yang ditemukan
    echo "Data user tidak ditemukan.";
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profil | Web Galeri Foto</title>
    <!-- <link rel="stylesheet" type="text/css" href="css/style.css">  -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />

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
    <!-- Content -->
    <section class="h-100">
        <div class="container-fluid h-100 mt-5">
            <div class="row justify-content-sm-center h-100">
                <div class="col-sm-9">
                    <div class="card shadow-lg">
                        <div class="card-body p-5">
                            <h1 class="fs-4 card-title fw-bold mb-4">Profil</h1>
                            <div class="box">
                                <form method="POST" action="">
                                 <div class="row">
                                    <div class="mb-3 col-md-6">

                                        <label class="mb-2 text-muted" for="name">Username</label>
                                        <input id="username" type="text" class="form-control" name="username" value="<?php echo $d->username ?>" required autofocus>
                                        <div class="invalid-feedback">
                                            Username is required    
                                        </div>
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label class="mb-2 text-muted" for="username">Nama Lengkap</label>
                                        <input id="nama_lengkap" type="text" class="form-control" name="nama_lengkap" value="<?php echo $d->nama_lengkap ?>" required>
                                        <div class="invalid-feedback">
                                            Username is required
                                        </div>
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label class="mb-2 text-muted" for="">Email</label>
                                        <input id="email" type="text" class="form-control" name="email" value="<?php echo $d->email ?>" required>
                                        <div class="invalid-feedback">
                                            Nomor Telepon is required
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="mb-2 text-muted" for="">Alamat</label>
                                        <input id="alamat" type="text" class="form-control" name="alamat" value="<?php echo $d->alamat ?>" required>
                                        <div class="invalid-feedback">
                                            Email is required
                                        </div>
                                    </div>

                                </div>

                                <div class="align-items-center d-flex">
                                    <button type="submit" name="tambah" value="tambah" class="btn btn-primary ms-auto">
                                        Ubah    
                                    </button>
                                </div>
                            </form>
                            <?php
                            if(isset($_POST['tambah'])){
                                $user      = $_POST['username'];
                                $email      = $_POST['email'];
                                $nama        = $_POST['nama_lengkap'];
                                $alamat    = $_POST['alamat'];
                                $update    = mysqli_query($conn, "UPDATE user SET
                                    username            = '".$user."',
                                    email               = '".$email."',
                                    nama_lengkap        = '".$nama."',
                                    alamat              = '".$alamat."'
                                    WHERE user_id       = '".$d->user_id."'
                                    ");
                                if($update){
                                    echo '<script>alert("Ubah data berhasil")</script>';
                                    echo '<script>window.location="profil.php"</script>';
                                }else{
                                    echo 'gagal'.mysqli_error($conn);
                                }
                            }
                            ?>
                        </div>
                        <h1 class="fs-4 card-title fw-bold my-4">Ubah Password</h1>
                        <form method="POST" action="">
                            <div class="mb-3">
                                <label class="mb-2 text-muted" for="name">Password</label>
                                <input id="" type="" class="form-control" name="pass1" value="" required autofocus>
                                <div class="invalid-feedback">
                                    Username is required    
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label class="mb-2 text-muted" for="password">Konfirmasi Password</label>
                                <input id="password" type="password" class="form-control" name="pass2" required>
                                <div class="mt-2">

                                    <i class="bi bi-eye-slash" id="togglePassword"> Show Password</i>
                                </div>
                                <div class="invalid-feedback">
                                    Password is required
                                </div>

                            </div>

                            <div class="align-items-center d-flex">
                                <button type="submit" name="ubah_password" value="login" class="btn btn-primary ms-auto">
                                    Ubah    
                                </button>
                            </div>
                        </form>
                        <?php if (isset($_POST['ubah_password'])) {
                            $pass1 = $_POST['pass1'];
                            $pass2 = $_POST['pass2'];

                            if ($pass2 =! $pass1) {
                                echo '<script>alert("Ubah data berhasil")</script>';
                                
                            } else{
                                $u_pass = mysqli_query($conn, "UPDATE user SET
                                    password = '".$pass1."'
                                    WHERE user_id = '".$d->user_id."'");
                                if ($u_pass) {
                                    echo '<script>alert("Ubah data berhasil")</script>';
                                    echo '<script>window.location="profil.php"</script>';

                                }else{
                                    echo 'gagal'.mysqli_error($conn);
                                }
                            }
                        } ?>
                    </div>
                </div>
                <div class="text-center mt-5 text-muted">
                  Copyright &copy; 2024 &mdash; Web Galeri Foto. 
              </div>
          </div>
      </div>
  </div>
</section>

<!-- Footer -->
<footer>
    <div class="container">
        <small>Copyright &copy; 2024 - Web Galeri Foto.</small>
    </div>
</footer>
<script>
    const togglePassword = document.querySelector("#togglePassword");
    const password = document.querySelector("#password");

    togglePassword.addEventListener("click", function () {
        // toggle the type attribute
        const type = password.getAttribute("type") === "password" ? "text" : "password";
        password.setAttribute("type", type);
        
        // toggle the icon
        this.classList.toggle("bi-eye"); // Mengubah ikon sesuai dengan jenis input password
    });

    // Hapus bagian ini yang mencegah form dari submit
    // prevent form submit
    // const form = document.querySelector("form");
    // form.addEventListener('submit', function (e) {
    //     e.preventDefault();
    // });
</script>
</body>
</html>
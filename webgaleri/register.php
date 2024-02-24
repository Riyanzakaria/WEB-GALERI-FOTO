<?php
include 'db.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head> 
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <title>Register | WEB Galeri Foto</title> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />

</head>

<body>
    <!-- content --> 
    <section class="h-100">
        <div class="container h-100">
            <div class="row justify-content-sm-center h-100" >
                <div class="">
                    <div class="text-center my-5">
                        <img src="https://getbootstrap.com/docs/5.0/assets/brand/bootstrap-logo.svg" alt="logo" width="100">
                    </div>
                    <div class="card shadow-lg">
                        <div class="card-body p-5">
                            <h1 class="fs-4 card-title fw-bold mb-4">Register</h1>
                            <form method="POST" class="needs-validation" novalidate="" autocomplete="off">
                                <div class="row">
                                 <div class="col-md-6 mb-3">
                                    <label class="mb-2 text-muted" for="nama">Nama Lengkap</label>
                                    <input id="name" type="text" class="form-control" name="nama" value="" required autofocus>
                                    <div class="invalid-feedback">
                                        Name is required    
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="mb-2 text-muted" for="username">Username</label>
                                    <input id="username" type="text" class="form-control" name="user" value="" required>
                                    <div class="invalid-feedback">
                                        Username is invalid
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="mb-2 text-muted" for="password">Password</label>
                                    <input id="password" type="password" class="form-control" name="pass" required>
                                    <i class="bi bi-eye-slash" id="togglePassword"> Show Password</i>
                                    <div class="invalid-feedback">
                                        Password is required
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">

                                    <label class="mb-2 text-muted" for="email">E-Mail</label>
                                    <input id="email" type="email" class="form-control" name="email" value="" required>
                                    <div class="invalid-feedback">
                                        Email is invalid
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="mb-2 text-muted" for="almt">Alamat</label>
                                    <input id="almt" type="text" class="form-control" name="almt" value="" required>
                                    <div class="invalid-feedback">
                                        Alamat is invalid
                                    </div>
                                </div>

                                <p class="form-text text-muted mb-3">
                                    By registering you agree with our terms and condition.
                                </p>

                                <div class="align-items-center d-flex">
                                    <button type="submit" name="submit" value="Submit"  class="btn btn-primary ms-auto">
                                        Register    
                                    </button>
                                </div>

                            </div>
                        </form>
                        <?php
                        if(isset($_POST['submit'])){ 

                            $nama = ucwords($_POST['nama']);
                            $username = $_POST['user'];
                            $password = $_POST['pass'];
                            $mail = $_POST['email'];
                            $alamat = ucwords($_POST['almt']);

                            $insert = mysqli_query($conn, "INSERT INTO user VALUES 
                                (
                                null,
                                '".$username."',
                                '".$password."',
                                '".$mail."',
                                '".$nama."',
                                '".$alamat."'
                                )
                                ");
                            if($insert){
                                echo '<script>alert("Registrasi berhasil")</script>'; 
                                echo '<script>window.location="login.php"</script>';
                            }else{
                                echo 'gagal '.mysqli_error($conn);
                            }
                        }
                        ?>
                    </div>




                </div>
                <div class="card-footer py-3 border-0">
                    <div class="text-center">
                        Already have an account? <a href="login.php" class="text-dark">Login</a>
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
<script src="js/login.js"></script>

</body>
</html>
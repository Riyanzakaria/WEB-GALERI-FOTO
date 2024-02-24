<?php session_start(); include 'db.php'; if
($_SESSION['status_login'] != true) { echo
	'<script>window.location="login.php"</script>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Web Galeri</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />

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
		<div class="p-3 mt-5 rounded-3 shadow" >
			<h3 class="fw-bold">Data Galeri Foto</h3>
			<div class="box">
				<p><a href="tambah-image.php" class="btn btn-success"><i class="bi bi-plus"></i>Tambah Data</a></p>
				<table border="1" cellspacing="0" class="table table-striped table-bordered">
					<thead>
						<tr>
							<th width="60px">No</th>
							<th>Album</th>
							<th>Username</th>
							<th>Nama Foto</th>
							<th width="250px">Deskripsi</th>
							<th>Gambar</th>
							<th>Tangggal Unggah</th>
							<th width="auto">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no = 1;

						$user = $_SESSION['a_global']->user_id;

						$foto = mysqli_query($conn, "SELECT foto.*, album.nama_album, user.username FROM foto
							JOIN album ON foto.album_id = album.album_id 
							JOIN user ON foto.user_id = user.user_id 
							WHERE foto.user_id =
							'$user' "); if (mysqli_num_rows($foto) > 0) {
								while ($row = mysqli_fetch_array($foto)) { ?>
									<tr>
										<td><?php echo $no++ ?></td>
										<td><?php echo $row['nama_album'] ?></td>
										<td><?php echo $row['username'] ?></td>
										<td><?php echo $row['judul_foto'] ?></td>
										<td><?php echo $row['deskripsi_foto'] ?></td>
										<td><a href="foto/<?php echo $row['lokasi_file'] ?>" target="_blank"><img src="foto/<?php echo
										$row['lokasi_file'] ?>" width="50px"></a></td>
										<td><?php echo $row['tanggal_unggah'] ?></td>
										<td>
											<a class="btn btn-primary btn-sm" href="edit-image.php?id=<?php echo $row['foto_id']
										?>"><i style="font-style: normal;" class="bi bi-pencil-square"> Edit</i></a> 
										<a class="btn btn-danger btn-sm" href="proses-hapus.php?idp=<?php echo
										$row['foto_id'] ?>" onclick="return confirm('Yakin Ingin Hapus ?')"><i style="font-style: normal;" class="bi bi-trash"> Hapus</i></a>
									</td>
								</tr>
							<?php }
						} else { ?>
							<tr>
								<td colspan="8">Tidak ada data</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>
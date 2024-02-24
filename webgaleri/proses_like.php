<?php 
session_start();
include 'db.php';
$fotoid = $_GET['foto_id'];
$userid = $_SESSION['id'];
$ceksuka = mysqli_query($conn, "SELECT * FROM like_foto WHERE foto_id='$fotoid' AND user_id='$userid'");

if(mysqli_num_rows($ceksuka) == 1){
	while($row = mysqli_fetch_array($ceksuka)){
		$likeid = $row['likeid'];
		$query = mysqli_query($conn, "DELETE FROM like_foto WHERE like_id='$likeid' ");
		echo "<script>
		location.href='.dashboard.php';
		</script>";
	}
}else{

	$tanggallike = date('y-m-d');
	$query = mysqli_query($conn, "INSERT INTO like_foto VALUES(
		'',
		'$fotoid',
		'$userid',
		'$tanggallike'
	)");

	echo '<script>window.location="dashboard.php";
	</script>';
}
?>
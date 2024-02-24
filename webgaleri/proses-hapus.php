<?php
include 'db.php';
if(isset($_GET['idp'])){
    $foto = mysqli_query($conn, "SELECT lokasi_file FROM foto WHERE foto_id = 
        '".$_GET['idp']."' ");
    $p = mysqli_fetch_object($foto);

    unlink('./foto/'.$p->lokasi_file);

    $delete = mysqli_query($conn, "DELETE FROM foto WHERE foto_id = 
        '".$_GET['idp']."' ");
    echo '<script>window.location="data-image.php"</script>';
}
?>
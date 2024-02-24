<?php
include 'db.php';
if(isset($_GET['idp'])){
    $foto = mysqli_query($conn, "SELECT * FROM album WHERE album_id = 
        '".$_GET['idp']."' ");

    $delete = mysqli_query($conn, "DELETE FROM album WHERE album_id = 
        '".$_GET['idp']."' ");

    echo '<script>window.location="data-album.php"</script>';
}
?>
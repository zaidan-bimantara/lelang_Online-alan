<?php 
$koneksi = mysqli_connect("localhost","root","","sistem_lelang");

// Check connection
if (mysqli_connect_errno()){
	echo "Koneksi database gagal : " . mysqli_connect_error();
}

?>
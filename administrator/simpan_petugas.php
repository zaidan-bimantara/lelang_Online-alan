<?php 
// koneksi database
include '../koneksi.php';

// menangkap data yang di kirim dari form
$nama_petugas = $_POST['nama_petugas'];
$username = $_POST['username'];
$password = $_POST['password'];
$id_level = $_POST['id_level'];

// menginput data ke database
//mysqli_query($koneksi,"insert into tb_petugas values('','$nama_petugas','$username','$password','$id_level')");
mysqli_query($koneksi,"CALL AddPetugas('$nama_petugas','$username','$password','$id_level')");
//CALL AddPetugas('fani', 'fani', 123456, 1);
// mengalihkan halaman kembali ke index.php
header("location:petugas.php?info=simpan");

?>
<?php 
session_start();

  // cek apakah yang mengakses halaman ini sudah login
if($_SESSION['id_level']==""){
  header("location:../login.php?info=login");
}

?>
<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
  <div class="container">
    <a href="#" class="navbar-brand">
      <img src="../assets/dist/img/e.jpeg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Online Ehek Auction</span>
    </a>

    <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <?php if ($_SESSION['id_level']=="1") { ?>
      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <ul class="navbar-nav">
          <!-- Menu Khusus admin -->
          <li class="nav-item">
            <a href="index.php" class="nav-link">Home</a>
          </li>
          <!-- Menu Khusus Petugas dan Admin -->
          <li class="nav-item">
            <a href="barang.php" class="nav-link">Pendataan Barang</a>
          </li>
          <!-- Menu Khusus admin -->
          <li class="nav-item">
            <a href="petugas.php" class="nav-link">Data Petugas</a>
          </li>
          <!-- Menu Khusus Petugas dan Admin -->
          <li class="nav-item">
            <a href="laporan.php" class="nav-link">Laporan</a>
          </li>
        </ul>
      </div>
    <?php } else { ?>
      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <ul class="navbar-nav">
          <!-- Menu Khusus admin -->
          <li class="nav-item">
            <a href="index.php" class="nav-link">Home</a>
          </li>
          <!-- Menu Khusus Petugas dan Admin -->
          <li class="nav-item">
            <a href="barang.php" class="nav-link">Pendataan Barang</a>
          </li>
          <!-- Menu Khusus Petugas -->
          <li class="nav-item">
            <a href="aktivasi.php" class="nav-link">Aktivasi Lelang</a>
          </li>
          <!-- Menu Khusus Petugas dan Admin -->
          <li class="nav-item">
            <a href="laporan.php" class="nav-link">Laporan</a>
          </li>          
        </ul>
      </div>
    <?php } ?>

    <!-- Right navbar links -->
    <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="../logout.php" role="button">
          <i class="fas fa-user"></i> Logout
        </a>
      </li>
    </ul>
  </div>
</nav>
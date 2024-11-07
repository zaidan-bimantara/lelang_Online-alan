
<?php 
include '../layouts/header.php';
include '../layouts/navbar_masyarakat.php';
?>

<!-- /.navbar -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> Penawaran</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container">
      <div class="row">
        <!-- /.col-md-6 -->
        <?php
        $no = 1;
        include "../koneksi.php";
        $tb_lelang    =mysqli_query($koneksi, "SELECT * FROM tb_lelang INNER JOIN tb_barang ON tb_lelang.id_barang=tb_barang.id_barang INNER JOIN tb_petugas ON tb_lelang.id_petugas=tb_petugas.id_petugas");
        while($d_tb_lelang = mysqli_fetch_array($tb_lelang)){
          if ($d_tb_lelang['status'] == 'dibuka') { ?>
            <div class="col-lg-3">
              <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                  <div class="text-center">
                  </div>

                  <h3 class="profile-username text-center"><?=$d_tb_lelang['nama_barang']?></h3>


                  <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                      <b>Tanggal</b> <a class="float-right"><?=$d_tb_lelang['tgl']?></a>
                    </li>
                    <li class="list-group-item">
                      <b>Harga Awal</b> <a class="float-right">Rp. <?= number_format($d_tb_lelang['harga_awal'])?></a>
                    </li>
                    <li class="list-group-item">
                      <b>Deskripsi Barang</b> <a class="float-right"><?=$d_tb_lelang['deskripsi_barang']?></a>
                    </li>              
                  <!--<li class="list-group-item">
                    <b>Oleh</b> <a class="float-right">Nama Penawar Tertinggi</a>
                  </li>-->
                </ul>

                <div class="row">
                  <div class="col-sm-12">
                    <a href="#" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modal-tawar<?php echo $d_tb_lelang['id_lelang'];?>"><b>Ikut Lelang</b></a>
                  </div>
                </div>

                <div class="modal fade" id="modal-tawar<?php echo $d_tb_lelang['id_lelang'];?>">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Masukan Jumlah Tawaran</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <form method="post" action="simpan_penawaran.php">
                        <div class="modal-body">
                          <div class="form-group">
                            <input type="text" name="id_lelang" value="<?php echo $d_tb_lelang['id_lelang'];?>" hidden>
                            <input type="text" name="id_barang" value="<?php echo $d_tb_lelang['id_barang'];?>" hidden>
                          </div>
                          <?php
                          include "../koneksi.php";
                          $tb_masyarakat    =mysqli_query($koneksi, "SELECT * FROM tb_masyarakat where username='$_SESSION[username]'");
                          while($d_tb_masyarakat = mysqli_fetch_array($tb_masyarakat)){
                            ?>
                            <div class="form-group">
                              <label>Nominal Tawaran</label>
                              <input type="text" name="id_user" value="<?php echo $d_tb_masyarakat['id_user'];?>" hidden>
                              <input type="text" class="form-control" name="penawaran_harga" placeholder="Silahkan Masukan Tawaran Anda ...">
                            </div>
                          <?php } ?>
                        </div>
                        <div class="modal-footer justify-content-between">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Tawar</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>  
        <?php } else { ?>
        <?php }} ?>   
        <!-- /.col-md-6 -->
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <h5>Sejarah Penawaran</h5>
            </div>
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Nama Barang</th>
                    <th>Harga Awal</th>
                    <th>Tawaran Harga</th>
                    <th>Status Lelang</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  include "../koneksi.php";
                  $history_lelang    =mysqli_query($koneksi, "SELECT * FROM history_lelang INNER JOIN tb_barang oN history_lelang.id_barang=tb_barang.id_barang INNER JOIN tb_masyarakat oN history_lelang.id_user=tb_masyarakat.id_user INNER JOIN tb_lelang oN history_lelang.id_lelang=tb_lelang.id_lelang");
                  while($d_history_lelang = mysqli_fetch_array($history_lelang)){              
                    ?>
                    <?php if ($d_history_lelang['username'] == $_SESSION['username']) { ?>
                      <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?=$d_history_lelang['nama_barang']?></td>
                        <td>Rp. <?= number_format($d_history_lelang['harga_awal'])?></td>
                        <td>Rp. <?= number_format($d_history_lelang['penawaran_harga'])?></td>
                        <td>  
                          <?php if ($d_history_lelang['penawaran_harga'] == $d_history_lelang['harga_akhir']) { ?>
                            <div class="btn btn-success">Selamat Anda Memenangkan Lelang</div>
                          <?php } else { ?>
                            -
                          <?php } ?>          
                        </td>
                        <td>
                          <?php if ($d_history_lelang['status'] == 'dibuka') { ?>
                            <button type="submit" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-ubah<?php echo $d_history_lelang['id_history']; ?>">
                              <i class="fas fa-edit"></i> Edit
                            </button>
                            <button type="submit" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-hapus<?php echo $d_history_lelang['id_history']; ?>">
                              <i class="fas fa-trash"></i> Hapus
                            </button>
                          <?php } else { ?>
                          <?php } ?>                          
                        </td>
                      </tr>
                      <div class="modal fade" id="modal-hapus<?php echo $d_history_lelang['id_history']; ?>">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">Hapus Data Lelang</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <form>
                              <div class="modal-body">
                                <p>Apakah Anda Yakin Akan Menghapus Data <b><?=$d_history_lelang['nama_barang']?></b> !!!</p>
                              </div>
                              <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <a href="hapus_penawaran.php?id_history=<?php echo $d_history_lelang['id_history']; ?>" class="btn btn-primary">Hapus</a>
                              </div>
                            </form>
                          </div>
                          <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                      </div>

                      <div class="modal fade" id="modal-ubah<?php echo $d_history_lelang['id_history']; ?>">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">Edit Data Lelang</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <form method="post" action="update_penawaran.php">
                              <div class="modal-body">
                                <div class="form-group">
                                  <input type="text" name="id_history" value="<?php echo $d_history_lelang['id_history']; ?>" hidden>
                                </div>
                                <div class="form-group">
                                  <label>Penawaran Harga</label>
                                  <input type="number" class="form-control" name="penawaran_harga" value="<?php echo $d_history_lelang['penawaran_harga']; ?>" placeholder="Masukan Penawan Harga ...">
                                </div>
                              </div>
                              <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                              </div>
                            </form>
                          </div>
                          <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                      </div>
                    <?php } else { ?>
                    <?php } } ?>
                  </tbody>
                </table> 
              </div>
            </div>
          </div>
        </div>      
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php 
  include '../layouts/footer.php';
  ?>
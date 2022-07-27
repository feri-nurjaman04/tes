<?php 
require 'function.php';
require 'login/cek.php';

$data = query("SELECT * FROM tb_barang ORDER BY idbarang DESC");

// Query untuk jumlah total stok
$totalstok = query("SELECT SUM(stok) AS total_stok FROM tb_barang")[0];

// Query Untuk jumlah total masuk
$totalmasuk = query("SELECT SUM(jumlah) AS total FROM tb_masuk")[0];

// Query untuk jumlah barang dipinjam
$totalpinjam = query("SELECT SUM(jumlah) AS total FROM tb_pinjam")[0];

// Query untuk jumlah total akun
$totalcatatan = query("SELECT SUM(jumlah) AS total FROM catatan")[0];

// Username Akun
$username = $_SESSION['username'];

if(isset($_POST['submit'])){
    if(insert($_POST)==true){
        header('location:index.php');
    }
}

if(isset($_POST['edit'])){
    if(update_barang($_POST)==true){
        header('location:index.php');
    }
}

error_reporting(0);
$id = $_GET['idbarang'];
if(hapus_barang($id)> 0){
    header('location:index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>TKJ LOOTBOX</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet"/>
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>

        <!-- Aset modal -->
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="../index.php">TKJ LOOTBOX</a>

            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>

            <!-- Tambahan supaya tampilan jadi mobile friendly-->
            <div class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            </div>

            <!-- dropdown -->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <?php if($_SESSION['level'] == 'admin'): ?>
                            <li><a class="dropdown-item" href="admin/akun.php">Account</a></li>
                        <?php else: ?>
                        <?php endif; ?>
                        <li><a class="dropdown-item" href="admin/fitur.php">Version</a></li>
                        <li class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="login/logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark bg-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Navigasi</div>
                            <a class="nav-link active" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                                Dashboard
                            </a>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
                                Transaksi
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="transaksi/pinjam.php">
                                            Peminjaman Barang
                                        </a>
                                        <a class="nav-link" href="transaksi/masuk.php">
                                            Pengembalian Barang
                                        </a>
                                        <a class="nav-link" href="transaksi/note.php">
                                            Catatan Tambahan
                                        </a>
                                    </nav>
                                </div>
                                <a class="nav-link" href="admin/siswa.php">
                                    <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                                    Siswa
                                </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Login Sebagai:</div>
                        <?= $username; ?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard <?= $_SESSION['level']; ?></h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item">TKJ LOOTBOX</li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-header">
                                        Total Barang Tersedia
                                    </div>
                                    <div class="card-body">
                                        <h3><?= $totalstok['total_stok'] + 0; ?> unit</h3>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="index.php">Selengkapnya</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-secondary text-white mb-4">
                                    <div class="card-header">
                                        Total Barang Keluar
                                    </div>
                                    <div class="card-body">
                                        <h3><?= $totalpinjam['total'] + 0; ?> unit</h3>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="transaksi/pinjam.php">Selengkapnya</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-header">
                                        Total Barang Masuk
                                    </div>
                                    <div class="card-body">
                                        <h3><?= $totalmasuk['total'] + 0; ?> unit</h3>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="transaksi/masuk.php">Selengkapnya</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-header">
                                        Total Barang Bermasalah
                                    </div>
                                    <div class="card-body">
                                        <h3><?= $totalcatatan['total'] + 0; ?> unit</h3>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="transaksi/note.php">Selengkapnya</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header" style="display: flex; justify-content:space-between;">
                                <div>
                                    <i class="fas fa-table me-1"></i>
                                    Inventaris
                                </div>
                                <div>
                                    <!-- Button untuk tambah stok -->
                                    <?php if($_SESSION['level']== 'admin'): ?>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#stok">
                                            <i class="fas fa-plus"></i>
                                            Tambah
                                        </button>
                                        <?php else: ?>
                                        <?php endif; ?>
                                </div>
                            </div>
                            
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Barang</th>
                                            <th>Stok Tersedia</th>
                                            <?php if($_SESSION['level'] == 'admin'): ?>
                                                <th>Aksi</th>
                                            <?php else: ?>
                                            <?php endif; ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        <?php foreach($data as $dt): ?>
                                            <tr>
                                                
                                                <td><?= $no; ?>.</td>
                                                <td><?= $dt['nama_barang']; ?></td>
                                                <td><?= $dt['stok']; ?></td>
                                                <?php if($_SESSION['level'] == 'admin'): ?>
                                                    <td>
                                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#ubahData<?=$dt['idbarang'];?>">
                                                            <i class="fas fa-edit"></i>
                                                            Edit
                                                        </button>
    
                                                        <!-- EDIT DATA -->
                                                        <div class="modal fade" id="ubahData<?=$dt['idbarang'];?>">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">                                                
                                                                    <!-- Modal Header -->
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title" style="text-align:center; width:100%;">
                                                                            Edit Data <?= $dt['nama_barang']; ?>?
                                                                        </h4>
                                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    </div>
                                                                    
                                                                    <!-- Modal body -->                        
                                                                    <div class="modal-body">
                                                                        <form method="post">
    
                                                                            <input type="hidden" name="idbarang" value="<?=$dt['idbarang'];?>">
                                                                            <label for="jumlah">Jumlah</label>
                                                                            <input class="form-control" type="number" min="1" autocomplete="off" name="jumlah" id="jumlah" required placeholder="Masukan Jumlah Barang">   
                                                                            <br>
                                                                            <div class="tombol" style="display: flex; justify-content:space-between; flex-direction:row-reverse;">
                                                                                <button name="edit" class="btn btn-warning">
                                                                                    Update
                                                                                </button>
                                                                            </form>
                                                                            
                                                                            <a href="index.php?idbarang=<?=$dt['idbarang'];?>" class="btn btn-danger" onclick="return confirm('Apakah Anda Yakin?')">
                                                                                Delete
                                                                            </a>
                                                                        </div>
    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                <?php else: ?>
                                                <?php endif; ?>
                                            </tr>
                                        </div>
                                        <?php $no++ ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> 
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">&copy;Develop with &#10084; by Feri Nurjaman.</div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
<?php if($_SESSION['level']== 'admin'): ?>
    <!-- The Modal -->
  <div class="modal fade" id="stok">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title" style="text-align:center; width:100%;">Tambahkan Stok</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <form method="post">
            <label for="nama">Nama Barang</label>
            <input class="form-control" type="text" name="nama" autocomplete="off"id="nama" required placeholder="Masukan Nama Barang">
                <br>
            <label for="jumlah">Jumlah</label>
            <input class="form-control" type="number" min="1" autocomplete="off" name="jumlah" id="jumlah" required placeholder="Masukan Jumlah Barang">  
                <br>
            <button class="btn btn-primary" name="submit">Submit</button>
          </form>
        </div>
        
      </div>
    </div>
  </div>
<?php else: ?>
<?php endif; ?>
</html>

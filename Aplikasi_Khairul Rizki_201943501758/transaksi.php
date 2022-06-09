<?php
require 'function.php';
require 'ceklog.php'
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>INDONESIAN PRIDE STORE</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">INDONESIAN PRIDE STORE</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Menu</div>
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-layer-group"></i></div>
                            STOK BARANG
                        </a>
                        <a class="nav-link" href="transaksi.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-user-tie"></i></div>
                            TRANSAKSI
                        </a>
                        <a class="nav-link" href="pegawai.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-shopping-bag"></i></div>
                            DATA PEGAWAI
                        </a>
                        <a class="nav-link" href="pembeli.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-credit-card"></i></div>
                            DATA CUSTOMER
                        </a>
                        <a class="nav-link" href="logout.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-sign-out-alt"></i></div>
                            LOGOUT
                        </a>
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <h1 class="mt-4">Daftar Transaksi</h1>
                    <div class="card mb-4">
                        <div class="card-header">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#transaksimodal">
                                Tambah Transaksi
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Tanggal</th>
                                            <th>Nama Customer</th>
                                            <th>Nama Pegawai</th>
                                            <th>Nama Barang</th>
                                            <th>Jumlah</th>
                                            <th>Harga</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $viewtransaksi = mysqli_query($conn, "SELECT * FROM transaksi LEFT JOIN barang ON transaksi.id_brg=barang.id_brg LEFT JOIN pegawai ON transaksi.id_pegawai=pegawai.id_pegawai LEFT JOIN customer ON transaksi.id_customer=customer.id_customer");

                                        while ($data = mysqli_fetch_array($viewtransaksi)) {
                                            $idtransaksi = $data['id_transaksi'];
                                            $tanggal = $data['tanggal'];
                                            $nama_customer = $data['nama_cust'];
                                            $nama_pegawai = $data['nama_peg'];
                                            $nama_barang = $data['nama_brg'];
                                            $jumlah = $data['jumlah'];
                                            $total_harga = $data['total'];
                                            $idpembeli = $data['id_customer'];
                                            $idpegawai = $data['id_pegawai'];
                                            $id_brg = $data['id_brg'];

                                        ?>
                                            <tr>
                                                <td><?= $idtransaksi; ?></td>
                                                <td><?= $tanggal; ?></td>
                                                <td><?= $nama_customer; ?></td>
                                                <td><?= $nama_pegawai; ?></td>
                                                <td><?= $nama_barang; ?></td>
                                                <td><?= $jumlah; ?></td>
                                                <td>Rp <?= $total_harga; ?></td>
                                                <td>
                                                    <button style="margin: 2px;" type="button" class="btn btn-danger" data-toggle="modal" data-target="#deletetransaksi<?= $idtransaksi; ?>">Hapus</button>
                                                </td>
                                            </tr>

                                            <!-- delete modal untuk transaksi -->
                                            <div class="modal fade" id="deletetransaksi<?= $idtransaksi; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Hapus Data Transaksi</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form method="POST">
                                                            <div class="modal-body">
                                                                <fieldset disabled>
                                                                    <input type="text" value="<?= $idtransaksi; ?>" class="form-control">
                                                                    <br />
                                                                    <input type="text" value="<?= $nama_pegawai; ?>" class="form-control">
                                                                    <br />
                                                                    <input type="text" value="<?= $nama_barang; ?>" class="form-control">
                                                                    <br>
                                                                    <input type="text" value="<?= $total_harga; ?>" class="form-control">
                                                                    <br />
                                                                </fieldset>
                                                                <br />
                                                                Apakah anda ingin menghapus data transaksi ini?
                                                                <br />
                                                                <br />
                                                                <input type="hidden" name="id_transaksi" value="<?= $idtransaksi; ?>">
                                                                <input type="hidden" name="id_brg" value="<?= $id_brg; ?>">
                                                                <input type="hidden" name="jumlah" value="<?= $jumlah; ?>">
                                                                <button type="submit" name="deletetransaksi" class="btn btn-danger">Hapus</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- delete modal untuk transaksi -->

                                        <?php
                                        };

                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; <a style="text-decoration:none;">Khairul Rizki (201943501758)</a></div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/datatables-demo.js"></script>
</body>

<!-- Modal -->
<div class="modal fade" id="transaksimodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <select name="pembeli" class="form-control">
                        <option selected value="<?= $idpembeli; ?>">Pilih Pembeli</option>
                        <?php
                        $tampilanpembeli = mysqli_query($conn, "SELECT * FROM customer");
                        while ($fetcharray = mysqli_fetch_array($tampilanpembeli)) {
                            $nama_list = $fetcharray['nama_cust'];
                            $idpembeli = $fetcharray['id_customer'];
                        ?>
                            <option value="<?= $idpembeli; ?>"><?= $nama_list; ?></option>

                        <?php
                        }
                        ?>
                    </select>
                    <br />
                    <select name="pgw" class="form-control">
                        <option selected value="<?= $idpegawai; ?>">Pilih Pegawai</option>
                        <?php
                        $tampilanpegawai = mysqli_query($conn, "select * from pegawai");
                        while ($fetcharray = mysqli_fetch_array($tampilanpegawai)) {
                            $namapegawai = $fetcharray['nama_peg'];
                            $idpgw = $fetcharray['id_pegawai'];
                        ?>
                            <option value="<?= $idpgw; ?>"><?= $namapegawai; ?></option>

                        <?php
                        }
                        ?>
                    </select>
                    <br>
                    <select name="barang" class="form-control " id="barang" required>
                        <option selected>Pilih Barang</option>
                        <?php
                        $tampilanbrg = mysqli_query($conn, "select * from barang");
                        while ($d = mysqli_fetch_array($tampilanbrg)) {
                        ?>
                            <option value="<?php echo $d['id_brg'] ?>_<?php echo $d['harga'] ?>"> 
                                <?php echo $d['nama_brg'] ?>, <?php echo $d['harga'] ?>, <?php echo $d['stok'] ?>
                            </option>
                        <?php
                        }
                        ?>
                    </select>
                    <br />
                    <input type="number" name="jumlah" placeholder="Jumlah" id="jumlah" class="form-control">
                    <br />
                    <input type="number" name="harga" placeholder="Harga" class="form-control harga">
                    <br />
                    <button type="submit" name="savetransaksi" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->

</html>

<script>
    var data = 0;
    var jumlah = 0;
    var total = 0;
    $('#barang, #jumlah').on('change input', function() {
        var data = $('#barang').val().split('_') || 0;
        var jumlah = $('#jumlah').val() || 0;
        var total = data[1] * jumlah;
        $('.harga').val(total);
    });
</script>
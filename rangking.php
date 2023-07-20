<?
include_once "session.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPK SAW METHOD</title>

    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="css/local.css" />
	<link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap.min.css" />

    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

    <!-- you need to include the shieldui css and js assets in order for the charts to work -->
    <link rel="stylesheet" type="text/css" href="https://www.shieldui.com/shared/components/latest/css/light-bootstrap/all.min.css" />
    <script type="text/javascript" src="https://www.shieldui.com/shared/components/latest/js/shieldui-all.min.js"></script>
    <script type="text/javascript" src="https://www.prepbootstrap.com/Content/js/gridData.js"></script>
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">SPK SAW METHOD</a>
            </div>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li><a href="index.php"><i class="fa fa-home"></i> BERANDA</a></li>
                    <li><a href="nilai.php"><i class="fa fa-list-ol"></i> NILAI</a></li>
                    <li><a href="kriteria.php"><i class="fa fa-bar-chart-o"></i> KRITERIA</a></li>
                    <li><a href="alternatif.php"><i class="fa fa-tasks"></i> ALTERNATIF</a></li>
                    <li class="active"><a href="rangking.php"><i class="fa fa-calculator"></i> PERANGKINGAN</a></li>
                    <li><a href="grafik.php"><i class="fa fa-bar-chart"></i> GRAFIK RANGKING</a></li>
                    <li><a href="laporan.php"><i class="fa fa-file"></i> LAPORAN</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right navbar-user">
                    <li class="dropdown user-dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['nama_lengkap'] ?><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="profil.php"><i class="fa fa-user"></i> Profile</a></li>
                            <li><a href="user.php"><i class="fa fa-database"></i> Data Pengguna</a></li>
                            <li class="divider"></li>
                            <li><a href="logout.php"><i class="fa fa-power-off"></i> Log Out</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header" style="margin-top:-30px;"><small>Perangkingan</small></h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <?php
include_once 'session.php';
include_once 'includes/alternatif.inc.php';
$pro1 = new Alternatif($db);
$stmt1 = $pro1->readAll();
include_once 'includes/kriteria.inc.php';
$pro2 = new Kriteria($db);
$stmt2 = $pro2->readAll();
include_once 'includes/rangking.inc.php';
$pro = new Rangking($db);
$stmt = $pro->readKhusus();
?>
	<br/>
	<div>
	
	  <!-- Nav tabs -->
	  <ul class="nav nav-tabs" role="tablist">
	    <li role="presentation" class="active"><a href="#lihat" aria-controls="lihat" role="tab" data-toggle="tab">Lihat Semua Data</a></li>
	    <li role="presentation"><a href="#rangking" aria-controls="rangking" role="tab" data-toggle="tab">Perangkingan</a></li>
	    <li role="presentation"><a href="rangking_baru.php" role="tab">Tambah Data</a></li>
	  </ul>
	
	  <!-- Tab panes -->
	  <div class="tab-content">
	    <div role="tabpanel" class="tab-pane active" id="lihat">
	    	<br/>
	    	<div class="row">
				<div class="col-md-6 text-left">
					<h4>Data Rangking</h4>
				</div>
				<div class="col-md-6 text-right">
					<button onClick="location.href='rangking_baru.php'" class="btn btn-primary">Tambah Data</button>
				</div>
			</div>
			<br/>
			<table width="100%" class="table table-striped table-bordered" id="tabeldata">
		        <thead>
		            <tr>
		                <th width="30px">No</th>
		                <th>Alternatif</th>
		                <th>Kriteria</th>
		                <th>Nilai</th>
		                <th width="100px">Aksi</th>
		            </tr>
		        </thead>
		
		        <tfoot>
		            <tr>
		                <th>No</th>
		                <th>Alternatif</th>
		                <th>Kriteria</th>
		                <th>Nilai</th>
		                <th>Aksi</th>
		            </tr>
		        </tfoot>
		
		        <tbody>
		<?php
		$no=1;
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		?>
		            <tr>
		                <td><?php echo $no++ ?></td>
		                <td><?php echo $row['nama_alternatif'] ?></td>
		                <td><?php echo $row['nama_kriteria'] ?></td>
		                <td><?php echo $row['nilai_rangking'] ?></td>
		                <td class="text-center">
							<a href="rangking_ubah.php?ia=<?php echo $row['id_alternatif'] ?>&ik=<?php echo $row['id_kriteria'] ?>" class="btn btn-warning"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
							<a href="rangking_hapus.php?ia=<?php echo $row['id_alternatif'] ?>&ik=<?php echo $row['id_kriteria'] ?>" onClick="return confirm('Yakin ingin menghapus data')" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
					    </td>
		            </tr>
		<?php
		}
		?>
		        </tbody>
		
		    </table>
		    		
	    </div>

	    <div role="tabpanel" class="tab-pane" id="rangking">
	    	<br/>
	    	<h4>Normalisasi R Perangkingan</h4>
			<table width="100%" class="table table-striped table-bordered">
		        <thead>
		            <tr>
		                <th rowspan="2" style="vertical-align: middle" class="text-center">Alternatif</th>
		                <th colspan="<?php echo $stmt2->rowCount(); ?>" class="text-center">Kriteria</th>
		                <th rowspan="2" style="vertical-align: middle" class="text-center">Hasil</th>
		            </tr>
		            <tr>
		            <?php
					while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
					?>
		                <th><?php echo $row2['nama_kriteria'] ?></th>
		            <?php
					}
					?>
		            </tr>
		        </thead>
		
		        <tbody>
		<?php
		while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)){
		?>
		            <tr>
		                <th><?php echo $row1['nama_alternatif'] ?></th>
		                <?php
		                $a= $row1['id_alternatif'];
						$stmtr = $pro->readR($a);
						while ($rowr = $stmtr->fetch(PDO::FETCH_ASSOC)){
							$b = $rowr['id_kriteria'];
							$tipe = $rowr['tipe_kriteria'];
							$bobot = $rowr['bobot_kriteria'];
						?>
		                <td>
		                	<?php 
		                	if($tipe=='benefit'){
		                		$stmtmax = $pro->readMax($b);
								$maxnr = $stmtmax->fetch(PDO::FETCH_ASSOC);
								echo $nor = $rowr['nilai_rangking']/$maxnr['mnr1'];
							} else{
								$stmtmin = $pro->readMin($b);
								$minnr = $stmtmin->fetch(PDO::FETCH_ASSOC);
								echo $nor = $minnr['mnr2']/$rowr['nilai_rangking'];
							}
							$pro->ia = $a;
							$pro->ik = $b;
							$pro->nn2 = $nor;
							$pro->nn3 = $bobot*$nor;
							$pro->normalisasi();
		                	?>
		                </td>
		                <?php
		                }
						?>
						<td>
							<?php 
							$stmthasil = $pro->readHasil($a);
							$hasil = $stmthasil->fetch(PDO::FETCH_ASSOC);
							echo $hasil['bbn'];
							$pro->ia = $a;
							$pro->has = $hasil['bbn'];
							$pro->hasil();
							?>
						</td>
		            </tr>
		<?php
		}
		?>
		        </tbody>
		
		    </table>
		    	
	    </div>
	  </div>
	
	</div>

                </div>
              </div>
            </div>
          </div>
        
    <!-- /#wrapper -->
</body>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery-1.11.3.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap.min.js"></script>
    <script>
    	$(document).ready(function() {

    		$('#tabeldata').DataTable();

		});
    </script>
</html>

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
                    <h1 class="page-header" style="margin-top:-30px;"><small>Ubah Perangkingan</small></h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
<?php
include_once 'session.php';
include_once 'includes/alternatif.inc.php';
include_once 'includes/kriteria.inc.php';
include_once 'includes/nilai.inc.php';
$pgn1 = new Alternatif($db);
$pgn2 = new Kriteria($db);
$pgn3 = new Nilai($db);

$ia = isset($_GET['ia']) ? $_GET['ia'] : die('ERROR: missing ID.');
$ik = isset($_GET['ik']) ? $_GET['ik'] : die('ERROR: missing ID.');

include_once 'includes/rangking.inc.php';
$eks = new Rangking($db);

$eks->ia = $ia;
$eks->ik = $ik;

$eks->readOne();

if($_POST){

	$eks->nn = $_POST['nn'];
	
	if($eks->update()){
		echo "<script>location.href='rangking.php'</script>";
	} else{
?>
<div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Gagal Ubah Data!</strong> Terjadi kesalahan, coba sekali lagi.
</div>
<?php
	}
}
?>
		<div class="row">
		  <div class="col-xs-12 col-sm-6 col-md-6">
		  <div class="well">
		  	<div class="page-header">
			  <h3>Ubah Rangking</h3>
			</div>
			
			    <form method="post">
				  <div class="form-group">
				    <label for="nn">Nilai</label>
				    <select class="form-control" id="nn" name="nn">
				    	<option><?php echo $eks->nn; ?></option>
				    	<?php
						$stmt4 = $pgn3->readAll();
						while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)){
							extract($row4);
							echo "<option value='{$jum_nilai}'>{$ket_nilai}</option>";
						}
					    ?>
				    </select>
				  </div>
				  <button type="submit" class="btn btn-primary">Ubah</button>
				  <button type="button" onClick="location.href='rangking.php'" class="btn btn-success">Kembali</button>
				</form>
			  
		  </div>
		  </div>
		  
       </div>
      </div>
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

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

    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

    <!-- you need to include the shieldui css and js assets in order for the charts to work -->
    <link rel="stylesheet" type="text/css" href="https://www.shieldui.com/shared/components/latest/css/light-bootstrap/all.min.css" />
    <script type="text/javascript" src="https://www.shieldui.com/shared/components/latest/js/shieldui-all.min.js"></script>
    <script type="text/javascript" src="https://www.prepbootstrap.com/Content/js/gridData.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
                    <li class="active"><a href="index.php"><i class="fa fa-home"></i> BERANDA</a></li>
                    <li><a href="nilai.php"><i class="fa fa-list-ol"></i> NILAI</a></li>
                    <li><a href="kriteria.php"><i class="fa fa-bar-chart-o"></i> KRITERIA</a></li>
                    <li><a href="alternatif.php"><i class="fa fa-tasks"></i> ALTERNATIF</a></li>
                    <li><a href="rangking.php"><i class="fa fa-calculator"></i> PERANGKINGAN</a></li>
                    <li><a href="grafik.php"><i class="fa fa-bar-chart"></i> GRAFIK RANGKING</a></li>
                    <li><a href="laporan.php"><i class="fa fa-file"></i> LAPORAN</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right navbar-user">
                    <li class="dropdown user-dropdown">
                        <a href="profil.php" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['nama_lengkap'] ?><b class="caret"></b></a>
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
                    <h1 class="page-header" style="margin-top:-30px;"><small>Beranda</small></h1>
                </div>
            </div>
			<div class="row">
                <!-- Welcome -->
                <div class="col-lg-12">
                <div class="alert alert-info alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-gg-circle"></i>  Selamat datang <b><?php echo $_SESSION['nama_lengkap'] ?> </b>
 dihalaman admin <b>Sistem Pendukung Keputusan Menggunakan Metode SAW </b>.
                        </div>
                </div>
                <!--end  Welcome -->
         
           		<div class="col-lg-12" style="font-size:18px;">
                  <?
                  include_once 'sidebar.php';
				  ?>
                </div>
          
            <div class="row">
                <div class="col-lg-12">
<?php
include_once 'includes/config.php';
include_once 'includes/nilai.inc.php';
$pro3 = new Nilai($db);
$stmt3 = $pro3->readAll();
include_once 'includes/alternatif.inc.php';
$pro1 = new Alternatif($db);
$stmt1 = $pro1->readAll();
$stmt4 = $pro1->readAll();
include_once 'includes/kriteria.inc.php';
$pro2 = new Kriteria($db);
$stmt2 = $pro2->readAll();
?>
		
		
		<div class="row">
		  <div class="col-xs-12 col-sm-12 col-md-4">
		  <div class="well" style="background-color:#044c92; color:#FFFFFF;">
		  	<div class="page-header" style="margin-top:-20px;">
			  <h3><a href="nilai.php">Data Nilai</a></h3>
			</div>
			    <ol style="margin-left:-24px;">
			    	<?php
					while ($row3 = $stmt3->fetch(PDO::FETCH_ASSOC)){
					?>
				  	<li><?php echo $row3['ket_nilai'] ?> (<?php echo $row3['jum_nilai'] ?>)</li>
				  	<?php
					}
				  	?>
				</ol>
			  </div>
		  </div>
		  <div class="col-xs-12 col-sm-12 col-md-4">
		  <div class="well" style="background-color:#044c92; color:#FFFFFF;">
		  	<div class="page-header" style="margin-top:-20px;">
			  <h3><a href="kriteria.php">Data Kriteria</a></h3>
			</div>
			    <ol style="margin-left:-24px;">
			    	<?php
					while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
					?>
				  	<li><?php echo $row2['nama_kriteria'] ?> (<?php echo $row2['bobot_kriteria'] ?>)</li>
				  	<?php
					}
				  	?>
				</ol>
			</div>
		  </div>
		  <div class="col-xs-12 col-sm-12 col-md-4">
		  <div class="well" style="background-color:#044c92; color:#FFFFFF;">
		  	<div class="page-header" style="margin-top:-20px;">
			  <h3><a href="alternatif.php">Data Alternatif</a></h3>
			</div>
			    <ol style="margin-left:-24px;">
			    	<?php
					while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)){
					?>
				  	<li><?php echo $row1['nama_alternatif'] ?></li>
				  	<?php
					}
				  	?>
				</ol>
			  </div>
		  </div>
		</div>
	</div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="js/jquery-1.11.3.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="js/highcharts.js"></script>
	<script src="js/exporting.js"></script>
	<script>
	var chart1; // globally available
	$(document).ready(function() {
	      chart1 = new Highcharts.Chart({
	         chart: {
	            renderTo: 'container2',
	            type: 'column'
	         },  
	         title: {
	            text: 'Grafik Hasil Rangking '
	         },
	         xAxis: {
	            categories: ['Alternatif']
	         },
	         yAxis: {
	            title: {
	               text: 'Jumlah Nilai'
	            }
	         },
	              series:            
	            [
	            <?php
	            while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)){
	                  ?>
	                 //data yang diambil dari database dimasukan ke variable nama dan data
	                 //
	                  {
	                      name: '<?php echo $row4['nama_alternatif'] ?>',
	                      data: [<?php echo $row4['hasil_alternatif'] ?>]
	                  },
	                  <?php } ?>
	            ]
	      });
	   });  
	   </script>
    <!-- /#wrapper -->
</body>
</html>

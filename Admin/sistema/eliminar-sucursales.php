<?php 
	session_start();

	include "../conexion.php";

	if(!empty($_POST)){

		$idSucursal = $_POST['idSucursal'];

    // Verificar si hay vehículos asociados a la sucursal
    $query_check = mysqli_query($conexion, "SELECT * FROM vehiculo WHERE fk_sucursal = $idSucursal");

    if (mysqli_num_rows($query_check) > 0) {
        // Mostrar mensaje de error si hay vehículos asociados a la sucursal
        echo'<script type="text/javascript"> alert("No se puede eliminar la sucursal ya que tiene vehículos asociados a ella.");
                    window.location.href="mod_baja-sucursales.php"; </script>';
    } else {
        // Si no hay vehículos asociados, proceder con la eliminación de la sucursal
        $query_delete = mysqli_query($conexion,"DELETE FROM sucursal WHERE OID =$idSucursal ");
        mysqli_close($conexion);
        if($query_delete){
          echo'<script type="text/javascript"> alert("La sucursal se ha eliminado correctamente.");
                        window.location.href="mod_baja-sucursales.php"; </script>';
        }else{
          $notificacion = "Error al intentar eliminar la sucursal.";
        }
      }
    }



	if(empty($_REQUEST['id']) )
	{
		header("location: mod_baja-sucursales.php");
		mysqli_close($conexion);
	}else{

		$idSucursal = $_REQUEST['id'];

		$query = mysqli_query($conexion,"SELECT s.nombre, s.localidad, (e.nombre) as empNombre, (p.nombre) as provincia FROM sucursal s
                                                INNER JOIN empresa e
                                                    ON s.fk_empresa = e.OID
                                                INNER JOIN provincia p
                                                    ON s.fk_provincia = p.OID
                                                WHERE s.OID = $idSucursal ");
		
		mysqli_close($conexion);
		$result = mysqli_num_rows($query);

		if($result > 0){
			while ($data = mysqli_fetch_array($query)) {
                
        
        //array(6) { [0]=> string(18) "Aeropuerto Ushuaia" ["nombre"]=> string(55) "Tierra del Fuego, Antártida e Islas del Atlántico Sur" [1]=> string(7) "Ushuaia" ["localidad"]=> string(7) "Ushuaia" [2]=> string(20) "Viajes Flamenco S.A." [3]=> string(55) "Tierra del Fuego, Antártida e Islas del Atlántico Sur" }
				
				$nombre = $data['nombre'];
				$localidad = $data['localidad'];
        $provincia = $data['provincia'];
				$empNombre = $data['empNombre'];
				
			}
		}else{
			echo'<script type="text/javascript"> alert("La sucursal ha eliminar no existe en la base de datos.");
                    window.location.href="mod_baja-sucursales.php"; </script>';
		}


	}


 ?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Sucursal / Eliminar - DS Travel</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin - v2.5.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <?php include "includes/header.php"; ?>

  <!-- ======= Sidebar ======= -->
  <?php include "includes/Sidebar.php"; ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <nav>
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="home.php"><i class="bi bi-house-door"></i></a></li>
          <li class="breadcrumb-item">Sucursal</li>
          <li class="breadcrumb-item active">Eliminar</li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title"></h5>
              <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <h4 class="alert-heading text-center">Eliminar Sucursal</h4>
                <hr>
                <p class="text-center">¿Está seguro que desea eliminar la siguiente sucursal?</p>
                <p class="mb-0 text-center">Nombre: <span><?php echo $nombre; ?></p>
                <p class="mb-0 text-center">Localidad: <span><?php echo $localidad; ?></p>
                <p class="mb-0 text-center">Provincia: <span><?php echo $provincia; ?></p>
                <p class="mb-0 text-center">Empresa: <span><?php echo $empNombre; ?></p>
                <hr>
                <form method="post" action="">
                <input type="hidden" name="idSucursal" value="<?php echo $idSucursal; ?>">
                    <div class="text-center">
                    <a href="mod_baja-sucursales.php" class="btn btn-secondary rounded-pill">Cancelar</a>
                    <input type="submit" value="Eliminar" class="btn btn-danger rounded-pill">
                    </div>
                </form>
              </div>
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>


  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php include "includes/header.php"; ?>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

  <script async="" src="https://www.googletagmanager.com/gtag/js?id=G-P7JSYB1CSP"></script>
  <script>
  if( window.self == window.top ) { 
    window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'G-P7JSYB1CSP'); 
    }
</script>
<svg id="SvgjsSvg1001" width="2" height="0" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" style="overflow: hidden; top: -100%; left: -100%; position: absolute; opacity: 0;">
    <defs id="SvgjsDefs1002"></defs>
    <polyline id="SvgjsPolyline1003" points="0,0"></polyline>
    <path id="SvgjsPath1004" d="M0 0 "></path>
</svg>


</body>

</html>
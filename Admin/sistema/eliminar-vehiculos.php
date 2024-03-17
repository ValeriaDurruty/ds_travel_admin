<?php 
	session_start();

	include "../conexion.php";

	if(!empty($_POST))
	{

		$idVehiculo = $_POST['idVehiculo'];

    // Verificar si hay registros relacionados en la tabla accesorios_vehiculo
    $query_check = mysqli_query($conexion, "SELECT * FROM accesorios_vehiculo WHERE fk_vehiculo = $idVehiculo");
    
    if (mysqli_num_rows($query_check) > 0) {
      // Mostrar mensaje de error si hay accesorios relacionados
      echo'<script type="text/javascript"> alert("El vehículo no se puede eliminar ya que tiene accesorios asociados. Elimine los accesorios primero.");
                    window.location.href="mod_baja-vehiculos.php"; </script>';
    }else{
      // Eliminar el vehículo
  		$query_delete = mysqli_query($conexion,"DELETE FROM vehiculo WHERE OID =$idVehiculo ");
	  	mysqli_close($conexion);
		  if($query_delete){
			  echo'<script type="text/javascript"> alert("El vehículo se ha eliminado correctamente.");
                    window.location.href="mod_baja-vehiculos.php"; </script>';
		  }else{
			  $notificacion = "Error al intentar eliminar el vehículo.";
		  }
    }
	}




	if(empty($_REQUEST['id']) )
	{
		header("location: mod_baja-vehiculos.php");
		mysqli_close($conexion);
	}else{

		$idVehiculo = $_REQUEST['id'];

		$query = mysqli_query($conexion,"SELECT v.nombre, v.marca, v.modelo, v.precioPorDia, v.capacidad, v.tipoCaja, v.aireAcondicionado, v.kilometrajeHabilitado, v.tipoCobertura, v.valoracion, s.localidad, (e.nombre) as empNombre FROM vehiculo v
                                                    INNER JOIN sucursal s
                                                        ON v.fk_sucursal = s.OID
                                                    INNER JOIN empresa e
                                                        ON s.fk_empresa = e.OID
                                                    WHERE v.OID = $idVehiculo ");
		
		mysqli_close($conexion);
		$result = mysqli_num_rows($query);

		if($result > 0){
			while ($data = mysqli_fetch_array($query)) {
                
        //array(23) { [0]=> string(7) "296 gtb" ["nombre"]=> string(10) "Hertz S.A." [1]=> string(7) "Ferrari" ["marca"]=> string(7) "Ferrari" [2]=> string(4) "2021" ["modelo"]=> string(4) "2021" [3]=> string(9) "150000.00" ["precioPorDia"]=> string(9) "150000.00" [4]=> string(1) "3" ["capacidad"]=> string(1) "3" [5]=> string(6) "Manual" ["tipoCaja"]=> string(6) "Manual" [6]=> string(1) "1" ["aireAcondicionado"]=> string(1) "1" [7]=> string(6) "200000" ["kilometrajeHabilitado"]=> string(6) "200000" [8]=> string(7) "Parcial" ["tipoCobertura"]=> string(7) "Parcial" [9]=> string(1) "5" ["valoracion"]=> string(1) "5" [10]=> string(23) "San Carlos de Bariloche" ["localidad"]=> string(23) "San Carlos de Bariloche" [11]=> string(10) "Hertz S.A." }
				
				$nombre = $data['nombre'];
				$marca = $data['marca'];
        $modelo = $data['modelo'];
				$precioPorDia = $data['precioPorDia'];
        $capacidad = $data['capacidad'];
				$tipoCaja = $data['tipoCaja'];
        $ac = $data['aireAcondicionado'];
				$km = $data['kilometrajeHabilitado'];
        $cobertura = $data['tipoCobertura'];
				$val = $data['valoracion'];
        $localidad = $data['localidad'];
				$empNombre = $data['empNombre'];
				
			}
		}else{
			echo'<script type="text/javascript"> alert("El vehículo ha eliminar no existe en la base de datos.");
                    window.location.href="mod_baja-vehiculos.php"; </script>';
		}


	}


 ?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Vehículo / Eliminar - DS Travel</title>
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
          <li class="breadcrumb-item">Vehículo</li>
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
                <h4 class="alert-heading text-center">Eliminar Vehículo</h4>
                <hr>
                <p class= "text-center">¿Está seguro que desea eliminar el siguiente vehículo?</p>
                <p class="mb-0 text-center">Nombre: <span><?php echo $nombre; ?></p>
                <p class="mb-0 text-center">Marca: <span><?php echo $marca; ?></p>
                <p class="mb-0 text-center">Modelo: <span><?php echo $modelo; ?></p>
                <p class="mb-0 text-center">Precio por día: <span>$<?php echo $precioPorDia; ?></p>
                <p class="mb-0 text-center">Capacidad: <span><?php echo $capacidad; ?></p>
                <p class="mb-0 text-center">Tipo de caja: <span><?php echo $tipoCaja; ?></p>
                <p class="mb-0 text-center">A/C: <span><?php if ($ac == 1) {echo 'Si';} else {echo 'No';}; ?></p>
                <p class="mb-0 text-center">Km. Habilitado: <span><?php echo $km; ?></p>
                <p class="mb-0 text-center">Cobertura: <span><?php echo $cobertura; ?></p>
                <p class="mb-0 text-center">Valoración: <span><?php echo $val; ?><img src="assets/img/star.png" width="20"></p>
                <p class="mb-0 text-center">Empresa: <span><?php echo $empNombre; ?></p>
                <p class="mb-0 text-center">Localidad: <span><?php echo $localidad; ?></p>
                <hr>
                <form method="post" action="">
                    <div class="text-center">
                    <input type="hidden" name="idVehiculo" value="<?php echo $idVehiculo; ?>">
                    <a href="mod_baja-vehiculos.php" class="btn btn-secondary rounded-pill">Cancelar</a>
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
<?php 
	session_start();

	include "../conexion.php";

  // EJECUTO LA SIGUIENTE CONSULTA PARA TRAER TODAS LAS EMPRESAS DISPONIBLES DE LA BD.
  $cmd = mysqli_query($conexion,"SELECT * FROM empresa");

  if(!empty($_POST))
	{

		$idSucursal = $_POST['idSucursal'];
    $nombre = $_POST['nombre'];
    $localidad = ucwords(strtolower($_POST['selectLocalidades']));
    $provincia = $_POST['selectProvincias'];
    $empresa = $_POST['empresa'];

    if(empty($nombre) || empty($empresa) || empty($localidad) || empty($provincia) ){
              $notificacion = "Error: No puede dejar campos vacíos.";
          }else{


    $sql_update = mysqli_query($conexion,"UPDATE sucursal
        SET nombre = '$nombre', localidad = '$localidad', fk_provincia = '$provincia', fk_empresa = '$empresa'
        WHERE OID = $idSucursal ");
   

    if($sql_update){
      echo'<script type="text/javascript"> alert("La sucursal se ha modificado correctamente.");
                    window.location.href="mod_baja-sucursales.php"; </script>';
    }else{
      echo'<script type="text/javascript"> alert("Error al intentar modificar la sucursal.");
                    window.location.href="mod_baja-sucursales.php"; </script>';
    }

    }}


//Chequeo el ID que se manda en la url, si no es vacio y existe recupero los datos para mostrarlos
	if(empty($_REQUEST['id']) )
	{
		header("location: mod_baja-sucursales.php");
		mysqli_close($conexion);
	}else{

		$idSucursal = $_REQUEST['id'];

		$query = mysqli_query($conexion,"SELECT (s.nombre) as nomSucursal, s.localidad, (p.nombre) as nomProvincia, s.fk_empresa, (e.nombre) as empNombre, s.fk_provincia
                                      FROM sucursal s
                                      INNER JOIN empresa e
                                      ON s.fk_empresa = e.OID
                                      INNER JOIN provincia p
                                      ON s.fk_provincia = p.OID WHERE s.OID = $idSucursal ");
		
		mysqli_close($conexion);
		$result = mysqli_num_rows($query);

		if($result > 0){
			while ($data = mysqli_fetch_array($query)) {
				
				$nomSucursal = $data['nomSucursal'];
				$localidad = $data['localidad'];
        $provincia = $data['nomProvincia'];
        $fk_emp = $data['fk_empresa'];
        $empNombre = $data['empNombre'];
        $fk_prov = $data['fk_provincia'];
				
			}
		}else{
			echo'<script type="text/javascript"> alert("La sucursal ha modificar no existe en la base de datos.");
                    window.location.href="mod_baja-sucursales.php"; </script>';
		}


	}


 ?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Sucursal / Editar - DS Travel</title>
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
          <li class="breadcrumb-item active">Editar</li>
        </ol>
      </nav>
    </div>

    <section class="section">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Editar Sucursal</h5>

              <?php 
                  if(isset($notificacion)){
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">'.$notificacion.'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
                    }
            	?>

              <!-- Vertical Form -->
              <form class="row g-3 needs-validation" method="POST" action="" novalidate>
                <div class="col-6">
                  <label for="nombre" class="form-label">Nombre <font color="red">*</font></label>
                  <input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $nomSucursal; ?>" required>
                  <div class="invalid-feedback">Por favor ingrese un nombre!</div>
                </div>
                <div class="col-md-6">
                  <label for="empresa" class="form-label">Empresa <font color="red">*</font></label>
                  <select id="empresa" name="empresa" class="form-select" required>
                    <option disabled="disabled" selected="selected"></option>
                    <option value="<?php echo $fk_emp; ?>" selected="selected"><?php echo $empNombre; ?></option>

                  <?php
                      while ($empresas = mysqli_fetch_array($cmd)) {
                        if ($empresas['OID'] != $fk_emp){
                      echo '<option value="'.$empresas['OID'].'">'.$empresas['nombre'].'</option>';
                      }}
                      ?>
                                            
                    </select>
                    <div class="invalid-feedback">Por favor seleccione una empresa!</div>
                </div>
                <div class="col-md-4">
                  <label for="selectProvincias" class="form-label">Provincia <font color="red">*</font></label>
                  <select name="selectProvincias" id="selectProvincias" class="form-select" required>
                    <option disabled="disabled" selected="selected"></option>
                    </select>
                    <div class="invalid-feedback">Por favor seleccione una opción!</div>
                </div>
                <div class="col-md-4">
                  <label for="selectMunicipios" class="form-label">Municipio <font color="red">*</font></label>
                  <select name="selectMunicipios" id="selectMunicipios" class="form-select" required>
                    <option disabled="disabled" selected="selected"></option>                                          
                    </select>
                    <div class="invalid-feedback">Por favor seleccione una opción!</div>
                </div>
                <div class="col-md-4">
                  <label for="selectLocalidades" class="form-label">Localidad <font color="red">*</font></label>
                  <select name="selectLocalidades" id="selectLocalidades" class="form-select" required>
                    <option disabled="disabled" selected="selected"></option>                    
                  </select>
                  <div class="invalid-feedback">Por favor seleccione una opción!</div>
                </div>
                <div class="col-md-4">
                  <input type="hidden" name="idSucursal" value="<?php echo $idSucursal; ?>">
                </div>
                <div class="text-center">
                  <a href="mod_baja-sucursales.php" class="btn btn-secondary">Cancelar</a>
                  <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
              </form><!-- Vertical Form -->

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

  <script src="assets/js/script-localidades.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>


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
<?php 
	session_start();

	include "../conexion.php";


	if(!empty($_POST))
	{

		$idAccesorio = $_POST['idAccesorio'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];

    if(empty($nombre) || empty($descripcion) || empty($precio) ){
              $notificacion = "Error: No puede dejar campos vacíos.";
          }else if(!is_numeric($precio)){
            $notificacion = "Error: El precio debe ser un número.";
          } else if(!is_string($nombre)){
              $notificacion = "Error: Ingrese un nombre válido.";
          }else if(!is_string($descripcion)){
            $notificacion = "Error: Ingrese una descripción válida.";
          }else{

    $sql_update = mysqli_query($conexion,"UPDATE accesorios 
    SET accesorio = '$nombre', descripcionAccesorio = '$descripcion', precioAccesorio = '$precio'
    WHERE idAccesorio  = $idAccesorio ");


    if($sql_update){
      echo'<script type="text/javascript"> alert("El accesorio se ha modificado correctamente.");
                    window.location.href="mod_baja-accesorios.php"; </script>';
    }else{
      echo'<script type="text/javascript"> alert("Error al intentar modificar el accesorio.");
                    window.location.href="mod_baja-accesorios.php"; </script>';
    }

	}}




	if(empty($_REQUEST['id']) )
	{
		header("location: mod_baja-accesorios.php");
		mysqli_close($conexion);
	}else{

		$idAccesorio = $_REQUEST['id'];
    

		$query = mysqli_query($conexion,"SELECT a.accesorio, a.descripcionAccesorio, a.precioAccesorio
												FROM accesorios a
												WHERE a.idAccesorio = $idAccesorio ");
		
		mysqli_close($conexion);
		$result = mysqli_num_rows($query);

		if($result > 0){
			while ($data = mysqli_fetch_array($query)) {
                
                // array(7) { [0]=> string(20) "Asiento Para infante" ["nombre"]=> string(17) "Car Freemium S.A." [1]=> string(86) "Asiento con orientación hacia atrás para infantes de 0 - 12 meses de edad y 0 a 3kg." ["descripcion"]=> string(86) "Asiento con orientación hacia atrás para infantes de 0 - 12 meses de edad y 0 a 3kg." [2]=> string(7) "1250.00" ["precio"]=> string(7) "1250.00" [3]=> string(17) "Car Freemium S.A." }
				
				$nombre = $data['accesorio'];
				$descripcion = $data['descripcionAccesorio'];
        $precio = $data['precioAccesorio'];

				
			}
		}else{
			echo'<script type="text/javascript"> alert("El accesorio ha modificar no existe en la base de datos.");
                    window.location.href="mod_baja-accesorios.php"; </script>';
		}


	}


 ?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Accesorio / Editar - DS Travel</title>
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
          <li class="breadcrumb-item">Accesorios</li>
          <li class="breadcrumb-item active">Editar</li>
        </ol>
      </nav>
    </div>

    <section class="section">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Editar Accesorio</h5>

                <?php 
                  if(isset($notificacion)){
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">'.$notificacion.'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
                    }
            	    ?>

              <!-- Vertical Form -->
              <form class="row g-3 needs-validation" method="POST" action="" novalidate>
                <div class="col-12">
                  <label for="nombre" class="form-label">Nombre <font color="red">*</font></label>
                  <input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $nombre; ?>" required>
                  <div class="invalid-feedback">Por favor ingrese un nombre!</div>
                </div>
                <div class="col-12">
                  <label for="inputPassword" class="col-sm-2 col-form-label">Descripción</label>
                  <div class="col-sm-12">
                    <textarea type="text" class="form-control" name="descripcion" id="descripcion" style="height: 100px"><?php echo $descripcion; ?></textarea>
                  </div>
                </div>
                <div class="col-12">
                  <label for="nombre" class="form-label">Precio <font color="red">*</font></label>
                  <input type="number" class="form-control" name="precio" id="precio" value="<?php echo $precio; ?>" step=".01" min="100" required>
                  <div class="invalid-feedback">Por favor ingrese un precio mayor a 100.00!</div>
                </div>
                <div class="col-md-6">
                  <input type="hidden" name="idAccesorio" value="<?php echo $idAccesorio; ?>">
                </div>
                <div class="text-center">
                  <a href="mod_baja-accesorios.php" class="btn btn-secondary">Cancelar</a>
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
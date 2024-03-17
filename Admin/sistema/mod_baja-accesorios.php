<?php

session_start();

if(!isset($_SESSION['idUser'])){
  header('location:index.php');
}else if($_SESSION['fk_rol'] == 1){
header('location:https://localhost/proyectos/sistema_vehiculos/home.php');
}


include "../conexion.php";	

$cmd = mysqli_query($conexion,"SELECT * FROM accesorios");

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Accesorios / Editar - Eliminar - DS Travel</title>
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
          <li class="breadcrumb-item active">Editar / Eliminar</li>
        </ol>
      </nav>
    </div>

    <section class="section">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Editar / Eliminar Accesorios</h5>

              <div class="search-bar" style="float: right">
                <form class="search-form d-flex align-items-center" method="GET" action="buscar_accesorio.php">
                  <input type="text" name="busqueda" id="busqueda" placeholder="Buscar" title="Enter search keyword">
                  <button type="submit" title="Search"><i class="bi bi-search"></i></button>
                </form>
              </div><!-- End Search Bar -->


                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th scope="col" data-sortable="">
                          <a href="#" class=""># ID</a>
                        </th>
                        <th scope="col" data-sortable="">
                          <a href="#" class="">Nombre</a>
                        </th>
                        <th scope="col" data-sortable="">
                          <a href="#" class="">Descripción</a>
                        </th>
                        <th scope="col" data-sortable="">
                          <a href="#" class="">Precio</a>
                        </th>
                        <th scope="col" data-sortable="">
                          <a href="#" class="">Acciones</a>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php while ($accesorios = mysqli_fetch_array($cmd)) {
                        ?>
                      <tr>
                        <th scope="row"><?php echo $accesorios['idAccesorio']; ?></th>
                        <td><?php echo $accesorios['accesorio']; ?></td>
                        <td><?php echo ($accesorios['descripcionAccesorio']); ?></td>
                        <td>$ <?php echo ($accesorios['precioAccesorio']); ?></td>
                        <td>
						    <a href="editar-accesorios.php?id=<?php echo $accesorios["idAccesorio"]; ?>"><button type="button" class="btn btn-primary">Editar</button></a>
						    <a href="eliminar-accesorios.php?id=<?php echo $accesorios["idAccesorio"]; ?>"><button type="button" class="btn btn-danger">Eliminar</button></a>	
					    </td>
                        </tr>
                        <?php };?>
                    </tbody>
                  </table>

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
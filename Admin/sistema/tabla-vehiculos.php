<?php

	session_start();

include "../conexion.php";	

// EJECUTO LA SIGUIENTE CONSULTA PARA TRAER TODOS LOS VEHÍCULOS DISPONIBLES DE LA BD.
$cmd = mysqli_query($conexion,"SELECT * FROM vehiculo");

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Vehiculos / Ver - DS Travel</title>
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
          <li class="breadcrumb-item">Vehículos</li>
          <li class="breadcrumb-item active">Ver</li>
        </ol>
      </nav>
    </div>

    <section class="section">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Lista Vehículos</h5>
             
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
                          <a href="#" class="">Marca</a>
                        </th>
                        <th scope="col" data-sortable="">
                          <a href="#" class="">Modelo</a>
                        </th>
                        <th scope="col" data-sortable="">
                          <a href="#" class="">Precio por día</a>
                        </th>
                        <th scope="col" data-sortable="">
                          <a href="#" class="">Capacidad</a>
                        </th>
                        <th scope="col" data-sortable="">
                          <a href="#" class="">Tipo de Caja</a>
                        </th>
                        <th scope="col" data-sortable="">
                          <a href="#" class="">A/C</a>
                        </th>
                        <th scope="col" data-sortable="">
                          <a href="#" class="">Km. Habilitado</a>
                        </th>
                        <th scope="col" data-sortable="">
                          <a href="#" class="">Cobertura</a>
                        </th>
                        <th scope="col" data-sortable="">
                          <a href="#" class="">Valoración</a>
                        </th>
                        <th scope="col" data-sortable="">
                          <a href="#" class="">Empresa</a>
                        </th>
                        <th scope="col" data-sortable="">
                          <a href="#" class="">Localidad</a>
                        </th>
                        <th scope="col" data-sortable="">
                          <a href="#" class="">Imagen</a>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php while ($vehiculos = mysqli_fetch_array($cmd)) {
                        ?>
                      <tr>
                        <th scope="row"><?php echo $vehiculos['OID']; ?></th>
                        <td><?php echo $vehiculos['nombre']; ?></td>
                        <td><?php echo $vehiculos['marca']; ?></td>
                        <td><?php echo $vehiculos['modelo']; ?></td>
                        <td>$ <?php echo $vehiculos['precioPorDia']; ?></td>
                        <td><?php echo $vehiculos['capacidad']; ?></td>
                        <td><?php echo $vehiculos['tipoCaja']; ?></td>
                        <td><?php if ($vehiculos['aireAcondicionado'] == 1) {echo 'Si';} else {echo 'No';}; ?></td>
                        <td><?php echo $vehiculos['kilometrajeHabilitado']; ?></td>
                        <td><?php echo $vehiculos['tipoCobertura']; ?></td>
                        <td><img src="assets/img/star.png" width="20"><?php echo $vehiculos['valoracion']; ?></td>
                        <td><?php
                            $idSucursal = $vehiculos['fk_sucursal'];
                            $suc = mysqli_query($conexion,"SELECT s.localidad, e.nombre FROM sucursal s INNER JOIN empresa e ON s.fk_empresa = e.OID
                            WHERE s.OID = '$idSucursal'");
                            $res = mysqli_fetch_array($suc);
                            echo $res['nombre']; ?></td>
                        <td><?php echo $res['localidad'];     ?></td>
                        <td><img src="data:image/jpg;base64,<?php echo base64_encode($vehiculos['imagen']); ?>" width="35"/></td>
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
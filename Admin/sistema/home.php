<?php 
	session_start();

  if(!isset($_SESSION['idUser'])){
    header('location:https://localhost/proyectos/sistema_vehiculos/index.php');
  }else if($_SESSION['fk_rol'] == 1){
  header('location:https://localhost/proyectos/sistema_vehiculos/home.php');
  }

 ?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Home - DS Travel</title>
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
          <li class="breadcrumb-item active">Inicio</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

      <div class="card">
            <div class="card-body">
              <h5 class="card-title">Inicio</h5>

              <!-- Bordered Tabs Justified -->
              <ul class="nav nav-tabs nav-tabs-bordered d-flex" id="borderedTabJustified" role="tablist">
                <li class="nav-item flex-fill" role="presentation">
                  <button class="nav-link w-100 active" id="alojamientos-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-alojamientos" type="button" role="tab" aria-controls="alojamientos" aria-selected="true">Alojamientos</button>
                </li>
                <li class="nav-item flex-fill" role="presentation">
                  <button class="nav-link w-100" id="vuelos-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-vuelos" type="button" role="tab" aria-controls="vuelos" aria-selected="false">Vuelos</button>
                </li>
                <li class="nav-item flex-fill" role="presentation">
                  <button class="nav-link w-100" id="vehiculos-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-vehiculos" type="button" role="tab" aria-controls="vehiculos" aria-selected="false">Vehículos</button>
                </li>
                <li class="nav-item flex-fill" role="presentation">
                  <button class="nav-link w-100" id="paquetes-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-paquetes" type="button" role="tab" aria-controls="contpaquetesact" aria-selected="false">Paquetes</button>
                </li>
              </ul>
              <div class="tab-content pt-2" id="borderedTabJustifiedContent">
                <div class="tab-pane fade show active" id="bordered-justified-alojamientos" role="tabpanel" aria-labelledby="alojamientos-tab">
                <img src="./assets/img/PAGINA_EN_CONSTRUCCION.jpg" alt="Página en construcción" class="img-fluid" style="display: block; margin: 0 auto;">
                </div>
                <div class="tab-pane fade" id="bordered-justified-vuelos" role="tabpanel" aria-labelledby="vuelos-tab">
                <img src="./assets/img/PAGINA_EN_CONSTRUCCION.jpg" alt="Página en construcción" class="img-fluid" style="display: block; margin: 0 auto;">
                </div>
                <div class="tab-pane fade" id="bordered-justified-vehiculos" role="tabpanel" aria-labelledby="vehiculos-tab">
                  
                <section class="section dashboard">
      <div class="row">


            <!-- Vehículos Card -->
            <div class="col-xxl-2 col-md-2">
              <div class="card info-card sales-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                  <li class="dropdown-header text-start">
                      <h6>Acciones</h6>
                    </li>

                    <li><a class="dropdown-item" href="alta-vehiculos.php">Alta</a></li>
                    <li><a class="dropdown-item" href="mod_baja-vehiculos.php">Editar / Eliminar</a></li>
                    <li><a class="dropdown-item" href="tabla-vehiculos.php">Ver</a></li>                    
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Vehículos</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bx bxs-car"></i>
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Vehículos Card -->


            <!-- Empresas -->
            <div class="col-xxl-2 col-md-2">
              <div class="card info-card revenue-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                  <li class="dropdown-header text-start">
                      <h6>Acciones</h6>
                    </li>

                    <li><a class="dropdown-item" href="alta-empresas.php">Alta Empresa</a></li>
                    <li><a class="dropdown-item" href="mod_baja-empresas.php">Editar / Eliminar Empresa</a></li>
                    <li><a class="dropdown-item" href="tabla-empresas.php">Ver Empresas</a></li>
                    <li><a class="dropdown-item" href="alta-sucursales.php">Alta Sucursal</a></li>
                    <li><a class="dropdown-item" href="mod_baja-sucursales.php">Editar / Eliminar Sucursal</a></li>
                    <li><a class="dropdown-item" href="tabla-sucursales.php">Ver Sucursales</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Empresas</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-shop"></i>
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Empresas Card -->


            <!-- Accesorios -->
            <div class="col-xxl-2 col-md-2">
              <div class="card info-card sales-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Acciones</h6>
                    </li>

                    <li><a class="dropdown-item" href="alta-accesorios.php">Alta</a></li>
                    <li><a class="dropdown-item" href="mod_baja-accesorios.php">Editar / Eliminar</a></li>
                    <li><a class="dropdown-item" href="tabla-accesorios.php">Ver</a></li>                    
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Accesorios</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-tools"></i>
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Accesorios -->


</div>
</section>




                </div>
                <div class="tab-pane fade" id="bordered-justified-paquetes" role="tabpanel" aria-labelledby="paquetes-tab">
                <img src="./assets/img/PAGINA_EN_CONSTRUCCION.jpg" alt="Página en construcción" class="img-fluid" style="display: block; margin: 0 auto;">
                </div>
              </div><!-- End Bordered Tabs Justified -->

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

</body>

</html>
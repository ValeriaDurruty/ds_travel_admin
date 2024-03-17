<?php

session_start();

if(!isset($_SESSION['idUser'])){
  header('location:index.php');
}else if($_SESSION['fk_rol'] == 1){
header('location:https://localhost/proyectos/sistema_vehiculos/home.php');
}

include "../conexion.php";

// EJECUTO LA SIGUIENTE CONSULTA PARA TRAER TODAS LAS EMPRESAS DISPONIBLES DE LA BD.
$cmd = mysqli_query($conexion,"SELECT * FROM empresa");


    if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $nombre = $_POST['nombre'];
            $empresa = $_POST['empresa'];
            $localidad = ucwords(strtolower($_POST['selectLocalidades']));
            $provincia = $_POST['selectProvincias'];

            if(empty($nombre) || empty($empresa) || empty($localidad) || empty($provincia) ){
              $notificacion = "Error: No puede dejar campos vacíos.";
          }else{

            $alta = mysqli_query($conexion, "INSERT INTO sucursal (nombre, localidad, fk_provincia, fk_empresa) VALUES ('$nombre', '$localidad', '$provincia', '$empresa')");

        if($alta){
            echo'<script type="text/javascript"> alert("La sucursal se ha registrado correctamente.");
                    window.location.href="alta-sucursales.php"; </script>';
            }else{
                $notificacion = "Error al intentar guardar la sucursal.";
            }
    }}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Empresas / Alta Sucursal - DS Travel</title>
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
          <li class="breadcrumb-item"><a href="index.html"><i class="bi bi-house-door"></i></a></li>
          <li class="breadcrumb-item">Sucursal</li>
          <li class="breadcrumb-item active">Alta</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Alta Sucursal</h5>

              <?php 
                  if(isset($notificacion)){
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">'.$notificacion.'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
                    }
            	    ?>

              <!-- Vertical Form -->
              <form class="row g-3 needs-validation" method="POST" action="alta-sucursales.php" novalidate>
                <div class="col-6">
                  <label for="nombre" class="form-label">Nombre <font color="red">*</font></label>
                  <input type="text" class="form-control" name="nombre" id="nombre" required>
                  <div class="invalid-feedback">Por favor ingrese un nombre!</div>
                </div>
                <div class="col-md-6">
                  <label for="empresa" class="form-label">Empresa <font color="red">*</font></label>
                  <select id="empresa" name="empresa" class="form-select" required>
                    <option disabled="disabled" selected="selected"></option>
                    <?php
                      while ($empresas = mysqli_fetch_array($cmd)) {
                      echo '<option value="'.$empresas['OID'].'">'.$empresas['nombre'].'</option>';
                      }
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
                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Guardar</button>
                  <button type="reset" class="btn btn-secondary">Borrar</button>
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

</body>

</html>
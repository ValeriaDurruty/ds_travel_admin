<?php


session_start();



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Cuenta / Contacto - DS Travel</title>
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
          <li class="breadcrumb-item">Cuenta</li>
          <li class="breadcrumb-item active">Contacto</li>
        </ol>
      </nav>
    </div>

    <section class="section contact">
      <div class="row gy-4">
        <div class="col-xl-6">
          <div class="row">
            <div class="col-lg-6">
              <div class="info-box card"> <i class="bi bi-envelope"></i>
                <h3>Por email</h3><p>ds_travel@gmail.com<br>ds_travel_q@gmail.com</p>
              </div>
            </div>
            
            <div class="col-lg-6">
              <div class="info-box card"> <i class="bi bi-telephone"></i>
                <h3>Por teléfono</h3><p>+54 221 4520000<br>+54 221 4250000</p>
              </div>
            </div>
          </div>
        </div>
        
        <div class="col-xl-6">
          <div class="card p-4">
            <form action="forms/contact.php" method="post" class="php-email-form needs-validation" novalidate>
              <div class="row gy-4"><div class="col-md-6"> 
                <input type="text" name="nombre" class="form-control" placeholder="Nombre" required>
                <div class="invalid-feedback">Por favor ingrese un nombre!</div>
              </div>
              <div class="col-md-6 "> 
                  <input type="email" class="form-control" name="correo" placeholder="Correo electrónico" required>
                  <div class="invalid-feedback">Por favor ingrese un correo electrónico!</div>
                </div>
                <div class="col-md-12"> 
                  <input type="text" class="form-control" name="asunto" placeholder="Asunto" required>
                  <div class="invalid-feedback">Por favor escriba su tema de consulta aqui!</div>
                </div>
                <div class="col-md-12">
                  <textarea class="form-control" name="mensaje" rows="6" placeholder="Mensaje" required></textarea>
                  <div class="invalid-feedback">Por favor escriba su mensaje aqui!</div>
                </div>
                <div class="col-md-12 text-center">
                  <div class="loading">Cargando</div>
                  <div class="error-message">Error al intentar enviar su consulta.</div>
                  <div class="sent-message">Su mensaje fue enviado. Gracias!</div> 
                  <button type="submit">Enviar mensaje</button>
                </div>
              </div>
            </form>
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
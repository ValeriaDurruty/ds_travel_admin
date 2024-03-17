<?php


session_start();



if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];
    $pass = $_POST['pass'];
    $passEncrip = password_hash($pass, PASSWORD_DEFAULT);


   if($pass != $_POST['passConfirm']){
    $notificacion = "Las contraseñas deben coincidir.";
    } else{

      include "../conexion.php";

        $cmd = mysqli_query($conexion,"SELECT * FROM usuario WHERE correo = '$correo'");
        $resultado = mysqli_fetch_array($cmd);

        if(!$resultado){

          $resultado = mysqli_query($conexion,"INSERT INTO usuario(nombre, apellido, correo, password, fechaNacimiento, tipoDocumento, dni, telefono, fk_domicilio, fk_rol) VALUES ('$nombre', '$apellido', '$correo', '$passEncrip', NULL, NULL, NULL, NULL, NULL, 2)");

                if($resultado){
                    echo'<script type="text/javascript" > alert("El registro se ha realizado de manera exitosa.");
                    window.location.href="home.php"; </script>';
                }else{
                  $notificacion = "El usuario no se ha podido registrar correctamente.";
                }

            }else{
              $notificacion = "El correo ingresado ya está registrado.";
        }

    }


}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Alta Usuario - DS Travel</title>
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
          <li class="breadcrumb-item active">Alta Usuario</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">

          <div class="card">

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Crear cuenta</h5>
                    <p class="text-center small">Ingrese los siguientes datos</p>
                  </div>
                  <?php 
                  if(isset($notificacion)){
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">'.$notificacion.'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
                    }
            	    ?>

                  <form class="row g-3 needs-validation" action="registro.php" method="POST" id="myform" novalidate>
                    <div class="col-6">
                      <label for="nombre" class="form-label">Nombre <font color="red">*</font></label>
                      <input type="text" name="nombre" class="form-control" id="nombre" required>
                      <div class="invalid-feedback">Por favor ingrese un nombre!</div>
                    </div>

                    <div class="col-6">
                        <label for="apellido" class="form-label">Apellido <font color="red">*</font></label>
                        <input type="text" name="apellido" class="form-control" id="apellido" required>
                        <div class="invalid-feedback">Por favor ingrese un apellido!</div>
                      </div>

                    <div class="col-12">
                      <label for="correo" class="form-label">Correo electrónico <font color="red">*</font></label>
                      <input type="email" name="correo" class="form-control" id="correo" required>
                      <div class="invalid-feedback">Por favor ingrese un correo electrónico!</div>
                    </div>

                    <div class="col-6">
                      <label for="pass" class="form-label">Contraseña <font color="red">*</font></label>
                      <input type="password" name="pass" class="form-control" id="pass" required>
                      <div class="invalid-feedback">Por favor ingrese una contraseña!</div>
                    </div>

                    <div class="col-6">
                        <label for="passConfirm" class="form-label">Confirme su contraseña <font color="red">*</font></label>
                        <input type="password" name="passConfirm" class="form-control" id="passConfirm" required>
                        <div class="invalid-feedback">Por favor confirme su contraseña!</div>
                      </div>

                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Crear cuenta</button>
                    </div>
                  </form>

                  </div>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php include "includes/footer.php"; ?>

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
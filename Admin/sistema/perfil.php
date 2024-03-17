<?php

session_start();

if(!isset($_SESSION['idUser'])){
  header('location:index.php');
}else if($_SESSION['fk_rol'] == 1){
header('location:https://localhost/proyectos/sistema_vehiculos/home.php');
}

if(!empty($_POST)){

if(empty($_POST['pass']) || empty($_POST['newPassword']) || empty($_POST['renewPassword']))
		{
      echo'<script type="text/javascript" > alert("Por favor complete todos los campos.");
              window.location.href="perfil.php";</script>';
		}else{

      if(password_verify($_POST['pass'], $_SESSION['password'])){

            if($_POST['newPassword'] == $_POST['renewPassword']){

              $passEncrip = password_hash($_POST['newPassword'], PASSWORD_DEFAULT);

              require_once "../conexion.php";

              $idUser = $_SESSION['idUser'];

              $sql_update = mysqli_query($conexion,"UPDATE usuario
															SET password = '$passEncrip'
															WHERE OID = $idUser ");
    				

                    if($sql_update){
                      echo'<script type="text/javascript" > alert("El cambio de contraseña se ha realizado de manera exitosa.");
                      window.location.href="perfil.php"; </script>';
                    }else{
                      echo'<script type="text/javascript" > alert("El cambio de contraseña no se ha podido realizar correctamente.");
                      window.location.href="perfil.php"; </script>';
                    }
          }else {
            echo'<script type="text/javascript" > alert("La nueva contraseña no coincide con la contraseña confirmada.");
                    window.location.href="perfil.php";</script>';
          }
      } else {
        echo'<script type="text/javascript" > alert("La contraseña actual es incorrecta.");
                      window.location.href="https://localhost/proyectos/sistema_vehiculos/index.php"; </script>';
            session_destroy();
      }
    }
  }



			
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Cuenta / Perfil - DS Travel</title>
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
          <li class="breadcrumb-item">Cuenta</li>
          <li class="breadcrumb-item active">Perfil</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="assets/img/login.png" alt="Profile" class="rounded-circle">
              <h2><?php echo $_SESSION['nombre'].' '; echo $_SESSION['apellido'];  ?></h2>
              <h3>Admin</h3>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#inf_personal">Información personal</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#cambiar_pass">Cambiar contraseña</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="inf_personal">
                  <h5 class="card-title">Información de perfil</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Id de usuario</div>
                    <div class="col-lg-9 col-md-8">#<?php echo $_SESSION['idUser']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Nombre</div>
                    <div class="col-lg-9 col-md-8"><?php echo $_SESSION['nombre']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Apellido</div>
                    <div class="col-lg-9 col-md-8"><?php echo $_SESSION['apellido']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Correo electrónico</div>
                    <div class="col-lg-9 col-md-8"><?php echo $_SESSION['correo']; ?></div>
                  </div>

                </div>

               
                <div class="tab-pane fade pt-3" id="cambiar_pass">
                  <!-- Change Password Form -->
                  <form action="perfil.php" method="POST" novalidate>

                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Contraseña actual <font color="red">*</font></label>
                      <div class="col-md-8 col-lg-9">
                        <input name="pass" type="password" class="form-control" id="pass" required>
                        <div class="invalid-feedback">Por favor ingrese su contraseña actual.</div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Nueva contraseña <font color="red">*</font></label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newPassword" type="password" class="form-control" id="newPassword" required>
                        <div class="invalid-feedback">Por favor ingrese su nueva contraseña.</div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Confirmar nueva contraseña <font color="red">*</font></label>
                      <div class="col-md-8 col-lg-9">
                        <input name="renewPassword" type="password" class="form-control" id="renewPassword" required>
                        <div class="invalid-feedback">Por favor confirme su nueva contraseña.</div>
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Cambiar contraseña</button>
                    </div>
                  </form><!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

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
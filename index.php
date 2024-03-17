<?php

session_start();
if(!empty($_SESSION['active']))
{
	header('location: Admin/sistema/home.php');
  exit;
}else{

  if (!empty($_POST)) {
    require_once "Admin/conexion.php";

    $correo = $_POST['correo'];
    $pass = $_POST['pass'];

    if (empty($correo) || empty($pass)) {
        $notificacion = "Error: por favor rellene todos los campos";
    } else {
        $cmd = $conexion->prepare('SELECT * FROM usuario WHERE correo = ?');
        $cmd->bind_param('s', $correo);
        $cmd->execute();
        $resultado = $cmd->get_result()->fetch_assoc();

        if ($resultado) {
            if (password_verify($pass, $resultado['password'])) {
                $_SESSION['idUser'] = $resultado['OID'];
                $_SESSION['nombre'] = $resultado['nombre'];
                $_SESSION['apellido'] = $resultado['apellido'];
                $_SESSION['correo'] = $resultado['correo'];
                $_SESSION['password'] = $resultado['password'];
                $_SESSION['fk_rol'] = $resultado['fk_rol'];

                if ($_SESSION['fk_rol'] == 2 || $_SESSION['fk_rol'] == 0) {
                    header('location: Admin/sistema/home.php');
                    exit;
                } else {
                    $notificacion = "No posee los permisos necesarios para ingresar.";
                    session_destroy();
                }
            } else {
                $notificacion = "Error: La contraseña ingresada no es correcta.";
                session_destroy();
            }
        } else {
            $notificacion = "Error: El correo ingresado no está registrado.";
            session_destroy();
        }
    }
}
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Inicio de sesión - DS Travel</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="Admin/sistema/assets/img/favicon.png" rel="icon">
  <link href="Admin/sistema/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="Admin/sistema/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="Admin/sistema/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="Admin/sistema/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="Admin/sistema/assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="Admin/sistema/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="Admin/sistema/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="Admin/sistema/assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="Admin/sistema/assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin - v2.5.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <img src="Admin/sistema/assets/img/ds_travel.png" alt="DS Travel Logo">
                  <span class="d-none d-lg-block">DS Travel</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Iniciar sesión</h5>
                    <p class="text-center small">Ingrese su usuario y contraseña</p>
                  </div>
                  <?php 
                  if(isset($notificacion)){
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">'.$notificacion.'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
                    }
            	    ?>
                  <form class="row g-3 needs-validation" id="myform" action="" method="POST" novalidate>

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Correo electrónico</label>
                      <div class="input-group has-validation">
                        <input type="email" name="correo" class="form-control" id="correo" required>
                        <div class="invalid-feedback">Por favor ingrese su correo electrónico.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Contraseña</label>
                      <input type="password" name="pass" class="form-control" id="pass" required>
                      <div class="invalid-feedback">Por favor ingrese su contraseña!</div>
                    </div>

                    <div class="col-12">
                    </div>

                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Ingresar</button>
                    </div>
                    
                    <div class="col-12">
                    </div>
                  </form>

                </div>
              </div>

              <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="Admin/sistema/assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="Admin/sistema/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="Admin/sistema/assets/vendor/chart.js/chart.umd.js"></script>
  <script src="Admin/sistema/assets/vendor/echarts/echarts.min.js"></script>
  <script src="Admin/sistema/assets/vendor/quill/quill.min.js"></script>
  <script src="Admin/sistema/assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="Admin/sistema/assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="Admin/sistema/assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="Admin/sistema/assets/js/main.js"></script>

</body>

</html>
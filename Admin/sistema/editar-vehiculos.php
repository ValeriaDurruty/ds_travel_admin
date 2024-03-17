<?php 
	session_start();

	include "../conexion.php";

  // EJECUTO LA SIGUIENTE CONSULTA PARA TRAER TODAS LAS SUCURSALES DISPONIBLES DE LA BD.
  $cmd = mysqli_query($conexion,"SELECT s.OID, (s.nombre) as sucursal, (p.nombre) as provincia, s.localidad, (e.nombre) as empresa FROM sucursal s INNER JOIN empresa e ON s.fk_empresa = e.OID INNER JOIN provincia p ON s.fk_provincia = p.OID");

  // Variable para controlar si se debe incluir la imagen en la actualización
  $incluye_imagen = false;


	if(!empty($_POST)){

      $idVehiculo = $_POST['idVehiculo'];
      $nombre = $_POST['nombre'];
      $modelo = $_POST['modelo'];
      $capacidad = $_POST['capacidad'];
      $km = $_POST['km'];
      $precio = $_POST['precioPorDia'];
      $marca = $_POST['marca'];
      $caja = $_POST['caja'];
      $aire = $_POST['aire'];
      $cobertura = $_POST['cobertura'];
      $val = $_POST['val'];
      $suc = $_POST['sucursal'];

      // Verificar si se ha cargado una imagen
      if (!empty($_FILES['imagen']['tmp_name'])) {
        $incluye_imagen = true;
      }

    // Validación de campos
    if (empty($nombre) || empty($modelo) || empty($capacidad) || empty($km) || empty($precio) || empty($marca) || empty($caja) || empty($aire) || empty($cobertura) || empty($val) || empty($suc)) {
      $notificacion = "Error: No puede dejar campos vacíos.";
    }else{

      //Actualizar el vehículo
      $sql_update = "UPDATE vehiculo SET nombre = '$nombre', marca = '$marca', modelo = '$modelo', ";
      if ($incluye_imagen) {
        $imagen = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));
        $sql_update .= "imagen = '$imagen', ";
      }
      $sql_update .= "precioPorDia = '$precio', capacidad = '$capacidad', tipoCaja = '$caja', aireAcondicionado = '$aire', kilometrajeHabilitado = '$km', tipoCobertura = '$cobertura', valoracion = '$val', fk_sucursal = '$suc' WHERE OID = $idVehiculo";

      // Ejecutar la consulta de actualización
      if (mysqli_query($conexion, $sql_update)) {
        echo '<script type="text/javascript"> alert("El vehículo se ha modificado correctamente."); window.location.href="mod_baja-vehiculos.php"; </script>';
      } else {
        echo '<script type="text/javascript"> alert("Error al intentar modificar el vehículo."); window.location.href="mod_baja-vehiculos.php"; </script>';
      }
    }
  }



	if(empty($_REQUEST['id']) )
	{
		header("location: mod_baja-vehiculos.php");
		mysqli_close($conexion);
	}else{

		$idVehiculo = $_REQUEST['id'];

		$query = mysqli_query($conexion,"SELECT v.nombre, v.marca, v.modelo, v.precioPorDia, v.capacidad, v.tipoCaja, v.aireAcondicionado, v.kilometrajeHabilitado, v.tipoCobertura, v.valoracion, v.fk_sucursal, s.localidad, (s.nombre) as nomSucursal, (p.nombre) as nomProvincia, (e.nombre) as nomEmpresa FROM vehiculo v
                                                    INNER JOIN sucursal s
                                                        ON v.fk_sucursal = s.OID
                                                    INNER JOIN empresa e
                                                        ON s.fk_empresa = e.OID
                                                    INNER JOIN provincia p
                                                        ON s.fk_provincia = p.OID
                                                    WHERE v.OID = $idVehiculo ");
		
		mysqli_close($conexion);
		$result = mysqli_num_rows($query);

		if($result > 0){
			while ($data = mysqli_fetch_array($query)) {
                
        //array(23) { [0]=> string(7) "296 gtb" ["nombre"]=> string(10) "Hertz S.A." [1]=> string(7) "Ferrari" ["marca"]=> string(7) "Ferrari" [2]=> string(4) "2021" ["modelo"]=> string(4) "2021" [3]=> string(9) "150000.00" ["precioPorDia"]=> string(9) "150000.00" [4]=> string(1) "3" ["capacidad"]=> string(1) "3" [5]=> string(6) "Manual" ["tipoCaja"]=> string(6) "Manual" [6]=> string(1) "1" ["aireAcondicionado"]=> string(1) "1" [7]=> string(6) "200000" ["kilometrajeHabilitado"]=> string(6) "200000" [8]=> string(7) "Parcial" ["tipoCobertura"]=> string(7) "Parcial" [9]=> string(1) "5" ["valoracion"]=> string(1) "5" [10]=> string(23) "San Carlos de Bariloche" ["localidad"]=> string(23) "San Carlos de Bariloche" [11]=> string(10) "Hertz S.A." }
				
				$nombre = $data['nombre'];
				$marca = $data['marca'];
        $modelo = $data['modelo'];
				$precio = $data['precioPorDia'];
        $capacidad = $data['capacidad'];
				$tipoCaja = $data['tipoCaja'];
        $ac = $data['aireAcondicionado'];
				$km = $data['kilometrajeHabilitado'];
        $cobertura = $data['tipoCobertura'];
				$val = $data['valoracion'];
        $fk_suc = $data['fk_sucursal'];
        $localidad = $data['localidad'];
				$empNombre = $data['nomEmpresa'];
        $provincia = $data['nomProvincia'];
        $nomSucursal = $data['nomSucursal'];
				
			}
		}else{
			echo'<script type="text/javascript"> alert("El vehículo ha eliminar no existe en la base de datos.");
                    window.location.href="mod_baja-vehiculos.php"; </script>';
		}


	}


 ?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Vehículo / Editar - DS Travel</title>
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
          <li class="breadcrumb-item">Vehículo</li>
          <li class="breadcrumb-item active">Editar</li>
        </ol>
      </nav>
    </div>

    <section class="section">

    <div class="card">
            <div class="card-body">
              <h5 class="card-title">Editar Vehículo</h5>

              <?php 
                  if(isset($notificacion)){
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">'.$notificacion.'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
                    }
            	?>

              <!-- Multi Columns Form -->
              <form class="row g-3 needs-validation" method="POST" action="" enctype="multipart/form-data" novalidate>
              <div class="col-md-4">
                  <label for="nombre" class="form-label">Nombre <font color="red">*</font></label>
                  <input type="text" class="form-control" name= "nombre" id="nombre" value="<?php echo $nombre; ?>" required>
                  <div class="invalid-feedback">Por favor ingrese un nombre!</div>
                </div>
                <div class="col-md-4">
                  <label for="marca" class="form-label">Marca <font color="red">*</font></label>
                  <select name="marca" id="marca" class="form-select" required>
                    <option disabled="disabled" selected="selected"></option>
                    <option value="<?php echo $marca; ?>" selected="selected"><?php echo $marca; ?></option>
                                            <option value="Alfa Romeo">Alfa Romeo</option>
                                            <option value="Aston Martin">Aston Martin</option>
                                            <option value="Audi">Audi</option>
                                            
                                            <option value="Autovaz">Autovaz</option>
                                            <option value="Bentley">Bentley</option>
                                            <option value="BMW">BMW</option>
                                            <option value="Cadillac">Cadillac</option>
                                            
                                            <option value="Caterham">Caterham</option>
                                            <option value="Chevrolet">Chevrolet</option>
                                            <option value="Chrysler">Chrysler</option>
                                            <option value="Citroen">Citroen</option>
                                            
                                            <option value="Daihatsu">Daihatsu</option>
                                            <option value="Dodge">Dodge</option>
                                            <option value="Ferrari">Ferrari</option>
                                            <option value="Fiat">Fiat</option>
                                            
                                            <option value="Ford">Ford</option>
                                            <option value="Honda">Honda</option>
                                            <option value="Hummer">Hummer</option>
                                            <option value="Hyundai">Hyundai</option>
                                            
                                            <option value="Isuzu">Isuzu</option>
                                            <option value="Jaguar">Jaguar</option>
                                            <option value="Jeep">Jeep</option>
                                            <option value="Kia">Kia</option>
                                            
                                            <option value="Lamborghini">Lamborghini</option>
                                            <option value="Lancia">Lancia</option>
                                            <option value="Land Rover">Land Rover</option>
                                            <option value="Lexus">Lexus</option>
                                            
                                            <option value="Lotus">Lotus</option>
                                            <option value="Maserati">Maserati</option>
                                            <option value="Mazda">Mazda</option>
                                            <option value="Mercedes Benz">Mercedes Benz</option>
                                            
                                            <option value="MG">MG</option>
                                            <option value="Mini">Mini</option>
                                            <option value="Mitsubishi">Mitsubishi</option>
                                            <option value="Morgan">Morgan</option>
                                            
                                            <option value="Nissan">Nissan</option>
                                            <option value="Opel">Opel</option>
                                            <option value="Peugeot">Peugeot</option>
                                            <option value="Porsche">Porsche</option>
                                            
                                            <option value="Renault">Renault</option>
                                            <option value="Rolls Royce">Rolls Royce</option>
                                            <option value="Rover">Rover</option>
                                            <option value="Saab">Saab</option>
                                            
                                            <option value="Seat">Seat</option>
                                            <option value="Skoda">Skoda</option>
                                            <option value="Smart">Smart</option>
                                            <option value="Ssangyong">Ssangyong</option>
                                            
                                            <option value="Subaru">Subaru</option>
                                            <option value="Suzuki">Suzuki</option>
                                            <option value="Tata">Tata</option>
                                            <option value="Toyota">Toyota</option>
                                            
                                            <option value="Volkswagen">Volkswagen</option>
                                            <option value="Volvo">Volvo</option>
                  </select>
                  <div class="invalid-feedback">Por favor seleccione una marca!</div>
                </div>
                <div class="col-md-4">
                  <label for="modelo" class="form-label">Modelo <font color="red">*</font></label>
                  <input type="number" class="form-control" name="modelo" id="modelo" value="<?php echo $modelo; ?>" min="<?php echo date("Y")-10; ?>" max="<?php echo date("Y"); ?>" required>
                  <div class="invalid-feedback">Por favor ingrese un año entre <?php echo date("Y")-10; ?> y <?php echo date("Y"); ?>!</div>
                </div>
                <div class="col-md-4">
                <fieldset class="row mb-3">
                  <legend class="col-form-label col-sm-6 pt-0">Tipo de Caja <font color="red">*</font></legend>
                  <div class="col-sm-10">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="caja" id="manual" value="Manual" 
                      
                      <?php if ($tipoCaja == "Manual"): ?> checked <?php endif; ?>

                      required>
                      <label class="form-check-label" for="caja">
                        Manual
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="caja" id="auto" value="Automática" 
                      
                      <?php if ($tipoCaja == "Automática"): ?> checked <?php endif; ?>
                      
                      required>
                      <label class="form-check-label" for="caja">
                        Automática
                      </label>
                      <div class="invalid-feedback">Por favor seleccione una opción!</div>
                    </div>
                  </div>
                </fieldset>
  </div>
  <div class="col-md-4">
                <fieldset class="row mb-3">
                  <legend class="col-form-label col-sm-6 pt-0">Aire Acondicionado <font color="red">*</font></legend>
                  <div class="col-sm-10">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="aire" id="si" value="1" 
                      
                      <?php if ($ac == 1): ?> checked <?php endif; ?>
                      
                      required>
                      <label class="form-check-label" for="aire">
                        Si
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="aire" id="no" value="0" 
                      
                      <?php if ($ac == 0): ?> checked <?php endif; ?>
                      
                      required>
                      <label class="form-check-label" for="aire">
                        No
                      </label>
                      <div class="invalid-feedback">Por favor seleccione una opción!</div>
                    </div>
                  </div>
                </fieldset>
  </div>
  <div class="col-md-4">
                <fieldset class="row mb-3">
                  <legend class="col-form-label col-sm-6 pt-0">Tipo de Cobertura <font color="red">*</font></legend>
                  <div class="col-sm-10">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="cobertura" id="parcial" value="Parcial" 
                      
                      <?php if ($cobertura == "Parcial"): ?> checked <?php endif; ?>
                      
                      required>
                      <label class="form-check-label" for="cobertura">
                        Parcial
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="cobertura" id="total" value="Total" 
                      
                      <?php if ($cobertura == "Total"): ?> checked <?php endif; ?>
                      
                      required>
                      <label class="form-check-label" for="cobertura">
                        Total
                      </label>
                      <div class="invalid-feedback">Por favor seleccione una opción!</div>
                    </div>
                  </div>
                </fieldset>
                </div>
                <div class="col-md-4">
                  <label for="capacidad" class="form-label">Capacidad <font color="red">*</font></label>
                  <input type="number" class="form-control" name="capacidad" id="capacidad" value="<?php echo $capacidad; ?>" min="1" max="9" required>
                  <div class="invalid-feedback">Por favor ingrese un número entre 1 y 9!</div>
                </div>
                <div class="col-md-4">
                  <label for="val" class="form-label">Valoración <font color="red">*</font></label>
                  <select name="val" id="val" class="form-select" required>
                    <option disabled="disabled" selected="selected"></option>

                    <?php

                    if($val == 1){
                      echo '<option value="$val" selected="selected">'.$val.' estrella</option>';
                    }else {
                      echo '<option value="'.$val.'" selected="selected">'.$val.' estrellas</option>';
                    }

                    $i = 1;
                    while ($i <= 5) {
                      if($i != $val){
                        if ($i == 1){
                          echo '<option value="'.$i.'">'.$i.' estrella</option>';
                        }else{
                        echo '<option value="'.$i.'">'.$i.' estrellas</option>';
                        }}
                        $i++;
                    }

                    ?>
                    
                  </select>
                  <div class="invalid-feedback">Por favor seleccione una opción!</div>
                </div>
                <div class="col-md-4">
                  <label for="km" class="form-label">Kilometraje Habilitado <font color="red">*</font></label>
                  <input type="number" class="form-control" name="km" id="km" value="<?php echo $km; ?>" min="1" required>
                  <div class="invalid-feedback">Por favor ingrese números mayores a 1!</div>
                </div>
                <div class="col-md-6">
                  <label for="sucursal" class="form-label">Sucursal <font color="red">*</font></label>
                  <select id="sucursal" name="sucursal" class="form-select" required>
                    <option disabled="disabled" selected="selected"></option>
                    <option value="<?php echo $fk_suc; ?>" selected="selected"><?php echo $empNombre.' - '.$nomSucursal.' - '.$localidad.' - '.$provincia; ?></option>
                    <?php
                      while ($sucursales = mysqli_fetch_array($cmd)) {
                        if($sucursales['OID'] != $fk_suc){
                          echo '<option value="'.$sucursales['OID'].'">'.$sucursales['empresa'].' - '.$sucursales['sucursal'].' - '.$sucursales['localidad'].' - '.$sucursales['provincia'].'</option>';
                      }}
                      ?>                                              
                    </select>
                    <div class="invalid-feedback">Por favor seleccione una sucursal!</div>
                </div>
                <div class="col-md-6">
                  <label for="precio" class="form-label">Precio por día ($) <font color="red">*</font></label>
                  <input type="number" class="form-control" name="precioPorDia" id="precioPorDia" value="<?php echo $precio; ?>" step="0.01" min="5000" required>
                  <div class="invalid-feedback">Por favor ingrese un valor mayor a 5000.00!</div>
                </div>
                <div class="col-md-6">

                  <label for="imagen" class="col-sm-2 col-form-label">Imagen</label>
                  <div class="col-sm-10">
                    <input class="form-control" type="file" name="imagen" id="imagen">
                  </div>
                </div>
                <div class="col-md-6">
                  <input type="hidden" name="idVehiculo" value="<?php echo $idVehiculo; ?>">
                </div>
                <div class="text-center">
                  <a href="mod_baja-vehiculos.php" class="btn btn-secondary">Cancelar</a>
                  <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
              </form><!-- End Multi Columns Form -->

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
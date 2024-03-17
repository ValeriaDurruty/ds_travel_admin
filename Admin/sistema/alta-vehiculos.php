<?php

session_start();

if(!isset($_SESSION['idUser'])){
  header('location:index.php');
}else if($_SESSION['fk_rol'] == 1){
header('location:https://localhost/proyectos/sistema_vehiculos/home.php');
}

include "../conexion.php";


// EJECUTO LA SIGUIENTE CONSULTA PARA TRAER TODAS LAS SUCURSALES DISPONIBLES DE LA BD.
$cmd = mysqli_query($conexion,"SELECT s.OID, (s.nombre) as sucursal, (p.nombre) as provincia, s.localidad, (e.nombre) as empresa FROM sucursal s INNER JOIN empresa e ON s.fk_empresa = e.OID INNER JOIN provincia p ON s.fk_provincia = p.OID");

// EJECUTO LA SIGUIENTE CONSULTA PARA TRAER TODOS LOS ACCESORIOS DISPONIBLES DE LA BD.
$cmdAcc = mysqli_query($conexion,"SELECT a.idAccesorio, a.accesorio FROM accesorios a");



    if($_SERVER['REQUEST_METHOD'] == 'POST'){


      if(empty($_POST['nombre']) || empty($_POST['modelo']) || empty($_POST['capacidad']) || empty($_POST['km']) || empty($_POST['precio']) || empty($_POST['marca']) || empty($_POST['caja']) || empty($_POST['aire']) || empty($_POST['cobertura']) || empty($_POST['val']) || empty($_POST['sucursal']) || empty($_FILES['imagen']['tmp_name']) ){
        $notificacion = "Error: No puede dejar campos vacíos.";
      }else{


              $nombre = $_POST['nombre'];
              $modelo = $_POST['modelo'];
              $capacidad = $_POST['capacidad'];
              $km = $_POST['km'];
              $precio = $_POST['precio'];
              $marca = $_POST['marca'];
              $caja = $_POST['caja'];
              $aire = $_POST['aire'];
              $cobertura = $_POST['cobertura'];
              $val = $_POST['val'];
              $suc = $_POST['sucursal'];
              $imagen = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));
                

              $alta = mysqli_query($conexion,"INSERT INTO vehiculo(nombre, marca, modelo, imagen, precioPorDia, capacidad, tipoCaja, aireAcondicionado, kilometrajeHabilitado, tipoCobertura, valoracion, fk_sucursal) VALUES ('$nombre', '$marca', '$modelo', '$imagen', '$precio', '$capacidad', '$caja', '$aire', '$km', '$cobertura', '$val', '$suc')");
              


        if($alta){


            //Comprobar si tiene accesorios para cargar
            if ($_POST['accesorio']){


              $accesorio = $_POST['accesorio'] ?? [];

              $idVehiculo = mysqli_insert_id($conexion);


              
              for($i = 0;$i < count($accesorio);$i++){
                $acc_id = $accesorio[$i];

                $alta = mysqli_query($conexion,"INSERT INTO accesorios_vehiculo(disponible, fk_accesorio, fk_vehiculo) VALUES ('1', '$acc_id', '$idVehiculo')");
              }

                if($alta){
                  echo'<script type="text/javascript"> alert("El vehículo y sus accesorios se ha registrado correctamente.");
                          window.location.href="alta-vehiculos.php"; </script>';


                }else{
                  $notificacion = "Error al intentar guardar el accesorio.";
                }

            }

              echo'<script type="text/javascript"> alert("El vehículo se ha registrado correctamente.");
              window.location.href="alta-vehiculos.php"; </script>';


            }else{
                $notificacion = "Error al intentar guardar el vehículo.";
            }
    }}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Vehículos / Alta - DS Travel</title>
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

    <style>
        .puntero{
            cursor: pointer;
        }
        .ocultar{
            display: none;
        }
    </style>

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
          <li class="breadcrumb-item active">Alta</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">

    <div class="card">
            <div class="card-body">
              <h5 class="card-title">Alta Vehículo</h5>

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
                  <input type="text" class="form-control" name= "nombre" id="nombre" required>
                  <div class="invalid-feedback">Por favor ingrese un nombre!</div>
                </div>
                <div class="col-md-4">
                  <label for="marca" class="form-label">Marca <font color="red">*</font></label>
                  <select name="marca" id="marca" class="form-select" required>
                    <option disabled="disabled" selected="selected"></option>
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
                  <input type="number" class="form-control" name="modelo" id="modelo" min="<?php echo date("Y")-10; ?>" max="<?php echo date("Y"); ?>" required>
                  <div class="invalid-feedback">Por favor ingrese un año entre <?php echo date("Y")-10; ?> y <?php echo date("Y"); ?>!</div>
                </div>
                <div class="col-md-4">
                <fieldset class="row mb-3">
                  <legend class="col-form-label col-sm-6 pt-0">Tipo de Caja <font color="red">*</font></legend>
                  <div class="col-sm-10">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="caja" id="manual" value="Manual" required>
                      <label class="form-check-label" for="caja">
                        Manual
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="caja" id="auto" value="Automática" required>
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
                      <input class="form-check-input" type="radio" name="aire" id="si" value="1" required>
                      <label class="form-check-label" for="aire">
                        Si
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="aire" id="no" value="0" required>
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
                      <input class="form-check-input" type="radio" name="cobertura" id="parcial" value="Parcial" required>
                      <label class="form-check-label" for="cobertura">
                        Parcial
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="cobertura" id="total" value="Total" required>
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
                  <input type="number" class="form-control" name="capacidad" id="capacidad" min="1" max="9" required>
                  <div class="invalid-feedback">Por favor ingrese un número entre 1 y 9!</div>
                </div>
                <div class="col-md-4">
                  <label for="val" class="form-label">Valoración <font color="red">*</font></label>
                  <select name="val" id="val" class="form-select" required>
                    <option disabled="disabled" selected="selected"></option>
                                            <option value="1">1 estrella</option>
                                            <option value="2">2 estrellas</option>
                                            <option value="3">3 estrellas</option>
                                            <option value="4">4 estrellas</option>
                                            <option value="5">5 estrellas</option>
                  </select>
                  <div class="invalid-feedback">Por favor seleccione una opción!</div>
                </div>
                <div class="col-md-4">
                  <label for="km" class="form-label">Kilometraje Habilitado <font color="red">*</font></label>
                  <input type="number" class="form-control" name="km" id="km" min="1" required>
                  <div class="invalid-feedback">Por favor ingrese números mayores a 1!</div>
                </div>
                <div class="col-md-6">
                  <label for="sucursal" class="form-label">Sucursal <font color="red">*</font></label>
                  <select id="sucursal" name="sucursal" class="form-select" required>
                    <option disabled="disabled" selected="selected"></option>
                    <?php
                      while ($sucursales = mysqli_fetch_array($cmd)) {
                      echo '<option value="'.$sucursales['OID'].'">'.$sucursales['empresa'].' - '.$sucursales['sucursal'].' - '.$sucursales['localidad'].' - '.$sucursales['provincia'].'</option>';
                      }
                      ?>                                              
                    </select>
                    <div class="invalid-feedback">Por favor seleccione una sucursal!</div>
                </div>
                <div class="col-md-6">
                  <label for="precio" class="form-label">Precio por día ($) <font color="red">*</font></label>
                  <input type="number" class="form-control" name="precio" id="precio" step="0.01" min="5000" required>
                  <div class="invalid-feedback">Por favor ingrese un valor mayor a 5000.00!</div>
                </div>
                <div class="col-md-6">
                  <label for="imagen" class="col-sm-2 col-form-label">Imagen <font color="red">*</font></label>
                  <div class="col-sm-10">
                    <input class="form-control" type="file" name="imagen" id="imagen" required>
                    <div class="invalid-feedback">Por favor seleccione una imagen!</div>
                  </div>
                </div>

              <h5 class="card-title">Accesorios</h5>

              <div class="row mb-3">
                            <div class="col-md-12">
                                <button class="btn btn-primary" id="agregar">Agregar accesorio <i class="bi bi-plus-circle"></i></button>
                            </div>
                        </div>
                        <div class="row mb-3 clonar">
                            <div class="col-md-6">
                              <select id="accesorio[]" name="accesorio[]" class="form-select">
                                <option disabled="disabled" selected="selected"></option>
                                <?php
                                  while ($accesorios = mysqli_fetch_array($cmdAcc)) {
                                  echo '<option value="'.$accesorios['idAccesorio'].'">'.$accesorios['accesorio'].'</option>';
                                  }
                                  ?>                                              
                                </select>
                                <span class="btn btn-danger badge badge-pill badge-danger puntero ocultar">Eliminar</span>
                            </div>
                         </div>
                        <div id="contenedor"></div>




                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Guardar</button>
                  <button type="reset" class="btn btn-secondary">Borrar</button>
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

  <script>
    
    let agregar = document.getElementById('agregar');
    let contenido = document.getElementById('contenedor');

    let boton_enviar = document.querySelector('#enviar_contacto')

    agregar.addEventListener('click', e =>{
        e.preventDefault();
        let clonado = document.querySelector('.clonar');
        let clon = clonado.cloneNode(true);

        contenido.appendChild(clon).classList.remove('clonar');

        let remover_ocutar = contenido.lastChild.childNodes[1].querySelectorAll('span');
        remover_ocutar[0].classList.remove('ocultar');
    });

    contenido.addEventListener('click', e =>{
        e.preventDefault();
        if(e.target.classList.contains('puntero')){
            let contenedor  = e.target.parentNode.parentNode;
        
            contenedor.parentNode.removeChild(contenedor);
        }
    });


    boton_enviar.addEventListener('click', e => {
        e.preventDefault();

        const formulario = document.querySelector('#form_contacto');
        const form = new FormData(formulario);

        const peticion = {
            body:form,
            method:'POST'
        };

        fetch('php/inserta-contacto.php',peticion)
            .then(res => res.json())
            .then(res => {
                if (res['respuesta']) {
                    alert(res['mensaje']);
                    formulario.reset();
                }else{
                    alert(res['mensaje']);
                }

            });


    });


</script>



  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>


</body>

</html>
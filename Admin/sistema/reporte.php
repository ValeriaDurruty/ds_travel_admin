<?php 
	session_start();

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $desde = strtotime($_POST['desde']);
    $hasta = strtotime($_POST['hasta']);
    $actual = strtotime(date("Y-m-d"));


    if($desde > $actual or $hasta > $actual){
      echo'<script type="text/javascript" > alert("Las fechas no pueden ser posteriores a la fecha actual.");
      window.location.href="reporte.php"; </script>';
    }else{
    if ($desde > $hasta){
          echo'<script type="text/javascript" > alert("La fecha del campo desde no puede ser mayor que la del campo hasta.");
          window.location.href="reporte.php"; </script>';
    }}

      include "../conexion.php";
        $ini = $_POST['desde'];
        $fin = $_POST['hasta'];
        $cmd = mysqli_query($conexion,"SELECT * FROM `reserva` WHERE fechaCreacion BETWEEN '$ini' AND '$fin' ORDER BY fechaCreacion ASC");
        $total = mysqli_num_rows($cmd);

        if ($total){


          //generar reporte con los datos de la consulta
          
          
          
          require('assets/fpdf185/fpdf.php');

          class PDF extends FPDF
          {
          // Cabecera de página
          function Header()
          {
              global $total;
              $this->SetFont('Times','B',20);
              $this->Image('assets/img/header.png',0,0,220); //imagen(archivo, png/jpg || x,y,tamaño)
              $this->Image('assets/img/ds_travel.png',60,10,15); //imagen(archivo, png/jpg || x,y,tamaño)
              $this->setXY(60,15);
              $this->Cell(100,10,utf8_decode('Reservas Vehículos'),0,1,'C',0);
              $this->SetFont('Times','B',15);
              $this->Cell(200,10,'Desde: '.$_POST['desde'].' Hasta: '.$_POST['hasta'],0,1,'C',0);
              $this->Cell(200,10,'Total Reservas: '.$total,0,1,'C',0);
              $this->Ln(20);
          }

          // Pie de página
          function Footer()
          {
              // Posición: a 1,5 cm del final
              $this->SetY(-15);
              // Arial italic 8
              $this->SetFont('Arial','B',10);
              // Número de página
              $this->Cell(170,10,'',0,0,'C',0);
              $this->Cell(25,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
          }
          }

          // Creación del objeto de la clase heredada
          $pdf = new PDF();//hacemos una instancia de la clase
          $pdf->AliasNbPages();
          $pdf->AddPage();//añade l apagina / en blanco
          $pdf->SetMargins(10,10,10);
          $pdf->SetAutoPageBreak(true,20);//salto de pagina automatico
          $pdf->SetX(25);
          $pdf->SetFont('Helvetica', 'B', 12);
          $pdf->Cell(60,8,'Fecha Inicio Alquiler',1,0,'C',0);
          $pdf->Cell(60,8,'Fecha Fin Alquiler',1,0,'C',0);
          $pdf->Cell(40,8,'Costo',1,0,'C',0);
          $pdf->Ln();

          $pdf->SetFillColor(255, 255, 255);//color de fondo rgb
          $pdf->SetDrawColor(61, 61, 61);//color de linea  rgb

          $pdf->SetFont('Helvetica', 'B', 10);

          while ($resultado = mysqli_fetch_array($cmd)) {
          
              
          $pdf->SetX(25);
          $pdf->Cell(60,8, $resultado['fechaInicio'],1,0,'C',1);
          $pdf->Cell(60,8, $resultado['fechaFin'],1,0,'C',1);
          $pdf->Cell(40,8, '$'.$resultado['monto'],1,0,'C',1);
          $pdf->Ln();

          }
          // cell(ancho, largo, contenido,borde, salto de linea, alineación)

          $pdf->Output('I', 'reservas_por_fecha.pdf');
          
          
                          if(!$pdf){
                            //error de reporte
                              echo'<script type="text/javascript" > alert("No se pudo generar el reporte. Intente nuevamente.");
                              window.location.href="reporte.php"; </script>';
                          }
            }else{
              echo'<script type="text/javascript" > alert("No hay reservas en el rango de fechas seleccionadas.");
                    window.location.href="reporte.php"; </script>';
            }
          }
                     
                  
          
              
          
          
          


    
 ?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Reportes - DS Travel</title>
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
          <li class="breadcrumb-item active">Reportes</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

      <div class="card">
            <div class="card-body">
              <h5 class="card-title">Reportes</h5>

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
                <img src="./assets/img/PAGINA_EN_CONSTRUCCION.jpg" alt="Página en construcción" height="500" style="display: block; margin: 0 auto;">
                </div>
                <div class="tab-pane fade" id="bordered-justified-vuelos" role="tabpanel" aria-labelledby="vuelos-tab">
                <img src="./assets/img/PAGINA_EN_CONSTRUCCION.jpg" alt="Página en construcción" height="500" style="display: block; margin: 0 auto;">
                </div>
                <div class="tab-pane fade" id="bordered-justified-vehiculos" role="tabpanel" aria-labelledby="vehiculos-tab">
                  
                <section class="section dashboard">
      <div class="row">


      <div class="card">
            <div class="card-body">
              <h5 class="card-title">Reservas</h5>

              <!-- Accordion without outline borders -->
              <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                  <h2 class="accordion-header" id="flush-headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                      Por fecha
                    </button>
                  </h2>
                  <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">

                    
                        <!-- Multi Columns Form -->
                        <form class="row g-3 needs-validation" method="POST" action="" target="_blank" novalidate>
                        <div class="col-md-6">
                            <label for="desde" class="form-label">Desde <font color="red">*</font></label>
                            <input type="date" class="form-control" name= "desde" id="desde" max="<?php echo date("Y"); ?>" required>
                            <div class="invalid-feedback">Por favor ingrese una fecha!</div>
                          </div>
                          <div class="col-md-6">
                            <label for="hasta" class="form-label">Hasta <font color="red">*</font></label>
                            <input type="date" class="form-control" name= "hasta" id="hasta" max="<?php echo date("Y"); ?>" required>
                            <div class="invalid-feedback">Por favor ingrese una fecha!</div>
                          </div>
                          <div class="text-center">
                            <button type="submit" class="btn btn-primary">Generar</button>
                            <button type="reset" class="btn btn-secondary">Borrar</button>
                          </div>
                          </form>

                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="flush-headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                      Por cliente
                    </button>
                  </h2>
                  <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        
                        <div class="text-center">
                        <a href="reporteXcliente.php" type="submit" class="btn btn-primary" target="_blank">Generar</a>
                        </div>


                    </div>
                  </div>
                </div>
              </div><!-- End Accordion without outline borders -->

            </div>
          </div>


</div>
</section>




                </div>
                <div class="tab-pane fade" id="bordered-justified-paquetes" role="tabpanel" aria-labelledby="paquetes-tab">
                <img src="./assets/img/PAGINA_EN_CONSTRUCCION.jpg" alt="Página en construcción" height="500" style="display: block; margin: 0 auto;">
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
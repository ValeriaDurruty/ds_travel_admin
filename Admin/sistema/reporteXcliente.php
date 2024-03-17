<?php

  include "../conexion.php";


    $cmd = mysqli_query($conexion,"SELECT r.fechaCreacion, r.fechaInicio, r.fechaFin, r.monto, u.OID, u.nombre, u.apellido, u.correo, u.fechaNacimiento, u.tipoDocumento, u.dni, u.telefono, d.calle, d.altura, d.ciudad, d.codigoPostal, d.region, d.pais 
                                    FROM `reserva` r INNER JOIN `usuario` u ON r.idCliente = u.OID 
                                    INNER JOIN domicilio d ON u.fk_domicilio = d.OID ORDER BY u.OID ASC");
    $total = mysqli_num_rows($cmd);

        if ($total){

  		require('assets/fpdf185/fpdf.php');

          class PDF extends FPDF
          {
          // Cabecera de página
          function Header()
          {
              global $total;
              $this->SetFont('Times','B',20);
              $this->Image('assets/img/header.png',0,0,220); //imagen(archivo, png/jpg || x,y,tamaño)
              $this->Image('assets/img/ds_travel.png',45,10,15); //imagen(archivo, png/jpg || x,y,tamaño)
              $this->setXY(60,15);
              $this->Cell(100,10,utf8_decode('Reservas Vehículos por Clientes'),0,1,'C',0);
              $this->SetFont('Times','B',15);
              $this->Cell(200,10,'Total Reservas: '.$total,0,1,'C',0);
              $this->Ln(30);
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

          function encabezado_tabla($pdf) {
            $pdf->SetFont('Helvetica', 'B', 10);
            $pdf->SetX(25);
            $pdf->Cell(40, 7, utf8_decode('Fecha de Creación'), 1,  0, 'C');
            $pdf->Cell(40, 7, 'Fecha Inicio Alquiler', 1,  0, 'C');
            $pdf->Cell(40, 7, 'Fecha Fin Alquiler', 1,  0, 'C');
            $pdf->Cell(40, 7, 'Costo', 1,  0, 'C');
            $pdf->Ln();
          }

          function total_reservas($pdf, $totalReservas) {
                if (isset($totalReservas)) {
                    $pdf->SetFont('Helvetica', 'B', 10);
                    $pdf->SetX(25);
                    $pdf->Cell(80, 7, '', 3);
                    $pdf->Cell(40, 7, 'Total', 0, 0, 'R');
                    $pdf->Cell(40, 7, ' $ ' . number_format($totalReservas, 2, ',', '.'), 1, 1, 'R');
                    $pdf->Ln(10);
                    $pdf->Cell(190, 7, '------------------------------------------------------------------------------------------------------------------------------------------',0,1, 'C');
                    $pdf->Ln(10);
                }
           }


            // Creación del objeto de la clase heredada
            $pdf = new PDF();//hacemos una instancia de la clase
            $pdf->AliasNbPages();
            $pdf->AddPage();//añade l apagina / en blanco
            $pdf->SetMargins(10,10,10);
            $pdf->SetAutoPageBreak(true,20);//salto de pagina automatico
            $pdf->SetFont('Helvetica', '', 10);

            $idCliente = null;
            $totalReservas = null;

            while($resultado = mysqli_fetch_array($cmd)) {
                if ($resultado['OID'] != $idCliente){

                    // muestro el total de las reservas del cliente anterior
                    total_reservas($pdf, $totalReservas);
                    //seteo en null el contador
                    $totalReservas = null;

                    // muestro encabezado de grupo
                    $pdf->SetFont('Helvetica', 'B', 10);
                    $pdf->SetX(30);
                    $pdf->Cell(20, 7, 'Cliente: ',0,0);
                    $pdf->Cell(60, 7, utf8_decode($resultado['apellido'].', ' . $resultado['nombre']),0,0);
                    $pdf->Cell(20, 7, 'Domicilio: ',0,0);
                    $pdf->Cell(60, 7, utf8_decode($resultado['calle'].' Nº '. $resultado['altura']),0,1);
                    $pdf->SetX(50);
                    $pdf->Cell(80, 7, utf8_decode($resultado['tipoDocumento'].' Nº '. $resultado['dni']),0,0);
                    $pdf->SetX(130);
                    $pdf->Cell(60, 7, utf8_decode($resultado['ciudad']),0,1);
                    $pdf->SetX(50);
                    $pdf->Cell(60, 7, 'Fecha de Nac.: '. $resultado['fechaNacimiento'],0,0);
                    $pdf->SetX(130);
                    $pdf->Cell(60, 7, 'C.P. '. $resultado['codigoPostal'],0,1);
                    $pdf->SetX(50);
                    $pdf->Cell(60, 7, utf8_decode('Email: '. $resultado['correo']),0,0);
                    $pdf->SetX(130);
                    $pdf->Cell(60, 7, utf8_decode($resultado['region']),0,1);
                    $pdf->SetX(50);
                    $pdf->Cell(60, 7, utf8_decode('Teléfono: '. $resultado['telefono']),0,0);
                    $pdf->SetX(130);
                    $pdf->Cell(60, 7, utf8_decode($resultado['pais']),0,1);
                    $pdf->Ln();


            
                    // muestro encabezado de tabla
                    encabezado_tabla($pdf);
                }

                $pdf->SetFont('Helvetica', '', 10);
                $pdf->SetX(25);
                $pdf->Cell(40, 7, $resultado['fechaCreacion'], 1,  0, 'C');
                $pdf->Cell(40, 7, $resultado['fechaInicio'], 1, 0, 'C');
                $pdf->Cell(40, 7, $resultado['fechaFin'], 1, 0, 'C');
                $pdf->Cell(40, 7, $resultado['monto'], 1, 0, 'R');
                $pdf->Ln();

                $idCliente = $resultado['OID'];
                $totalReservas += $resultado['monto'];
            }

            // muestro el total de las reservas del último cliente
            total_reservas($pdf, $totalReservas);

            $pdf->Output('I', 'reservas_por_cliente.pdf');

            if(!$pdf){
                    //error de reporte
                    echo'<script type="text/javascript" > alert("No se pudo generar el reporte. Intente nuevamente.");
                        window.location.href="reporte.php"; </script>';
                                }
            }else{
                echo'<script type="text/javascript" > alert("No hay reservas que mostrar.");
                        window.location.href="reporte.php"; </script>';
            }

?>
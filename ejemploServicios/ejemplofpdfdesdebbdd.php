<?php

include_once 'libs/PDOConfig.php';
include_once 'libs/fpdf17/fpdf.php';

$base = new PDOConfig();
$sql='select Provincias.Nombre, count(*) as Cantidad from Clientes inner join Provincias
    on Clientes.idProvincia=Provincias.idProvincia
    group by Provincias.Nombre
    order by Provincias.Nombre';
$resultado = $base->query($sql);


//Inicializa columnas y total

$column_provincia = "";
$column_clientes = "";
$total = 0;
//por cada fila se crean las columnas y se suma el total
foreach ($resultado as $row) {


	$provincia = substr($row["Nombre"],0,20);
	$clientes = $row["Cantidad"];

	$column_provincia = $column_provincia.$provincia."\n";
	$column_clientes = $column_clientes.$clientes."\n";
        
	//se suma el total de clientes
	$total = $total+$clientes;
}



//se crea un objeto de la clase FPDF
$pdf=new FPDF();
$pdf->AddPage();

//Posición de los nombres de las columnas
$Y_Fields_Name_position = 20;
//Posición de la tabla
$Y_Table_Position = 26;


//Estilo de color para los nombre de las columnas
$pdf->SetFillColor(232,232,232);
//Font Bold Arial
$pdf->SetFont('Arial','B',12);
$pdf->SetY($Y_Fields_Name_position);

$pdf->SetX(20);
$pdf->Cell(100,6,'PROVINCIAS',1,0,'L',1);
$pdf->SetX(120);
$pdf->Cell(50,6,'CLIENTES',1,0,'R',1);
$pdf->Ln();

//Se muestran las columnas
$pdf->SetFont('Arial','',12);
$pdf->SetY($Y_Table_Position);
$pdf->SetX(20);
$pdf->MultiCell(100,6,$column_provincia,1);
$pdf->SetY($Y_Table_Position);
$pdf->SetX(120);
$pdf->MultiCell(50,6,$column_clientes,1,'R');
$pdf->SetX(120);
$pdf->MultiCell(50,6,'Total  '.$total,1,'R');


$pdf->Output();
?>
<?php
require('jpgraph/src/jpgraph.php');
require('jpgraph/src/jpgraph_line.php');

$grafica = new Graph(600,450);   //600px ample, 450px alçada
$grafica->SetScale("textlin", 0, 80);  //Eix x text. Eix Y lineal. comença en 0 i acaba en 80

$tema = new UniversalTheme;
$grafica->SetTheme($tema);    //Tema, estil

$grafica->img->SetAntiAliasing();  //3d 

$grafica->title->Set("Vendes mensuals");
$grafica->title->SetFont(FF_FONT0, FS_BOLD, 14);
$grafica->title->SetColor("#33AA33");
$grafica->title->SetMargin(20);

$grafica->xaxis->SetTitle("Producte", "center");
$grafica->yaxis->SetTitle("Quantitat", "middle");
$grafica->xaxis->title->SetFont(FF_FONT0, FS_BOLD, 12);
$grafica->yaxis->title->SetFont(FF_FONT0, FS_BOLD, 12);
$grafica->xaxis->SetTitleMargin(20);
$grafica->yaxis->SetTitleMargin(40);


$grafica->xaxis->SetTickLabels(array('Producte 1', 'Producte 2', 'Producte 3')); //Text eix X
$grafica->xgrid->SetColor('#FFAA55');
$grafica->xgrid->Show();
$grafica->SetMargin(100, 60, 60, 60);

$linia1 = new LinePlot(array(30, 25, 41));  //Serie 1: Una línia
$grafica->Add($linia1);
$linia1->SetColor('#33AAAA');

$linia2 = new LinePlot(array(14, 51, 21));  //Serie 1: Una línia
$grafica->Add($linia2);
$linia1->SetColor('#333399');

$grafica->Stroke();   // Mostra la gràfica
?>
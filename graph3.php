<?php
require('jpgraph/src/jpgraph.php');
require('jpgraph/src/jpgraph_pie.php');

$grafica = new PieGraph(600, 450);

$grafica->title->Set("Gràfica de sectors");
$grafica->SetBox(true);

$p1 = new PiePlot(array(150, 200, 10));
$grafica->Add($p1);

$p1->SetColor('black');
$p1->SetLegends(array("Producte 1", "Producte 2", "Producte 3"));
$p1->SetSliceColors(array('#FF0000', '#00FF00', '#0000FF'));
$grafica->Stroke();
?>
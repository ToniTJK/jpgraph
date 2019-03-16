<?php
require('jpgraph/src/jpgraph.php');
require('jpgraph/src/jpgraph_bar.php');

$grafica = new Graph(600, 450, "auto");
$grafica->SetScale("textlin", 0, 50);

$tema = new UniversalTheme;
$grafica->SetTheme($tema);    //Tema, estil

$grafica->img->SetAntiAliasing();  //3d 

$grafica->xaxis->SetTickLabels(Array("Producte 1", "Producte 2", "Producte 3"));

$barres = new BarPlot(array(20, 35, 14));

$barres->SetColor("white");
$barres->SetFillColor("#3333FF");
$barres->SetWidth(40);

$grafica->title->Set("Preus dels productes");
$grafica->xaxis->SetTitle("Productes");
$grafica->yaxis->SetTitle("Preus");
$grafica->Add($barres);

$grafica->SetBox(false);
$grafica->ygrid->SetFill(false);

$grafica->Stroke();

?>
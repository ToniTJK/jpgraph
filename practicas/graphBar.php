<?php
$conexio = new mysqli("localhost", "root", "root", "empresa");
$lasql = "SELECT nom, comisio FROM `empleats` WHERE comisio > 0";
$consulta= $conexio->prepare($lasql);
$consulta->bind_result($nom, $comisio);
$consulta->execute();
$noms = Array();
$valors = Array();
$index = 0;
while ($consulta->fetch()){
	$noms[$index] = $nom;
	$valors[$index] = $comisio;
	$index++;
}

require('../jpgraph/src/jpgraph.php');
require('../jpgraph/src/jpgraph_bar.php');

$grafica = new Graph(600, 450, "auto");
$grafica->SetScale("textlin", 0, 1500);

$tema = new UniversalTheme;
$grafica->SetTheme($tema);    //Tema, estil

$grafica->img->SetAntiAliasing();  //3d 

$grafica->xaxis->SetTickLabels($noms);

$barres = new BarPlot($valors);

$barres->SetColor("white");
$barres->SetFillColor("#3333FF");
$barres->SetWidth(40);

$grafica->title->Set("Empleados que cobran comision");
$grafica->xaxis->SetTitle("Empleats");
$grafica->yaxis->SetTitle("Sous");
$grafica->Add($barres);

$grafica->SetBox(false);
$grafica->ygrid->SetFill(false);

$grafica->Stroke();
?>
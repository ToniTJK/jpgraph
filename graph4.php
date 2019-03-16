<?php
$conexio = new mysqli("localhost", "root", "root", "empresa");
$lasql = "select nom, max(sou) from empleats group by ndepartament";
$consulta= $conexio->prepare($lasql);
$consulta->bind_result($nom, $maxim);
$consulta->execute();
$noms = Array();
$valors = Array();
$index = 0;
while ($consulta->fetch()){
	$noms[$index] = $nom;
	$valors[$index] = $maxim;
	$index++;
}


require('jpgraph/src/jpgraph.php');
require('jpgraph/src/jpgraph_bar.php');

$grafica = new Graph(600, 450, "auto");
$grafica->SetScale("textlin", 0, max($valors)*1.2);

$tema = new UniversalTheme;
$grafica->SetTheme($tema);    //Tema, estil

$grafica->img->SetAntiAliasing();  //3d 

$grafica->xaxis->SetTickLabels($noms);

$barres = new BarPlot($valors);

$barres->SetColor("white");
$barres->SetFillColor("#3333FF");
$barres->SetWidth(40);

$grafica->Add($barres);


$grafica->title->Set("Sous màxims de cada departament");
$grafica->title->SetFont(FF_FONT0, FS_BOLD, 14);
$grafica->xaxis->SetTitle("Empleat", "center");
$grafica->yaxis->SetTitle("Sou", "middle");
$grafica->xaxis->title->SetFont(FF_FONT0, FS_BOLD, 12);
$grafica->yaxis->title->SetFont(FF_FONT0, FS_BOLD, 12);
$grafica->SetMargin(80, 80, 80, 80);
$grafica->xaxis->SetTitleMargin(20);
$grafica->yaxis->SetTitleMargin(50);
$grafica->title->SetMargin(20);

$grafica->SetBox(false);
$grafica->ygrid->SetFill(false);

$grafica->Stroke();

?>
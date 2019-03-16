<?php
//SELECT *, SUM(sou) AS 'SUMA' FROM empleats INNER JOIN departaments WHERE empleats.ndepartament = departaments.codi GROUP BY ndepartament

$conexio = new mysqli("localhost", "root", "root", "empresa");
$lasql = "SELECT departaments.nom, SUM(sou) AS 'SUMA' FROM empleats 
		  INNER JOIN departaments ON empleats.ndepartament = departaments.codi 
		  GROUP BY ndepartament ORDER BY SUMA ASC";
$consulta= $conexio->prepare($lasql);
$consulta->bind_result($nom, $suma);
$consulta->execute();
$noms = Array();
$valors = Array();
$index = 0;
while ($consulta->fetch()){
	$noms[$index] = $nom;
	$valors[$index] = $suma;
	$index++;
}

require('../jpgraph/src/jpgraph.php');
require('../jpgraph/src/jpgraph_line.php');

$grafica = new Graph(800,600);   //600px ample, 450px alçada
$grafica->SetScale("textlin", 0, 20000);  //Eix x text. Eix Y lineal. comença en 0 i acaba en 80

$tema = new UniversalTheme;
$grafica->SetTheme($tema);    //Tema, estil

$grafica->img->SetAntiAliasing();  //3d 

$grafica->title->Set("SUMA total de sous en cada Departament");
$grafica->title->SetFont(FF_FONT0, FS_BOLD, 14);
$grafica->title->SetColor("#000000");
//$grafica->title->SetMargin(20);

$grafica->xaxis->SetTitle("Noms", "center");
$grafica->yaxis->SetTitle("Comisio", "center");
$grafica->xaxis->title->SetFont(FF_FONT0, FS_BOLD, 21);
$grafica->yaxis->title->SetFont(FF_FONT0, FS_BOLD, 21);
//$grafica->xaxis->SetTitleMargin(20);
//$grafica->yaxis->SetTitleMargin(40);


$grafica->xaxis->SetTickLabels($noms); //Text eix X
//$grafica->xgrid->SetColor('#FFAA55');
//$grafica->xgrid->Show();
//$grafica->SetMargin(100, 60, 60, 60);

$linia1 = new LinePlot($valors);  //Serie 1: Una línia
$grafica->Add($linia1);
$linia1->SetColor('#33AAAA');

/*$linia2 = new LinePlot(array(14, 51, 21));  //Serie 1: Una línia
$grafica->Add($linia2);
$linia1->SetColor('#333399');*/

$grafica->Stroke();   // Mostra la gràfica
?>
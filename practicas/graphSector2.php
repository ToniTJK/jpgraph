<?php
if(isset($_GET['nomDepartament'])){
    $nomDepartament = $_GET['nomDepartament'];
    $conexio = new mysqli("localhost", "root", "root", "empresa");
    $lasql = "SELECT empleats.nom, empleats.sou, departaments.nom FROM empleats 
              INNER JOIN departaments ON empleats.ndepartament = departaments.codi 
              WHERE departaments.nom = ?";
    $consulta= $conexio->prepare($lasql);
    $consulta->bind_param("s", $nomDepartament);
    $consulta->bind_result($nom, $sou, $departament);
    $consulta->execute();
    $noms = Array();
    $valors = Array();
    $index = 0;
    while ($consulta->fetch()){
        $noms[$index] = $nom;
        $valors[$index] = $sou;
        $departament[$index] = $departament;
        $index++;
    }
    
    require('../jpgraph/src/jpgraph.php');
    require('../jpgraph/src/jpgraph_pie.php');
    
    $grafica = new PieGraph(600, 450);
    
    $grafica->title->Set("Sous dels empleats del Departament de ".$departament);
    $grafica->SetBox(true);
    
    $p1 = new PiePlot($valors);
    $grafica->Add($p1);
    
    $p1->SetColor('black');
    $p1->SetLegends($noms);
    $p1->SetSliceColors(array('#FF0000', '#00FF00', '#0000FF', '#3B3B3B', '#BBFFFF', '#FFA153', '#1C8A8D'));
    $grafica->Stroke();
} else {
    echo 'Tienes que pasar por <a href="graphSector1.html">graphSector1.html</a> para pasar un paramentro.';
}
?>

<?php

$options = array(
'tache' => FILTER_SANITIZE_STRING
);
$result = filter_input_array(INPUT_POST, $options);
if($result != null && $result != FALSE && $_SERVER['REQUEST_METHOD']=='POST')
{
$tache=$_POST["tache"];
ecrireJSON($tache, false);
}
function ecrireJSON($tache, $terminer)
{
$filename = "./todo.json";
$tab = array("Nom" => $tache, "Terminer" => $terminer );
$json = json_encode($tab);
$json .= "\n";
$file=file_put_contents($filename, $json, FILE_APPEND | LOCK_EX);
}



function afficheJSON($termin)
{
$filename = "todo.json";
$tab = file($filename);
for($i=0; $i < sizeof($tab); $i++)
{
$obj = json_decode($tab[$i]);
$nom = $obj->{'Nom'};
if($obj->{'Terminer'} == $termin)
{
$txt = '<input type="checkbox" name="'.$nom.'" value="';
$txt .= $nom.'" ';
$txt .= $termin?"checked":"";
$txt .= ">";
$txt .= '<label ';
$txt .= 'class=""';
$txt .= $termin?"tache_terminer":"tache_non_terminer";
$txt .= '" ';
$txt .= 'for=""'.$nom.'">'.$nom.'</label>';
$txt .= "<br/>";
echo $txt;
}
}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>To-do list</title>
</head>
<body>

  <fieldset>
    <legend>A FAIRE</legend>
    <?php afficheJSON(false); ?>
  </fieldset>
  <fieldset>
    <legend>ARCHIVE</legend>
    <?php afficheJSON(true); ?>
  </fieldset>
<form method="POST" action="formulaire.php">
  <fieldset>
    <label for="tache">Ajouter une tâche</label>
    <p><span>Liste des tâches a effectuer</span></p>
    <textarea rows="3" cols="50" name="tache" value="">
    </textarea>
    <input type="submit" name="submit" value="Valider">
  </fieldset>
</form>
</body>
</html>
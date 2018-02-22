<?php
    $filename="todo.json";
    $contenu_json = file_get_contents($filename);
    $receipt = json_decode($contenu_json, true);
        
    if (isset($_POST['submit']) AND end($receipt)['Nom'] != $_POST['addtask']){
        $add_tache = $_POST['addtask'];
        $array_tache = array("Nom" => $add_tache,
                             "Terminer" => false);
        $receipt[] = $array_tache;
        $json= json_encode($receipt, JSON_PRETTY_PRINT);
        file_put_contents($filename, $json);
        $receipt = json_decode($json, true);
    }
    
    if (isset($_POST['save'])){
        $choix=$_POST['addtask'];

        for ($init = 0; $init < count($receipt); $init ++){
            if (in_array($receipt[$init]['Nom'], $choix)){
              $receipt[$init]['Terminer'] = true;
            }
        }

        $json= json_encode($receipt, JSON_PRETTY_PRINT);
        file_put_contents($filename, $json);
        $receipt = json_decode($json, true);
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>To Do List</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" media="screen" href="style.css" />
    </head>
    <body>
        <section class="page">
            <div class="formulaire">
                <section class="task">
                    <div class="title_task">
                        <h2>A Faire</h2>
                    </div>
                    <div class="todotask">
                        <form action="contenu.php" method="post" name="formafaire">
                            <?php
                                foreach ($receipt as $key => $value){
                                    if ($value["Terminer"] == false){
                                        echo "<input type='checkbox' name='addtask[]' value='".$value["Nom"]."'/>
                                            <label for='choix'>".$value["Nom"]."</label><br />";
                                    }
                                }
                            ?>
                            <input type="submit" name="save" value="Enregistrer" >
                        </form>
                    </div>
                </section>
                <section class="archives">
                    <div class="title_archives">
                        <h2>Archives</h2>
                    </div>
                    <div class="listarchives">
                        <form action="contenu.php" method="post" name="formchecked">
                            <?php
                                foreach ($receipt as $key => $value){

                                    if ($value["Terminer"] == true){

                                        echo "<input type='checkbox' name='addtask[]' value='".$value."'checked/>
                                            <label for='choix'>".$value["Nom"]."</label><br />";
                                    }
                                }
                            ?>
                        </form>
                    </div>
                </section>
            </div>
            <div class="formulaire">
                <form method="get" name="ajout" action="contenu.php">
                <section class="addtask">
                    <div class="title_add">
                        <h1>Ajouter une tâche</h1>
                        <h2>La tâche à effectuer</h2>
                    </div>
                    <div class="add">
                        <form class="" action="contenu.php" method="post">
                            <input type="text" name="addtask" value="">
                            <input type="submit" name="submit" value="Ajouter">
                        </form>
                    </div>
                </section>
                </form>
            </div>
        </section>
    </body>
    <footer>
        <audio autoplay loop="">
            <source src="https://archive.org/download/nyannyannyan/NyanCatoriginal.ogg" type="audio/ogg">
        </audio>
    </footer>
</html>
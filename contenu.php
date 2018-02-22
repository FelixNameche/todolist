<?php
    if(isset($_POST['submit'])){

        $options = array(
        'todo' => FILTER_SANITIZE_STRING,
        'archive'  => FILTER_SANITIZE_STRING,
        'addtask'   => FILTER_SANITIZE_STRING
        );
      
        $result = filter_input_array(INPUT_POST, $options);
        $checkResult =[];

        $todo = trim($result['todo']);
        $archive = trim($result['archive']);
        $addtask = trim($result['addtask']);

        if(isset($todo) AND !empty($todo) ){
        $verif_todo = "ok";
        }
        else {
        $verif_todo = "pok";
        }
    
        if(isset($archive) AND !empty($archive) ){
        $verif_archive = "ok";
        }
        else {
        $verif_archive = "pok";
        }
    
        if(isset($addtask) AND !empty($addtask) ){
        $verif_addtask = "ok";
        }
        else {
        $verif_addtask = "pok";
        }
    }
    // var_dump($addtask);

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
                <form method="post" name="formulaire" action="contenu.php">
                <section class="task">
                    <div class="title_task">
                        <h2>A Faire</h2>
                    </div>
                    <div class="todotask">
                        <?php
                            $contenu_fichier_json = file_get_contents('./todo.json');
                            $receipt = json_decode($contenu_fichier_json, true);
                            // print_r($receipt);
                            foreach ($receipt as $key => $value) {
                                if ($value["Terminer"] == false){
                                    echo '<input type="checkbox" name="addtask[]" value="Nom">'.$value["Nom"].'<br/>';
                                }
                                else {
                                    echo '';
                                }
                            }
                        ?>  
                    </div>
                    <input name="save" type="submit" value="Enregistrer">
                    <?php
                        if (isset($_POST['save'])){
                            $check=$_POST['addtask'];
                            for ($init = 0; $init < count($receipt); $init ++){
                                if (in_array($receipt[$init]['Nom'], $check)){
                                $receipt[$init]['Terminer'] = true;
                                }
                            }
                    ?>
                </section>
                <section class="archives">
                    <div class="title_archives">
                        <h2>Archives</h2>
                    </div>
                    <div class="listarchives">
                        <?php
                            foreach ($receipt as $key => $value) {
                                if ($value["Terminer"] == true){
                                    echo '<input type="checkbox" name="archive" value="addtask[]" checked>'.$value["Nom"].'<br/>';
                                }
                                else {
                                    echo '';
                                }
                            }
                        ?>
                    </div>
                </section>
                </form>
            </div>
            <div class="formulaire">
                <form method="post" name="ajout" action="contenu.php">
                <section class="addtask">
                    <div class="title_add">
                        <h1>Ajouter une tâche</h1>
                        <h2>La tâche à effectuer</h2>
                    </div>
                    <div class="add">
                    <input type="text" name="addtask">
                        <?php
                            if(isset($_POST['submit'])){
                                $filename = "./todo.json";
                                $receipt[]= array("Nom" => $addtask, "Terminer" => false);
                                // print_r($receipt);
                                $json = json_encode($receipt, JSON_PRETTY_PRINT);
                                $file=file_put_contents($filename, $json, LOCK_EX);
                            }
                        ?>
                        <input type="submit" name="submit" value="Ajouter">
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
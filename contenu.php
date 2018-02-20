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
                        foreach ($receipt as $key => $value) {
                            if ("Terminer" == false){
                                echo '<input type="checkbox" name="todo" value="Nom">'.$value.'<br/>';
                            }
                            else {
                                echo '';
                            }
                        }
                    ?>
                    <button name="submit" type="submit" form="formulaire">Enregistrer</button>
                </div>
            </section>
            <section class="archives">
                <div class="title_archives">
                    <h2>Archives</h2>
                </div>
                <div class="listarchives">
                    <?php
                        foreach ($receipt as $key => $value) {
                            if ("Terminer" == true){
                                echo '<input type="checkbox" name="archive" value="$key" checked>'.$value.'<br/>';
                            }
                            else {
                                echo '';
                            }
                        }
                    ?>
                </div>
            </section>
            <section class="addtask">
                <div class="title_add">
                    <h1>Ajouter une tâche</h1>
                    <h2>La tâche à effectuer</h2>
                </div>
                <div class="add">
                <input type="text" name="addtask">
                    <input type="submit" name="submit" value="Ajouter">
                    <?php
                        if(isset($_POST['submit'])){
                            $filename = "./todo.json";
                            $tab = array("Nom" => $addtask, "Terminer" => false );
                            $json = json_encode($tab);
                            $json .= "\n";
                            $file=file_put_contents($filename, $json, FILE_APPEND | LOCK_EX);
                        }
                    ?>
                </div>
            </section>
            </form>
        </div>
    </section>
</body>
</html>
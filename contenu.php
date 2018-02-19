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
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>To Do List</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" media="screen" href="style.css" />
        <script src="fr.json"></script>
        <script src="en.json"></script>
    </head>
    <body>
        <section class="page">
            <div class="formulaire">
                <form name="formulaire" action="contenu.php">
                <section class="task">
                    <div class="title_task">
                        <h1>A Faire</h1>
                    </div>
                    <div class="todotask">
                        <input type="checkbox" name="todo" value="todo1">Faire les courses<br/>
                        <input type="checkbox" name="todo" value="todo2">Terminer le projet "QCM"<br/>
                        <input type="checkbox" name="todo" value="todo3">Rappeler Grand-mère<br/>
                        <input type="checkbox" name="todo" value="todo4">Terminer le générateur aléatoire de PNJ's<br/>
                        <button name="submit" type="submit" form="formulaire">Enregistrer</button>
                    </div>
                </section>
                <section class="archives">
                    <div class="title_archives">
                        <h1>Archives</h1>
                    </div>
                    <div class="listarchives">
                        <input type="checkbox" name="archive" value="archive1" checked>Payer la facture sielga<br />
                        <input type="checkbox" name="archive" value="archive2" checked>Imiter le cri de Chewbaka<br />
                        <input type="checkbox" name="archive" value="archive3" checked>Dormir<br />            
                    </div>
                </section>
                <section class="addtask">
                    <div class="title_add">
                    
                    </div>
                    <div class="add">
                    
                    </div>
                </section>
                </form>
            </div>
        </section>
    </body>
</html>
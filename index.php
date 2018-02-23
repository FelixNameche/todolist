            <?php
            $_POST['addtask'] = filter_var($_POST['addtask'], FILTER_SANITIZE_STRING);
            // $_POST['save'] = filter_var($_POST['save'], FILTER_SANITIZE_STRING);
            // $_POST['unsave'] = filter_var($_POST['unsave'], FILTER_SANITIZE_STRING);
            // $_POST['addtask[]'] = filter_var($_POST['addtask[]'], FILTER_SANITIZE_STRING);
            // $_POST['removetask[]'] = filter_var($_POST['removetask[]'], FILTER_SANITIZE_STRING);
            ini_set("dispay_errors",0);error_reporting(0);
            $filename="todo.json";
            $contenu_json = file_get_contents($filename);
            $receipt = json_decode($contenu_json, true);
            
            // bouton ajouter
            if (isset($_POST['submit']) AND end($receipt)['Nom'] != $_POST['addtask']){
                $add_tache = $_POST['addtask'];
                $array_tache = array("Nom" => $add_tache,
                                    "Terminer" => false);
                $receipt[] = $array_tache;
                $json= json_encode($receipt, JSON_PRETTY_PRINT);
                file_put_contents($filename, $json);
                $receipt = json_decode($json, true);
            }
            
            // bouton enregistrer
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
    
            // bouton retirer
            if (isset($_POST['unsave'])){
                $choix=$_POST['removetask'];
                // var_dump($choix);
                for ($init = 0; $init < count($receipt); $init ++){
                    if (!in_array($receipt[$init]['Nom'], $choix)){
                    $receipt[$init]['Terminer'] = false;
                    }
                }
                $json= json_encode($receipt, JSON_PRETTY_PRINT);
                file_put_contents($filename, $json);
                $receipt = json_decode($json, true);
            }
    
            if(isset($_POST['submit'])){
    
                $options = array(
                'addtask' => FILTER_SANITIZE_STRING);
            
                $result = filter_input_array(INPUT_POST, $options);
                $checkResult =[];
            
                $addtask = trim($result['addtask']);
            
                if(isset($addtask) AND !empty($addtask) ){
                $verif_addtask = "ok";
                }
                else {
                $verif_addtask = "pok";
                }
            }
    
            if(isset($_POST['save'])){
    
                $options = array(
                'addtask[]' => FILTER_SANITIZE_STRING);
                
                $result = filter_input_array(INPUT_POST, $options);
                $checkResult =[];
                
                $addtaskarray = trim($result['addtask[]']);
                
                if(isset($addtaskarray) AND !empty($addtaskarray) ){
                $verif_addtaskarray = "ok";
                }
                else {
                $verif_addtaskarray = "pok";
                }
            }
    
            if(isset($_POST['unsave'])){
    
                $options = array(
                'removetask[]' => FILTER_SANITIZE_STRING);
            
                $result = filter_input_array(INPUT_POST, $options);
                $checkResult =[];
            
                $removetask = trim($result['removetask[]']);
            
                if(isset($removetask) AND !empty($removetask) ){
                $verif_removetask = "ok";
                }
                else {
                $verif_removetask = "pok";
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
            </head>
            <body>
                <section class="page">
                    <div class="formulaire">
                        <section class="task">
                            <div class="title_task">
                                <h2>A Faire</h2>
                            </div>
                            <form action="index.php" method="post" name="formafaire">
                                <div class="todotask">
                                    <?php
                                        foreach ($receipt as $key => $value){
                                            if ($value["Terminer"] == false){
                                                echo "<input type='checkbox' name='addtask[]' value='".$value["Nom"]."'/>
                                                    <label for='choix'>".$value["Nom"]."</label><br />";
                                            }
                                        }
                                    ?>
                                </div>
                                <div class="buttonretrait">
                                    <input id="buttonId" type="submit" name="save" value="Enregistrer">
                                </div>
                            </form>
                        </section>
                        <section class="archives">
                            <div class="title_archives">
                                <h2>Archives</h2>
                            </div>
                            <form action="index.php" method="post" name="formchecked">
                                <div class="listarchives">
                                    <?php
                                        foreach ($receipt as $key => $value){
                                            if ($value["Terminer"] == true){
    
                                                echo "<input type='checkbox' name='removetask[]' value='".$value["Nom"]."'checked/>
                                                    <label for='choix'>".$value["Nom"]."</label><br />";
                                            }
                                        }
                                    ?>
                                </div>
                                <div class="buttonretrait">
                                    <input id="buttonId2" type="submit" name="unsave" value="Retirer">
                                </div>
                            </form>
                        </section>
                    </div>
                    <div class="formulaire">
                        <form method="post" name="ajout" action="index.php">
                        <section class="addtask">
                            <div class="title_add">
                                <h1>Ajouter une tâche</h1>
                                <h2>La tâche à effectuer</h2>
                            </div>
                            <div class="add">
                                <form class="" action="index.php" method="post">
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
                <h2>Created by Félix Namèche and Kevin Dubreucq</h2>
                <h3>In Becode Formation 2018 Promo Charleroi<h3>
                <audio autoplay loop="">
                    <source src="https://archive.org/download/nyannyannyan/NyanCatoriginal.ogg" type="audio/ogg">
                </audio>
            </footer>
        </html>
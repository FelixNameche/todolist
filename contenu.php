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
                    <input type="checkbox" name="todo" value="Faire les courses">
                    <input type="checkbox" name="todo" value="Terminer le projet 'QCM'">
                    <input type="checkbox" name="todo" value="Rappeler Grand-mère">
                    <input type="checkbox" name="todo" value="Terminer le générateur aléatoire de PNJ's">
                    <button name="submit" type="submit" form="formulaire">Enregistrer</button>
                </div>
            </section>
            <section class="archives">
                <div class="title_archives">
                
                </div>
                <div class="listarchives">
                
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
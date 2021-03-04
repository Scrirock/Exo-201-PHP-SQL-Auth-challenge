<?php
    require "./imports.php";
    if (checkUser()){
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/basics.css">
    <title>Randonnées, ajout</title>
</head>
<body>

    <h1>Ajouter une randonnée</h1>

    <a href="bienvenue.php" class="button">Retour sur la page " bienvenue "</a>
    <a href="read.php" class="button">Page de controle</a>

    <form action="logout.php" method="post">
        <button type="submit" name="button">Se deconnecter</button>
    </form>

    <form action="create.php" method="POST">
        <input type="text" name="name" placeholder="Nom de la randonnée">
        <select name="difficulty" id="difficulty">
            <option value="très facile">Très facile</option>
            <option value="facile">Facile</option>
            <option value="moyen">Moyen</option>
            <option value="difficile">Difficile</option>
            <option value="très difficile">Très difficile</option>
        </select>
        <input type="number" name="distance" placeholder="Disance(m). Ex:458">

        <input type="text" name="duration" placeholder="Durée. Ex: 5h30">
        <input type="number" name="height_difference" placeholder="Denivelé(m). Ex:254">
        <input type="text" name="available" placeholder="Praticable ? Ex. Oui">

        <input type="submit" value="Ajouter">
    </form>

    <?php
        if (isset($_POST["name"], $_POST["difficulty"], $_POST["distance"], $_POST["duration"], $_POST["height_difference"], $_POST["available"])){
            $name = sanitize($_POST["name"]);
            $difficulty = sanitize($_POST["difficulty"]);
            $distance = sanitize($_POST["distance"]);
            $duration = sanitize($_POST["duration"]);
            $height_difference = sanitize($_POST["height_difference"]);
            $available = sanitize($_POST["available"]);

            $insert = $conn->prepare("INSERT INTO reunion_island.hiking (name, difficulty, distance, duration, height_difference, available) 
                                            VALUES (:name, :difficulty, :distance, :duration, :height_difference, :available)");
            $insert->bindParam(":name", $name);
            $insert->bindParam(":difficulty", $difficulty);
            $insert->bindParam(":distance", $distance);
            $insert->bindParam(":duration", $duration);
            $insert->bindParam(":height_difference", $height_difference);
            $insert->bindParam(":available", $available);

            if ($insert->execute()){
                echo "La randonnée a été ajoutée avec succès.";
            }
        }
    ?>



</body>
</html>

<?php
    }
    else{
        echo "vous n'avez pas la permission d'aller sur cette page";
    }
?>
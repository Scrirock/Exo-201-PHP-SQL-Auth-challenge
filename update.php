<?php
    require "./imports.php";
    if (checkUser()){

        $sql = $conn->prepare("SELECT MAX(id) as maxId FROM reunion_island.hiking");
            $sql->execute();
            $lastID = $sql->fetch();
            if (isset($_GET['id'])){
                $id = sanitize($_GET['id']);
                $id = intval($id);
                if ($id <= 0 || $id > $lastID["maxId"]){
                    $id = 1;
                }
            }
            else{
                $id = 1;
            }
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/basics.css">
    <title>Modifier une donnée</title>
</head>
<body>
    <h1>Modifier une randonnée</h1>
    <form action="update.php?id=<?php echo $id ?>" method="POST">
        <input type="text" name="name" placeholder="Nom de la randonnée" value="<?php echo $_SESSION['name'][$id]; ?>">
        <select name="difficulty" id="difficulty">
            <option value="très facile">Très facile</option>
            <option value="facile">Facile</option>
            <option value="moyen">Moyen</option>
            <option value="difficile">Difficile</option>
            <option value="très difficile">Très difficile</option>
        </select>
        <input type="number" name="distance" placeholder="Disance(m). Ex:458" value="<?php echo $_SESSION['distance'][$id]; ?>">

        <input type="text" name="duration" placeholder="Durée. Ex: 5h30" value="<?php echo $_SESSION['duration'][$id]; ?>">
        <input type="number" name="height_difference" placeholder="Denivelé(m). Ex:254" value="<?php echo $_SESSION['height'][$id]; ?>">
        <input type="text" name="available" placeholder="Praticable ? Ex. Oui " value="<?php echo $_SESSION['available'][$id]; ?>">

        <input type="submit" value="Modifier">
    </form>

    <a href="create.php" class="button">Revenir a la page d'ajout</a>

    <?php
        if (isset($_POST["name"], $_POST["difficulty"], $_POST["distance"], $_POST["duration"], $_POST["height_difference"], $_POST["available"])){
            $name = sanitize($_POST["name"]);
            $difficulty = sanitize($_POST["difficulty"]);
            $distance = sanitize($_POST["distance"]);
            $duration = sanitize($_POST["duration"]);
            $height_difference = sanitize($_POST["height_difference"]);
            $available = sanitize($_POST["available"]);

            $update = $conn->prepare("UPDATE reunion_island.hiking 
                                            SET name = :name,
                                                difficulty = :difficulty,
                                                distance = :distance,
                                                duration = :duration,
                                                height_difference = :height_difference,
                                                available = :available
                                            WHERE id = :id");
            $update->bindParam(":name", $name);
            $update->bindParam(":difficulty", $difficulty);
            $update->bindParam(":distance", $distance);
            $update->bindParam(":duration", $duration);
            $update->bindParam(":height_difference", $height_difference);
            $update->bindParam(":id", $id);
            $update->bindParam(":available", $available);

            if ($update->execute()){
                echo "La randonnée a été modifiée avec succès.";
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
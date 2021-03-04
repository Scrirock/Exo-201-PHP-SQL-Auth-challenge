<?php
    require "./imports.php";
    if (checkUser()){
        ?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/basics.css">
    <title>Lecture base de donnée</title>
</head>
<body>
    <h1>Page de controle</h1>
    <table border="1">
        <thead>
        <tr>
            <th>Name</th>
            <th>Difficulty</th>
            <th>Distance</th>
            <th>Duration</th>
            <th>Height difference</th>
            <th>Available</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
            <?php
                $read = $conn->prepare("SELECT * FROM reunion_island.hiking");
                $read->execute();
                $nameArray = [NULL];
                $difficultyArray = [NULL];
                $distanceArray = [NULL];
                $durationArray = [NULL];
                $heightArray = [NULL];
                $available = [NULL];

                foreach ($read->fetchAll() as $item){
                    echo "<tr>";
                        echo "<td>".$item['name']."</td>";
                        echo "<td>".$item['difficulty']."</td>";
                        echo "<td>".$item['distance']."</td>";
                        echo "<td>".$item['duration']."</td>";
                        echo "<td>".$item['height_difference']."</td>";
                        echo "<td>".$item['available']."</td>";
                        echo "<td><a href='update.php?id=".$item['id']."' target='_blank'>Modifier</a></td>";
                        echo "<td><a href='delete.php?id=".$item['id']."'>Supprimer</a></td>";
                    echo "</tr>";
                    $nameArray[$item['id']] = $item['name'];
                    $difficultyArray[$item['id']] = $item['difficulty'];
                    $distanceArray[$item['id']] = $item['distance'];
                    $durationArray[$item['id']] = $item['duration'];
                    $heightArray[$item['id']] = $item['height_difference'];
                    $available[$item['id']] = $item['available'];
                }
                $_SESSION["name"] = $nameArray;
                $_SESSION["difficulty"] = $difficultyArray;
                $_SESSION["distance"] = $distanceArray;
                $_SESSION["duration"] = $durationArray;
                $_SESSION["height"] = $heightArray;
                $_SESSION["available"] = $available;
            ?>
        </tbody>
    </table>

    <a href="create.php" class="button">Revenir a la page d'ajout</a>

</body>
</html>

<?php
    }
    else{
        echo "vous n'avez pas la permission d'aller sur cette page";
    }
?>
<?php require "imports.php"; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8"/>
    <title>Login</title>
</head>
<body>

    <form action="login.php" method="post">
        <div>
            <label for="username">Identifiant</label>
            <input type="text" name="username">
        </div>
        <div>
            <label for="password">Mot de passe </label>
            <input type="password" name="password">
        </div>
        <div>
            <input type="submit" value="Se connecter">
        </div>
    </form>

    <?php

        if (isset($_POST["username"], $_POST["password"])){
            $username = $_POST["username"];
            $password = $_POST["password"];

            $sql = $conn->prepare('SELECT username, password FROM reunion_island.user WHERE username = :username ');
            $sql->bindParam(":username", $username);

            if($sql->execute()) {
                $userData = $sql->fetch();
                if(password_verify($password, $userData["password"])) {
                    session_start();
                    $_SESSION["user"] = "verified";
                    header("Location: create.php");
                }
                else {
                    echo "Le mot de passe utilisé ne semble pas être correct, ou aucun compte associé à ce nom d'utilisateur";
                }
            }
            else {
                echo "Aucun compte associé à ce nom d'utilisateur";
            }
        }

    ?>

</body>
</html>

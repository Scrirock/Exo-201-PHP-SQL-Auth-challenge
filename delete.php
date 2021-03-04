<?php
    require "./imports.php";

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

$delete = $conn->prepare("DELETE FROM reunion_island.hiking WHERE id=:id");
$delete->bindParam(":id", $id);
$delete->execute();

header("Location: read.php");
<?php
    function sanitize($data): string{
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        $data = addslashes($data);

        return $data;
    }

    require "check_login.php";

    require "./Classes/DB.php";
    $conn = DB::getInstance();
?>
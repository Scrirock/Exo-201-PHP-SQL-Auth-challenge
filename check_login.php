<?php
//Check if credentials are valid
session_start();
    function checkUser(): bool{
        if (isset($_SESSION["user"]) && $_SESSION["user"] === "verified"){
            return true;
        }
        else{
            return false;
        }
    }
<?php

    try{
        //host
        define("HOST", "Localhost");

        //dbname
        define("DBNAME", "ferreteria");

        //user
        define("USER", "root");

        //pass
        define("PASS", "");

        $conn = new PDO("mysql:host=".HOST.";dbname=".DBNAME."",USER, PASS);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $Exception){
        echo $Exception->getMessage();
    }


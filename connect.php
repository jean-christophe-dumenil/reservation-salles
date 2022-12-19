<?php
    // Connexion à la base de données
    $db_username = 'root';
    $db_password = '';
    $db_name = 'reservationsalles';
    $db_host = 'localhost';
    $bdd = mysqli_connect($db_host, $db_username, $db_password,$db_name)
    or die('could not connect to database');
    if(!$bdd) {
        echo "Connexion non établie.";
        exit;
    }
    /*$db_username = 'jeanchristophe';
    $db_password = 'Yuki121244!';
    $db_name = 'jean-christophe-dumenil_moduleconnexion';
    $db_host = 'localhost';
    $db = mysqli_connect($db_host, $db_username, $db_password,$db_name)
    or die('could not connect to database');
    if(!$db) {
        echo "Connexion non établie.";
        exit;
    }*/
?>
<?php
    session_start();
    if(isset($_POST['username']) && isset($_POST['password'])){
    // connexion à la base de données
    /*$db_username = 'jeanchristophe';
    $db_password = 'Yuki121244!';
    $db_name = 'jean-christophe-dumenil_moduleconnexion';
    $db_host = 'localhost';
    $bdd = mysqli_connect($db_host, $db_username, $db_password,$db_name)
    or die('could not connect to database');
    if(!$db) {
        echo "Connexion non établie.";
        exit;
    }*/
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
 
         // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
        // pour éliminer toute attaque de type injection SQL et XSS
        $username = mysqli_real_escape_string($bdd,htmlspecialchars($_POST['username'])); 
        $password = mysqli_real_escape_string($bdd,htmlspecialchars($_POST['password']));
 
        if($username !== "" && $password !== ""){
            $requete = "SELECT count(*) FROM utilisateurs where `login` = '".$username."'";
            $exec_requete = mysqli_query($bdd,$requete);
            $reponse = mysqli_fetch_array($exec_requete);
            $count = $reponse['count(*)'];
            if($count!=0) // nom d'utilisateur correct 
            {
                $requete = "SELECT * from utilisateurs where `login` = '".$username."'";
                $exec_requete = mysqli_query($bdd,$requete);
                $reponse = mysqli_fetch_assoc($exec_requete);
                if (password_verify($password,$reponse['password'])){  // mot de passe correct
                    $_SESSION['login'] = $username;
                    $_SESSION['connect'] = true;
                    $_SESSION['id'] = $reponse['id'];
                    $_SESSION['prenom'] = $reponse['prenom'];
                    $_SESSION['nom'] = $reponse['nom'];
                    header('Location: profil.php');

                }
                else {
                    header('location: connexion.php?erreur=1'); // mot de passe incorrect
                }
            }
    
            else{
                header('Location: connexion.php?erreur=2');
            }
        }
        mysqli_close($bdd); // fermer la connexion
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="index.css">
    <title>Inscription</title>
</head>

<body>   
        <!-- header -->
        <?php
            require ('header1.php');
            require ('connect.php');
        ?>
        <!-- contenu -->
        <main>
                <?php
                    if(isset($_GET['erreur'])){
                        $err = $_GET['erreur'];
                        if($err==1){
                            echo "<p style='color:red'>Utilisateur déjà créé, ou login déjà pris</p>";
                        }
                        if($err==2){
                            echo "<p style='color:red'>Mots de passe différents</p>";
                        }
                        if($err==3){
                            echo "<p style='color:red'>Veuillez remplir tous les champs</p>";
                        }
                    }
                ?>
            <?php
                if(isset($_POST['login']) && isset($_POST['password'])){
                    $login = mysqli_real_escape_string($bdd,htmlspecialchars($_POST['login']));
                    $password = mysqli_real_escape_string($bdd,htmlspecialchars($_POST['password']));
                    $password2 = mysqli_real_escape_string($bdd,htmlspecialchars($_POST['password2']));;

                    if($login !== "" && $password !== "" && $password2 !== ""){
                        if($password == $password2){
                            $requete = "SELECT count(*) FROM utilisateurs where login = '".$login."'";
                            $exec_requete = $bdd -> query($requete);
                            $reponse      = mysqli_fetch_array($exec_requete);
                            $count = $reponse['count(*)'];

                            if($count==0){
                                $password = password_hash($password, PASSWORD_DEFAULT);
                                $requete = "INSERT INTO utilisateurs (login, password) VALUES ('".$login."', '".$password."')";
                                $exec_requete = $bdd -> query($requete);
                                header('Location: connexion.php');
                            }
                            else{
                                header('Location: inscription.php?erreur=1'); // utilisateur déjà existant
                            }
                        }
                        else{
                            header('Location: inscription.php?erreur=2'); // mot de passe différent
                        }
                    }
                    else{
                        header('Location: inscription.php?erreur=3'); // utilisateur ou mot de passe vide
                    }
                }

                mysqli_close($bdd); // fermer la connexion
            ?>
                <div id="container">
                    
                    <form action="inscription.php" method="post">
                        
                    <label for="login">login</label>
                        <input type="text" name="login" id="login" placeholder="Veuillez entrer votre nom d'utilisateur" required>

                        <label for="password">Mot de passe</label>
                        <input type="password" name="password" id="password" placeholder="Veuillez enter votre mot de passe" required>

                        <label for="password2">Confirmation du mot de passe</label>
                        <input type="password" name="password2" id="password2" placeholder="Vueillez confirmer votre mot de passe" required>

                        <input type="submit" value="Insciption">
                    </form>
                </div>
        </main> <!-- /main -->
        <!-- footer -->
        <?php
            include 'footer.php';
        ?>       
</body>
</html>
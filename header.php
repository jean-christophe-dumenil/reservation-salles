<?php
    session_start();
?>
<header>   
            <!-- tester si l'utilisateur est connecté -->
            <?php

                if (isset($_GET['deconnexion'])){
                    if($_GET['deconnexion']==true){
                        session_unset();
                        header('Location: index.php');
                    }
                }

                else if (isset($_SESSION['login'])) {
                    $user = $_SESSION['login'];
                
                    // afficher les liens menus correspondants à la session
                    ?>
                    <nav id="wrap">
                        <ul class="navbar">
                            <li><a href="index.php"></i>Accueil</a></li>
                            <li><a href="profil.php"></i>Profil</a></li>  
                            <li><a href="livre-or.php">livre d'or</a></li>     
                            <li><a href="commentaire.php">Commentaire</a></li>                           
                        <?php
                            if($user == 'admin'){ // si l'utilisateur est admin il peut accéder à la page admin
                        ?>
                            <li><a href="admin.php"></i>Admin</a></li>
                        <?php } ?>           
                        
                            <li><a href="index.php?deconnexion=true">Déconnexion</a></li>
                        </ul>
                    </nav>
                    <?php
                        } else { 
                    ?>
                    <nav id="wrap">
                        <ul class="navbar">
                            <li><a href="index.php"></i>Accueil</a></li>  
                            <li><a href="livre-or.php">livre d'or</a></li>                                           
                        </ul>
                    </nav>
                    <?php   
                        }   
                    ?>
</header>

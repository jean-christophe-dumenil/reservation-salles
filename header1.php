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
                    
        <nav class="nav">
            <div id="mainListDiv" class="main_list">
                <ul class="navlinks">
                    <li><a href="index.php"></i>Accueil</a></li>
                        <li><a href="profil.php"></i>Profil</a></li>                       
                        <li><a href="planning.php">Planning</a></li>                          
                        <li><a href="reservation-form.php">Réservation</a></li>  
                        <li><a href="commentaire.php">Commentaire</a></li>      
                        <li><a href="livre-or.php">Livre d'or</a></li> 
                                          
                        <?php
                            if($user == 'admin'){ // si l'utilisateur est admin il peut accéder à la page admin
                        ?>
                            <li><a href="admin.php"></i>Admin</a></li>
                        <?php } ?>                                   
                            <li><a href="index.php?deconnexion=true">Déconnexion</a></li>
                </ul>
            </div>
        </nav>
                    <?php
                        } else { 
                    ?>
    <nav class="nav">
        <div id="mainListDiv" class="main_list">
            <ul class="navlinks">
                <li><a href="index.php"></i>Accueil</a></li>  
                <li><a href="livre-or.php">Livre d'or</a></li> 
                <li><a href="planning.php">Planning</a></li>                                                
                <button class="button button1" onclick="window.location.href='inscription.php'">Inscription</button>      
                <button class="button button2" onclick="window.location.href='connexion.php'">Connexion</button>                                                       
            </ul>
                    <?php   
                        }   
                    ?>
            </div>
            <span class="navTrigger">
                <i></i>
                <i></i>
                <i></i>
            </span>

    </nav>

    <section class="home">
    </section>
    <div style="height: 0">
        <!-- just to make scrolling effect possible -->
			
    </div>

<!-- Jquery needed -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="js/scripts.js"></script>

<!-- Function used to shrink nav bar removing paddings and adding black background -->
    <script>
        $(window).scroll(function() {
            if ($(document).scrollTop() > 50) {
                $('.nav').addClass('affix');
                console.log("OK");
            } else {
                $('.nav').removeClass('affix');
            }
        });
    </script>           
</header>
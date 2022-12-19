<?php
    session_start();           
    if (!$_SESSION ['login']) { // si la session n'est pas ouverte (protection de barre d'adresse)
        header('Location: connexion.php'); // redirection vers la page de connexion
    }
    session_abort();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="index.css">
    <title>Event</title>
</head>
<body>
    <!-- header -->
    <?php
        require ('header1.php');
        require ('connect.php');
         if (isset($_GET['id'])) {
            $id = (int)$_GET['id'];
            // récupération des résa
            $requete = "SELECT reservations.titre, reservations.description, DATE_FORMAT(reservations.debut, '%d-%m-%Y %H') as debut, DATE_FORMAT(reservations.fin, '%d-%m-%Y %H') as fin, utilisateurs.login FROM reservations INNER JOIN utilisateurs on reservations.id_utilisateurs = utilisateurs.id WHERE reservations.id = $id";
            $exect_requete = mysqli_query($bdd, $requete);
            $resultat = mysqli_fetch_assoc($exect_requete);
            // Récupération de la date et des heures de la résa
            list($date, $heure_d) = explode(" ", $resultat['debut']);
            list($date, $heure_f) = explode(" ", $resultat['fin']);
        }
     
    ?>

    <!-- contenu -->
    <main>
        <div id="container">     
      
            <h2> <?= $resultat['titre'] ?> </h2>
                <p>Créée par <?= $resultat['login'] ?></p>
                <p>La salle est réservée le <?=$date?></p>
                <p>A partir de <?= $heure_d."h" ?> jusqu'à <?= $heure_f."h" ?></p>
                <p>Description de la réservation :</p>
                <p><?= $resultat['description'] ?></p>
        </div>
    </main>
        <!-- footer -->
        <?php
            include 'footer.php';
        ?>       
</body>
</html>
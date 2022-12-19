<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="index.css">
    <title>Réservation</title>
</head>
<body>
    <!-- header -->
    <?php
        require ('header1.php');
        require ('connect.php');

        if (isset($_POST['submit'])) {
            // on récupère l'id de l'utilisateur qui effectue la résa 
            $id = $_SESSION["id"];
            // on récupère les valeurs des post 
            $title = addslashes(htmlspecialchars($_POST["titre"]));
            $desc = addslashes(htmlspecialchars($_POST["description"]));
            $date = $_POST["date"];
            // concaténation date et heure de début et de fin pour être au format compatible à l'ajout à la db
            $start = $date . " " . $_POST["debut"] . ":00";
            $end = $date . " " . $_POST["fin"] . ":00";
            // echo $start;
            // echo $end;
        
            // requete pour récupérer le contenu de la DB où l'heure de début correspond éventuellement à une heure déjà rentrée ou alors où l'heure de fin correspond à une fin dejà rentrée
            $catchBookings = $bdd->query("SELECT debut, fin FROM reservations WHERE debut BETWEEN '$start' AND '$end' OR fin BETWEEN '$start' AND '$end'");
        
            // fetch le contenu de la requête
            $bookings = $catchBookings->fetch_all();
            // var_dump($bookings);
        
            if (empty($bookings)) {
                // requete pour inserer les valeurs issues des post + id de l'utilisateur qui effectue la résa dans la db
                $newBooking = $bdd->query("INSERT INTO reservations (`titre`, `description`, `debut`, `fin`, `id_utilisateurs`) VALUES ('$title', '$desc', '$start', '$end', '$id')");
                echo "Félicitations, votre réservation a bien été effectuée";
            } else {
                echo "Ce créneau n'est pas disponible";
            }
        }
       
    ?>

    <main>
    
        <div id="container">     

            <form  method="post" action="">
                <h2 id="form-title"> RÉSERVER UN ESPACE</h2>

                <label>TITRE : </label>
                <input id="input-line" type="text" name="titre" id="titre" placeholder="titre" required/></br></br>
                <div class="réservation_form">
                        
                        <label><b>Date : </b></label>
                        <input id="dateinput" type="date" min=<?= date("Y-m-d", strtotime("now"))?> name="date" required></br></br>
                
                        <label><b>Début : </b></label>
                        <input class="resahour" type="time" name="debut" min="08" max="18" step="3600" required /></br></br>

                        <label class="black-text"><b>Fin : </b></label>
                        <input  class="resahour" type="time" name="fin" min="09" max="19" step="3600" required/></br></br>
      
                        <label class="black-text">Description :</label></br></br>
                        <textarea type="text" name="description" class="description" id="description" rows="5" cols="33" required></textarea></br></br>
                
                </div>
                <input name="submit" type="submit" value="Envoyer" require>
  
            </form>
           
        </div>
    </main>
        
        <!-- footer -->
        <?php
            include 'footer.php';
        ?>       
</body>
</html>
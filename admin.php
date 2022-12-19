<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="index.css">
    <title>Admin</title>
</head>

<body>
        <!-- header -->
        <?php 
            require ('header1.php'); 
            require ('connect.php'); 
        ?>
        <?php $request = $bdd->query("SELECT * from `utilisateurs`;");?> <!-- requête pour récupérer les données de la table utilisateurs -->

<main>
    <div class="container">
        <form method="post" action="">
            <h2 id="form-title">Voici les utilisateurs</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>LOGIN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                            while(($resultat = $request->fetch_assoc()) != null){
                                echo "<tr>";
                                echo "<td>".$resultat['id']."</td>";
                                echo "<td>".$resultat["login"]."</td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
        </form>
    </div>
</main> 

    <!-- footer -->
    <?php
        include 'footer.php';
    ?>
</body>
</html>
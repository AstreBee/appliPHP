<?php
    // permet de créer une session à un utilisateur ou de récupérer les données de l'ancienne session => cookie   PHPSESSID
    // parcourir le tableau en session pour pouvoir récupérer la session correspondante à l'utilisateur
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <title>Ajout produit</title>
</head>
<body>

    <div class="panier">
        <h1 class="h1">Ajouter un produit : </h1>
        <a class="buttonReturn" href="http://appli/recap.php">Panier</a>
    </div>
    <!-- action indiquer la cible / method précise par quelle méthode les données du formulaire sont transmises au serveur -->
    <!-- POST pour que cela n'influence pas l'url -->
    <form action="traitement.php?action=add" method="post">
        <p class="test">
            <label>
                Nom du produit : 
                <input type="text" name="name">
            </label>
        </p>


        <p>
            <label>
                Prix du produit : 
                <input type="number" step="any" name="price">
            </label>
        </p>


        <p>
            <label>
                Quantité désirée : 
                <input type="number" name="qtt" value="1">
            </label>
        </p>

        
        <p class="bas">
            <input class="button" type="submit" name="submit" value="Ajouter le produit">
        </p>
        </form>
        
<?php 

        // Si il y a , dans la session, pas de produits, que c'est vide :
        if(!isset($_SESSION['products']) || empty($_SESSION['products'])){
            echo  '<p>Aucun produit en session...</p>';
        } else {
            echo    '<p> Votre panier contient '.count($_SESSION['products']).' produits </p>';
        }
?>
</body>
</html>


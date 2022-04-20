<?php
    // permet de créer une session à un utilisateur ou de récupérer les données de l'ancienne session => cookie   PHPSESSID
    // parcourir le tableau en session pour pouvoir récupérer la session correspondante à l'utilisateur
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="CSS/style.css">
        <title>Récapitulatif des produits</title>
    </head>
    <body>
        <a class="buttonReturn" href="http://appli/index.php">Ajout de produits</a>
        <?php

            if(!isset($_SESSION['products']) || empty($_SESSION['products'])){
                echo "<p>Aucun produit en session...</p>";
           
            }
            else {

                // tableau des produits
                echo "<table>",
                        "<thead>",
                            "<tr>",
                                "<th>#</th>",
                                "<th>Nom</th>",
                                "<th>Prix</th>",
                                "<th>Quantité</th>",
                                "<th>Total</th>",
                            "</tr>",
                        "</thead>",
                        "<tbody>";
                $totalProduit = 0;
                $totalGeneral = 0;
                foreach($_SESSION['products'] as $index => $product) {
                    echo "<tr>",
                                "<td>".$index."</td>",
                                "<td>".$product['name']."</td>",
                                "<td>".number_format($product['price'], 2, ",", "&nbsp;")."&nbsp;€</td>",
                                "<td>".$product['qtt']."
                                <a class='buttonRecap' href='traitement.php?action=ajouter&id=$index'><button>+</button></a>
                                <a class='buttonRecap' href='traitement.php?action=supprimer&id=$index'><button>-</button></a></td>",
                                "<td>".number_format($product['total'], 2, ",", "&nbsp;")."&nbsp;€</td>",  
                          "</tr>";
                        $totalGeneral+= $product['total'];
                        $totalProduit+=$product['total'];  
                    }
                    
                    echo "<tr>",
                            "<td colspan=3>Total général : </td>",
                            "<td><strong>".number_format($totalProduit)."&nbsp</strong></td>",
                            "<td><strong>".number_format($totalGeneral, 2, ",", "&nbsp;")."&nbsp;€</strong></td>",
                        "</tr>",
                    "</tbody>",
                "</table>";  
            echo "<a href='traitement.php?action=delete'>Supprimer</a>"; 
            }       
        ?>
    </body>
</html>

<?php

session_start();


if(isset($_GET['action'])){
    switch($_GET['action']) {
       case "add" :

    
        // Vérifier l'existence d'une requête POST
        // limiter l'accès à traitement.php par les seules requêtes HTTP provenant de la soumission de notre formulaire.
        if (isset($_POST['submit'])) {
        // vérifier  l'intégrité  des  valeurs  transmises  dans  le  tableau 

        // htmlentities permet d'éviter les failles XSS - filtre tous les caractères équivalents au codage HTML ou JavaScript.
        $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        // filter validate float = valide le prix uniquement lorsque c'est un nombre à virgule
        $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        // filter validate int = valide le prix uniquement lorsque c'est un nombre entier
        $qtt = filter_input(INPUT_POST, "qtt", FILTER_VALIDATE_INT);

        // après être filtrées et nettoyeés et / ou validé du formulaire, on vérifie si les filtres ont tous fonctionnés avec une nouvelle condition
        // if($name && $price && $qtt){
            $product = "bonjour";
            $product = [
                // tableau associatif
                "name" => $name,
                "price" => $price,
                "qtt" => $qtt,
                "total" => $price*$qtt
            ];
            // Contient les données stockées dans la session utilisateur côté serveur (si cette session a été démarrée au préalable).
            // enregistrer le produit nouvellement crée en session
            // On sollicite le tableau de session $_SESSIONfourni par PHP.
            // On indique la clé "products" de ce tableau. Si cette clé n'existait pas auparavant (ex: l'utilisateur ajoute son tout premier produit), PHP la créera au sein de $_SESSION.

            $_SESSION['products'][] = $product;
        
        
        }
        // }
        
        // effectue une redirection - pour revenir au formulaire après traitement
        // cette fonction envoie un nouvel entête HTTP Le client recevra alors la ressource précisée dans cette fonction.
    
        break;

        // permet de supprimer tout le panier - on vérifie si il y a des produits liés à la session ,
        //  on les supprime avec un lien lié dans recap
        case "delete":
            $_SESSION['products'];
            unset ($_SESSION['products']);

        // lorsque les produits sont supprimés, on fait mourir la session, renvoie à l'index
            header("Location:index.php");
            die();
            break;
        
        // permet d'ajouter les produits 1 par 1 : si il y a, dans l'id, et si il y a dans la session, des produits avec id,
        // on récupère la session, ainsi que l'id et on ajoute de la quantité (lien lié dans recap)
        case "ajouter":
            if(isset($_GET['id']) && isset($_SESSION['products'][$_GET['id']])) {
                $_SESSION['products'][$_GET['id']]['qtt']++;
                $_SESSION['products'][$_GET['id']]['total']+= $_SESSION['products'][$_GET['id']]['price'];
            }
        break;

        

        // permet de supprimer un produit 1 par 1 : si il y a, dans l'id, et si il y a dans la session, des produits avec id,
        // on récupère la session, ainsi que l'id et on supprime de la quantité (lien lié dans recap)
        case "supprimer" :
            if(isset($_GET['id']) && isset($_SESSION['products'][$_GET['id']])) {
                $_SESSION['products'][$_GET['id']]['qtt']--;
                $_SESSION['products'][$_GET['id']]['total']-= $_SESSION['products'][$_GET['id']]['price'];
        }
        break;

        // ajouter le prix en fonction du nombre de produits
       
    }

}
header("Location:recap.php");
    
// Dfinition failles XSS : Cross-site scripting (XSS) est une faille de sécurité qui permet à un attaquant d'injecter dans un site web un code
//  client malveillant. Ce code est exécuté par les victimes et permet aux attaquants de contourner les contrôles d'accès et d'usurper l'identité des utilisateurs. 
// Ces attaques réussissent si l'application Web n'emploie pas assez de validation ou d'encodage. Le navigateur de l'utilisateur ne peut pas détecter que le script
// malveillant n'est pas fiable et lui donne donc accès à tous les cookies, jetons de session ou autres informations sensibles propres au site, ou permet au script
//  malveillant de réécrire le contenu HTML.




// case "supprimer"
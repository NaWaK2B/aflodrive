<?php
require_once "database.php";
require_once "Controller.php";
$db = new Database();
$GLOBALS['database'] = $db->etatConnexion();

switch ($_POST['request']) {
    case 'ajout':

            $sql = "INSERT INTO `articles` (`qt`,`prix`, `nom_article`, `category`, `descriptif`, `photo`) VALUES ('".$_POST['quantite']."','" . $_POST['prix']."','" . $_POST['nom']."','" . $_POST['category']."','" . $_POST['descriptif']."','" . $_POST['photo']."')";
            mysqli_query($GLOBALS['database'], $sql) or die;
            echo json_encode("ajout ok");
            
    break;
           
        
    case 'supprimer':

        $sql = "DELETE FROM `articles` WHERE `id_article` = ". $_POST['id']."";
        mysqli_query($GLOBALS['database'], $sql) or die;
        echo json_encode("supprimer ok");
        break;

    case 'ajout_code':

        $sql = "INSERT INTO `code_promo` (`nom_promo`,`pourcentage`) VALUES ('".$_POST['nom_promo']."','" . $_POST['pourcentage']."')";
        mysqli_query($GLOBALS['database'], $sql) or die;
        echo json_encode("code créer");
        
    break;


    }
?>
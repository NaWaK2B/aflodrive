<?php
require_once "database.php";
$db = new Database();
$GLOBALS['database'] = $db->etatConnexion();
session_start();

$sql = "INSERT INTO `clients` (`nom_client`,`prenom_client`, `email_client`, `tel`) VALUES ('".$_POST['nom_client']."','" . $_POST['prenom_client']."','" . $_POST['email_client']."','" . $_POST['tel']."')";
mysqli_query($GLOBALS['database'], $sql) or die;
$id_client =  mysqli_insert_id($GLOBALS['database']);
$contenu_commande = json_encode($_SESSION['panier']);
$sql = "INSERT INTO `commande` (`contenue_commande`,`id_client`,`prix_total`) VALUES ('".mysqli_real_escape_string($GLOBALS['database'],$contenu_commande)."','".$id_client."','" . $_POST['total']."')";
mysqli_query($GLOBALS['database'], $sql) or die;
$id_commande =  mysqli_insert_id($GLOBALS['database']);


session_destroy();

echo json_encode("Commande validé");



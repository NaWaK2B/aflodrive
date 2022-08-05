<?php
require_once "database.php";
$db = new Database();
$GLOBALS['database'] = $db->etatConnexion();
session_start();

$check = 0;
$msg = "produit ajouter";
$requete = "SELECT * FROM articles where id_article = '".$_POST['id']."'";
error_log($requete);
$result = mysqli_query($GLOBALS['database'], $requete) or die;
if ($data = mysqli_fetch_assoc($result)) {

    if($data['qt'] < $_POST['quantite']){
        $check = 1;
        $msg = "quantite non disponible";
    }
}

if($check == 0){
    $prix= explode("€", $_POST['prix']);
    // $_SESSION['panier'] = array($_POST['id'] => array('quantite' =>$_POST['quantite']));
    $_SESSION['panier']["'".$_POST['id']."'"]['quantite'] = $_POST['quantite'];
    $_SESSION['panier']["'".$_POST['id']."'"]['nom'] = $_POST['nom'];
    $_SESSION['panier']["'".$_POST['id']."'"]['prix'] = $prix[0];
}






$quantite_total = 0;

foreach($_SESSION['panier'] as $id => $produit){
    
    $quantite_total = $quantite_total+ $produit['quantite'];
}

echo json_encode(array("msg" =>$msg, "check" =>$check,"quantitetotal" => $quantite_total));


<?php
require_once "database.php";
$db = new Database();
$GLOBALS['database'] = $db->etatConnexion();

$codepromo = $_POST["codepromo"];
$prix_promo = $_POST["prixtotal"];
$requete = "SELECT pourcentage FROM code_promo where nom_promo = '".$codepromo."'";
$result = mysqli_query($GLOBALS['database'], $requete) or die;
          if ($data = mysqli_fetch_assoc($result)) {

            $promo  = $data['pourcentage']."%";
            $prix_promo = $_POST["prixtotal"]- ($_POST["prixtotal"]*$data['pourcentage']/100);
            
        }else{
            $promo  = "votre code n'est pas valide";
        }
    echo json_encode(array("promo"=>$promo, "prix_promo"=>$prix_promo));

?>
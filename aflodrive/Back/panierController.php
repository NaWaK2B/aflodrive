<?php
require_once "database.php";
$db = new Database();
$GLOBALS['database'] = $db->etatConnexion();
session_start();

$html = "";
$total = 0;

foreach($_SESSION['panier'] as $id => $produit){
    $html .="
    
    <div class='block_panier'>
    <div class='block_affichage'>
      <div class='block_produit'>
        <h3>Produit</h3>
        <div class='aff_prod'>".$produit['nom']."</div>
      </div>

      <div class='block_quantite'>
        <h3>Quantité</h3>
        <div class='aff_prod'>".$produit['quantite']."</div>
      </div>

      <div class='block_prix_unit'>
        <h3>Prix unitaire</h3>
        <div class='aff_prod'>".$produit['prix']." €"."</div>
      </div>

      <div class='block_prix'>
        <h3>Prix</h3>
        <div class='aff_prod'>".$produit['prix']." €"."</div>
      </div>
    </div>

  </div>        
            ";
            $total = $total + ($produit['prix'] *$produit['quantite']);
}
 $html .="<span class='aff_prod'>  
                <h3>Total</h3>
                <div id='prixtotal'>".$total."</div>€
            </span>";


echo json_encode($html);

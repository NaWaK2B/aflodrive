<?php
require_once "database.php";
$db = new Database();
$GLOBALS['database'] = $db->etatConnexion();
session_start();

switch ($_POST['request']) {
    case 'recherche':

        $html = '';
        $requete = "SELECT * FROM `articles` WHERE `nom_article` like '%" . mysqli_real_escape_string($GLOBALS['database'], $_POST['press']) . "%'";
        $result = mysqli_query($GLOBALS['database'], $requete) or die;
        while ($data = mysqli_fetch_assoc($result)) {

         
            $html .= "
          
            <article class='card'>
            <div>
            <h3 id='nom_".$data['id_article']."' class='title_card'>" . $data['nom_article'] . "</h3>
              <div id='photo' class='card_img'><img src='" . $data['photo'] . "'></div>

              <div class='bloc_article-quantite'>
                <div class='quantite'>
                <input id='quantite_".$data['id_article']."' type='number' placeholder='1' value='1' />
                </div>

                <div class='card_price'>
                <span id='prix_".$data['id_article']."' >".$data['prix']. "€"."</span>
                  </div>
              </div>

              <div class='card_content'>
                <div id='category'>
                  <h3>" . $data['category'] . "</h3>
                </div>

                <div id='descriptif'>
                  <p>
                    " . $data['descriptif'] . "
                  </p>
                </div>
                <button class='btn' type='submit' onclick='addPanier(".$data['id_article'].")'>Ajouter au panier</button>
              </div>
            </div>
          </article>
          ";
        }

        echo json_encode($html);
        break;

        case'afficher':

          $html = '';
          $requete = "SELECT id_article, qt, nom_article FROM articles";
          $result = mysqli_query($GLOBALS['database'], $requete) or die;
          while ($data = mysqli_fetch_assoc($result)) {

       
            $html .= "
              <tr>
                <td id='iden'>" .$data['id_article']. "</td> 
                <td>" .$data['nom_article']. "</td>
                <td>" .$data['qt']." </td>
                <td><button style='background-color:red; border: none; padding:0.5rem 0.7rem 0.5rem 0.7rem; color:white;' onclick='supprimer(".$data['id_article'].")'>Suppimer</button></td>
                
              </tr>
          ";
        }
        echo json_encode($html);
    break;

    case 'change':
      $html = '';
      $requete = "SELECT * FROM `articles` WHERE `category` like '%" . mysqli_real_escape_string($GLOBALS['database'], $_POST['id']) . "%'";
      $result = mysqli_query($GLOBALS['database'], $requete) or die;
      while ($data = mysqli_fetch_assoc($result)) {

       
          $html .= "
        
          <article class='card'>
          <div>
          <h3 id='nom_".$data['id_article']."' class='title_card'>" . $data['nom_article'] . "</h3>
            <div id='photo' class='card_img'><img src='" . $data['photo'] . "'></div>

            <div class='bloc_article-quantite'>
              <div class='quantite'>
              <input id='quantite_".$data['id_article']."' type='text' placeholder='1' value='1' />
              </div>

              <div class='card_price'>
              <span id='prix_".$data['id_article']."' >".$data['prix']. "€"."</span>
                </div>
            </div>

            <div class='card_content'>
              <div id='category'>
                <h3>" . $data['category'] . "</h3>
              </div>

              <div id='descriptif'>
                <p>
                  " . $data['descriptif'] . "
                </p>
              </div>
              <button class='btn' type='submit' onclick='addPanier(".$data['id_article'].")'>Ajouter au panier</button>
            </div>
          </div>
        </article>
        ";
      }

      echo json_encode($html);
      break;


      case 'updatePanier':
        $quantite_total = 0;
        if(isset($_SESSION['panier'])){
          foreach($_SESSION['panier'] as $id => $produit){
              
            $quantite_total = $quantite_total+ $produit['quantite'];
        }


        }
          
          echo json_encode($quantite_total);
  
        break;

        case'afficher_commande':

          $html = '';
          $requete = "SELECT commande.id_commande, commande.contenue_commande, commande.id_client, commande.prix_total, clients.nom_client,clients.prenom_client,clients.email_client,clients.tel FROM `commande`
          INNER JOIN clients ON clients.id_client=commande.id_client";
          $result = mysqli_query($GLOBALS['database'], $requete) or die;
          while ($data = mysqli_fetch_assoc($result)) {

            $json = json_decode($data['contenue_commande'],true);
            $liste = "";
            foreach($json as $key => $value){

              $liste .= $value['nom'].": ".$value['quantite']."<br>";

            }
       
            $html .= "
              <tr>
                <td id='iden'>" .$data['id_commande']. "</td> 
                <td>" .$liste. "</td>
                <td>" .$data['id_client']." </td>
                <td>" .$data['nom_client']." </td>
                <td>" .$data['prenom_client']." </td>
                <td>" .$data['email_client']." </td>
                <td>" .$data['tel']." </td>

                
              </tr>
          ";
        }
        echo json_encode($html);
    break;
        



}

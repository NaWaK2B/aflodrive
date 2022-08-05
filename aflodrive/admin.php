

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<link rel="stylesheet" href="./css/dashboard-style.css">
	<title>Dashboard admin aflodrive</title>
</head>
<body>

<main class="dashboard">
      <aside class="dashboard-container">
        <div class="dashboard_admin">
          <img src="./img/user.png" alt="image d'admin" />
        </div>
        <div class="container_nav-dasboard">
          <div class="nav_link-dashboard">
            <a class="tabs__toggle  is-active">Ajouter Produit</a>
            <a class="tabs__toggle" onclick="afficher();">Supprimer Article</a>
            <a class="tabs__toggle" onclick="afficher_commande()">Commande</a>
            <a class="tabs__toggle">Code Promo</a>
          </div>

          <div class="dashboard_deconnect">
            <i class="fa-solid fa-arrow-right-from-bracket fa-lg"></i>
            <a href="#">Deconnection</a>
          </div>
        </div>
      </aside>

      <div class="dashboard_content">

        <div class="dashboard_banner">
          <div class="dashboard_banner-items">
            <div class="dashboard_items">
              <i class="fa-solid fa-box fa-3x"></i>
              <p>Commande</p>
              <span>0</span>
            </div>

            <div class="dashboard_items">
              <i class="fa-regular fa-calendar-days fa-3x"></i>
              <p>Date</p>
              <span>05/08/22</span>
            </div>

            <div class="dashboard_items">
              <i class="fa-regular fa-clock fa-3x"></i>
              <p>Date</p>
              <span>00h00</span>
            </div>
          </div>
        </div>

        <div class="tabs__body">
            <div id="add" class="tabs__content is-active">
              <div class="tabs__title">
                <h2>Ajouter produit</h2>

        <form class="admin_form">      
				<label> Nom</label>
				<input type="text" id="nom" class="field"/>
				<label> Prix</label>
				<input type="text" id="prix" class="field"/>
				<label> Quantité</label>
				<input type="text" id="quantite" class="field"/>
				<label> Descriptif</label>
				<input type="text" id="descriptif" class="field"/>
				<label> Photo </label>
				<input type="text" id="photo" class="field"/>
				<label> Categorie </label>
				<select id="category" class="field">
          <!-- POUR ADRIEN -->
					<option value="viande-poisson">Viande / Poisson</option>
					<option value="fruit-legume">Fruit / Légume</option>
					<option value="cremerie">Crémerie</option>
          <option value="autre">Autre</option>
				</select>
				<button type="submit" onclick="ajout()" value="ajout"> Ajouter Produit </button>
        </form> 

              </div>
            </div>

            <div id="modify" class="tabs__content" >
              <div class="tabs__title">
                <h2>Supprimer Article</h2>
                <table>
                    <tr>
                      <td> ID </td>
                      <td> NOM </td>
                      <td>QUANTITE </td>
                    </tr>
                    <tbody id="resultat"></tbody>
                  </table>
              </div>
            </div>
            <div id="commande" class="tabs__content" >
              <div class="tabs__title">
                <h2>Commande</h2>
               <!-- La commande -->
               <table>
                    <tr>
                      <td> ID </td>
                      <td> DETAIL COMMANDE </td>
                      <td>ID CLIENT </td>
                      <td>NOM</td>
                      <td>PRENOM</td>
                      <td>EMAIL</td>
                      <td>TEL</td>
                    </tr>
                    <tbody id="resultat_commande"></tbody>
                  </table>
              </div>
            </div>

      
            <div id="promo" class="tabs__content" >
              <div class="tabs__title">
                <h2>Code promo</h2>
              <!-- Le code promo -->
              <form class="admin_form">      
				<label> Nom</label>
				<input type="text" id="nom_promo" class="field"/>
				<label> Pourcentage</label>
				<input type="text" id="pourcentage" class="field"/>
				<button type="submit" onclick="ajout_code()" value="ajout"> Créer le code </button>
        </form> 
              </div>
            </div>
          </div>

      </div>

    </main>
	
</body>
<script src="./Js/dashbord.js"></script>
<script src="https://kit.fontawesome.com/96625a3117.js" crossorigin="anonymous"></script>

</html>




<script>
// Ajouter un produit depuis le Dashboard
function ajout(){

    $.ajax({

		url: './Back/Modif.php',
		dataType: 'json',
		type: 'POST',
		data: {
			request: 'ajout',
			nom: $("#nom").val(),
            prix: $("#prix").val(),
            quantite: $("#quantite").val(),
            descriptif: $("#descriptif").val(),
            photo: $("#photo").val(),
            category: $("#category").val(),
		},
		success: function(response) {
            alert(response)

		},
		error: function() {
			alert("Error !");
		}
	});
}



function afficher() {
        console.log("oui");

        $.ajax({
          url: "./BACK/Controller.php",
          dataType: "JSON",
          type: "POST",
          data: {
            request: "afficher",

          },
          success: function (response) {
            console.log(response);
            $("#resultat").html(response);
            
          },
          error: function () {
            alert("Error !");
          },
        });
      }

      function afficher_commande() {

        $.ajax({
          url: "./BACK/Controller.php",
          dataType: "JSON",
          type: "POST",
          data: {
            request: "afficher_commande",

          },
          success: function (response) {
            console.log(response);
            $("#resultat_commande").html(response);
            
          },
          error: function () {
            alert("Error !");
          },
        });
      }

      function supprimer(id) {
        $.ajax({
          url: "./BACK/Modif.php",
          dataType: "JSON",
          type: "POST",
          data: {
            request: "supprimer",
            id: id,

          },
          success: function (response) {
            afficher();
            
          },
          error: function () {
            alert("Error !");
          },
        });
      }
      
      function ajout_code(){

        $.ajax({

        url: './Back/Modif.php',
        dataType: 'json',
        type: 'POST',
        data: {
          request: 'ajout_code',
          nom_promo: $("#nom_promo").val(),
          pourcentage: $("#pourcentage").val(),
        },
        success: function(response) {
                alert(response)

        },
        error: function() {
          alert("Error !");
        }
        });
        }



</script>
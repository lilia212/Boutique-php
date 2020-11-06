<?php
require_once 'inc/init.php';
$contenu_gauche=''; //pour le HTML du bloc "categorie"
$contenu_droite='';
$prix='';
$description='';
 //pour le HTML du bloc produits 
//1- Af;fichage des catégories
$resultat =executeRequete("SELECT DISTINCT categorie FROM produit"); // ON SELECTIONE toutes les categories en enlevant les doublons avec DISTINCT.
$contenu_gauche .= '<div class="list-group mb-4">';
// Lien "toutes les catégories :"
$contenu_gauche .='<a href="?categorie=all" class="list-group-item">Toutes les catégories</a>' ;// on passe dans l'url que la catégorie est "all" vers la même page

//Liens des catégories de la BDD :
while($cat=$resultat->fetch(PDO::FETCH_ASSOC) ){
   // debug($cat);//$cat est un tableau avec l'indice "categorie"
   $contenu_gauche .= '<a href="?categorie='.$cat['categorie'].'" class="list-group-item">'.$cat['categorie'].'</a>';

}


$contenu_gauche .= '</div>';

//2- Affichage des produits :
//debug($_GET).
if (isset($_GET['categorie']) && $_GET['categorie'] !='all' ){// si on demandé une categorie autre que "toutes les catégories", on séleectionne en BDD les produits de la catégorie demandée :
    $resultat =executeRequete("SELECT id_produit, reference, titre, photo, prix, description FROM produit WHERE categorie =:categorie", array(':categorie'=>$_GET['categorie'])); 


}else{// sinon si "categorie" n'est pas dans l'url j'arrive pour la première fois ou que l'on a choisi toutes les catégories, on sélectionne Tous les produits
    $resultat =executeRequete("SELECT id_produit, reference, titre, photo, prix, description FROM produit");

}
while($produit=$resultat->fetch(PDO::FETCH_ASSOC)){ // on fait une boucle car il y a plusieurs produits
    $contenu_droite .= '<div class="col-md-4 mb-4">';
    $contenu_droite .= '<div class="card">';
            //image cliquable
            $contenu_droite .='<a href="detail_produit.php?id_produit='.$produit['id_produit'].'"><img src="'.$produit['photo'].'" alt="'.$produit['titre'].'" class="card-img-top"></a>';

            //infos produit
            $contenu_droite .='<div class="card-body">';
                $contenu_droite .='<h4>'  . $produit['titre'] .'</h4>';
                
                //$prix = number_format(floatval($produit['prix']), 2, ',','');
                $prix = number_format($produit['prix'], 2, ',','');

                $contenu_droite .='<h4>' . $prix .'€</h4>';
                if(strlen($produit['description'])>20){
                    $description= substr( $produit['description'],0,30) ."..." ;
                }else{// sinon on laisse le champ en entier
                    $description =$produit['description'];
                }
                
                $contenu_droite .='<p>' . $description .'</p>';

                
            $contenu_droite .= '</div>';// card body


    $contenu_droite .= '</div>';//.card
    $contenu_droite .='</div>';

}

require_once 'inc/header.php';
?>
<h1 class="mt-4">Nos vêtements</h1>
<div class="row">
    <div class="col-md-3">
        <?php echo $contenu_gauche;?>
    </div>
    <div class="col-md-9">
        <div class="row">
        <?php echo $contenu_droite;?>
        </div>
    </div>
</div>
<?php
require_once 'inc/footer.php';

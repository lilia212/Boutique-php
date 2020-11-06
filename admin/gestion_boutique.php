<?php
require_once '../inc/init.php'; // on remonte vers le dossier parent avec ../

//1 on vérifie que le membre est bien admin, sinon  on le redirige vers la page de connexion :
if(!estAdmin()){
    header('location:../connexion.php');
    exit;

} 
if(isset($_GET['id_produit'])){
    $resultat= executeRequete ("DELETE FROM produit WHERE id_produit= :id_produit", array(':id_produit'=>$_GET['id_produit']));
    //on obtient 1 lors de la supression d'un produit

    if($resultat->rowCount()==1){ //si le DELETE retourne 1 ligne c'est que la requête a marché
        $contenu .='<div class="alert alert-success"> Le produit a bien été supprimé.</div>';
    }else{
        $contenu .='<div class="alert alert-danger"> Le produit n\'a pu être supprimé.</div>';
    }
}  

require_once '../inc/header.php'; 
// --6Liste des produits dans une table 
$resultat  = executeRequete("SELECT * FROM produit");
$contenu .="Le nombre de produits est ".$resultat->rowCount();
$contenu .='<table class="table">';
  // Les entêtes
    $contenu .='<tr>';
    $contenu .='<th>ID</th>';
    $contenu .='<th>Référence</th>';
    $contenu .='<th>Catégorie</th>';
    $contenu .='<th>Titre</th>';
    $contenu .='<th>Description</th>';
    $contenu .='<th>Couleur</th>';
    $contenu .='<th>Taille</th>';
    $contenu .='<th>Public</th>';
    $contenu .='<th>Photo</th>';
    $contenu .='<th>Prix</th>';
    $contenu .='<th>Stock</th>';
    $contenu .='<th>Actions</th>';//colonne pour les liens modifier et supprimer
    

    $contenu .='</tr>';

    //les lignes de produit
    //debug($resultat);
    while($produit=$resultat->fetch(PDO::FETCH_ASSOC)){
        //debug($produit);//puisque $produit est un tableau, on le parcourt avec une foreach :
            $contenu .='<tr>'; //on crée 1 ligne de <table> par produit
            foreach($produit as $indice => $information){ //$information parcourt les valeurs de $produit
                if($indice=='photo'){
                    $contenu .='<td><img src="../'.$information .'" style="width:90px"></td>';//$information contient le chemin relatif de la photo vers le dosier "photo/" qui se trouve dans le dossier parent. On concatène donc "../"       }        
                 }
                else{// sinon on affiche les autres valeurs dans un <td> seul :
                    $contenu .='<td>'.$information .'</td>';
                }
            
            }
            //on ajoute les liens "modifier" et "supprimer" :
            $contenu .='<td>
                            <a href="formulaire_produit.php?id_produit='.$produit['id_produit'].'">Modifier</a> | <a href="?id_produit='.$produit['id_produit'].'"  onclick="return confirm(\'Etes-vous certain de vouloir supprimer ce produit ?\');">Supprimer</a>
                       </td>';    
            $contenu .='</tr>';

    
}    
$contenu .='</table>';
//2- onglets de navigation
?>
<h1 class="mt-4">Gestion de la boutique</h1>
<ul class="nav nav-tabs">
    <li><a href="gestion_boutique.php" class="nav-link active">Liste des produits</a></li>
    <li><a href="formulaire_produit.php" class="nav-link">Formulaire produit</a></li>
    <li></li>
</ul>

<?php
echo $contenu; // pour afficher les messages et le tableau des produits
require_once '../inc/footer.php'; 

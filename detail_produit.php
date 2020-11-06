<?php
require_once 'inc/init.php';

//controle de l'existance demandé
if(isset($_GET['id_produit'])){

    $resultat=executeRequete("SELECT * FROM produit WHERE id_produit =:id_produit", array(':id_produit'=>$_GET['id_produit']));

    if($resultat->rowCount() == 0){// si résultat n'a pas de ligne , c'est que le produit n'est en BDD en redirge aussi vers la boutique
        header('location:index.php');
        exit;
    }
      
    //2- on prépare les données du produit à afficher
    $produit = $resultat->fetch(PDO::FETCH_ASSOC);
    //debug($produit);
    extract($produit);// cette fonction prédéfinie crée des variables nomées commes les indices du tableau et on affecte les valeurs du tableau. Exemple : $produit['titre'] devient la variable $titre.
        
    


}else{
    header('location:index.php');// s'il n'y a pas d'id_produit dans l'URL, on redirge
    exit;
}
//------------------AFFICHAGE-------------
require_once 'inc/header.php';
?>
<div class="row">

    <div class="col-12">
        <h1 class="mt-4"><?php echo $titre; //on peut faire <?= fait <?php echo ?></h1>
    </div>
   
    <div class="col-md-8"> <!-- photo -->
   
        <img class="img-fluid w-75"  src="<?php echo $photo; ?>" alt="<?php echo $titre; ?>">
    </div>
    <div class="col-md-4"> <!-- infos -->
        <h2>Description</h2>
        <p><?php echo $description;?></p>
        <h2>Détails</h2>
        <ul>
            <li>Catégorie: <?php echo $categorie;?></li>
            <li>Couleur: <?php echo $couleur;?></li>
            <li>Taille: <?php echo $taille;?></li>
        </ul>
        <div class="lead">Prix : 
        <?php echo number_format($prix,2,","," ");?> €TTC
        </div>
        <div><a href="index.php?categorie=<?php echo $categorie; ?>">Retour vers la séléction</a></div>
    </div>

    <div class="col-md-3">
    
    </div>
   



</div><!--div classe row-->

<?php



require_once 'inc/footer.php';

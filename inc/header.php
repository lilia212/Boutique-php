<!doctype html>
<html lang="fr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>Ma Boutique</title>
  </head>
  <body>
    <!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
   
   <div class="container">
        <!--La marque-->
        <a class="navbar-brand" href="<?php echo RACINE_SITE . 'index.php' ;?>">MA BOUTIQUE</a>
        <!--burger-->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!--Menu de navigation-->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              
            <?php
                echo '<li><a class="nav-link" href="'. RACINE_SITE .'index.php">Boutique</a></li>';
                if(estConnecte()){// si le membre est connecté
                    echo '<li><a class="nav-link" href="'. RACINE_SITE .'profil.php">Profil</a></li>';
                    echo '<li><a class="nav-link" href="'. RACINE_SITE .'connexion.php?action=deconnexion">Déconnexion</a></li>';
                }else{// sinon le membre n'est pas connecté
                    echo '<li><a class="nav-link" href="'. RACINE_SITE .'inscription.php">Inscription</a></li>';
                    echo '<li><a class="nav-link" href="'. RACINE_SITE .'connexion.php">Connexion</a></li>';

                }
                echo '<li><a class="nav-link" href="'. RACINE_SITE .'panier.php">Panier</a></li>'; 
                if(estAdmin()) { // si le membre est admin connecté
                    echo '<li><a class="nav-link" href="'. RACINE_SITE .'admin/gestion_boutique.php">Gestion de la boutique</a></li>'; 
                    echo '<li><a class="nav-link" href="'. RACINE_SITE .'admin/gestion_membre.php">Gestion des membres</a></li>'; 
                }
                
              ?>  
            </ul>
        </div>
    </div><!-- .container-->
</nav>

<!--Contenu de la page -->
    <main class="container" style="min-height:80vh;">

    
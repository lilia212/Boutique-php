<?php
//Ce fichier init.php sera inclus dans tous les scripts du site (hors inclusions ) pour initialiser les éléments nécessaires au fonctionnement du site.

//Connexion à la BDD "boutique"
$pdo = new PDO('mysql:host=localhost; dbname=boutique','root', '', array(PDO::ATTR_ERRMODE =>PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

//Session 
session_start(); // créer un fichier appelé session sur le serveur dans le lequel on stocke des données celles du membre ou de son panier. Si la session existe déjà, on y accède directement à l'aide de 'lidentifiant reçu dans un cokkie depuis le navigateur de l'internaute.

// Constante qui contient le chemin du site
define('RACINE_SITE', '/PHP/08-site/' ); // ici on indique  le dossier dans le quel se trouve le site à partir de "localhost". S'il n'est dans aucun dossier, on met un "/" seul. Permet de créer des chemins absolus à partir de "localhost" à partir de "localhost". Rappel : le / au début du chemin caractèrise un chemin absolu.

//Initialisation d'une variable pour afficher du contenu HTML: 
$contenu='';//on y mettra du HTML

//Inclusions de fonctions :
require_once 'functions.php';


<?php

/** 
 * Mission : architecture MVC GsbParam
 
 * @file index.php
 * @mainpage Projet GsbParam Architecture MVC en PHP Objet
 * 
 * Ce projet montre la gestion d'un panier de produits avec enregistrement des commandes
 * 
 * @author Marielle Jouin <jouin.marielle@gmail.com>
 * @version    3.0
 * @date septembre 2023

 */
session_start();
require 'controleurs/Routeur.php';
include("vues/v_entete.html");
include("vues/v_bandeau.php");
$routeur = new Routeur();
$routeur->routerRequete();
include("vues/v_pied.html");

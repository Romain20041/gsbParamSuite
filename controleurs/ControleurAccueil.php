<?php

/** @file ControleurAccueil.php
 * @author Marielle Jouin <jouin.marielle@gmail.com>
 * @version    3.0
 * @date septembre 2023
 * @details Gère l'affichage de la page d'accueil du site
 */
require_once 'Modele/ModeleFront.php';
/**
 * La classe qui gère l'accueil du site
 */
class ControleurAccueil
{
    private $produit;

    public function __construct()
    {
        $this->produit = new ModeleFront();
    }

    public function accueil()
    {
        include("vues/v_accueil.html");
    }
}

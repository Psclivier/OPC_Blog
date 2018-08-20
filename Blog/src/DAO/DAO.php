<?php
/**
 * Created by PhpStorm.
 * User: Paulin
 * Date: 28/07/2018
 * Time: 10:27
 */

namespace App\src\DAO;

abstract class DAO {


    private $bdd;

    protected function executerRequete($sql, $params = null) {
        if ($params == null) {
            $resultat = $this->getBdd()->query($sql); // exécution directe
        }
        else {
            $resultat = $this->getBdd()->prepare($sql);  // requête préparée
            $resultat->execute($params);
        }
        return $resultat;
    }

    private function getBdd() {
        if ($this->bdd == null) {
            // Création de la connexion
            $this->bdd = new \PDO(DB_HOST, DB_USER, DB_PASS,
                array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION));
        }
        return $this->bdd;
    }
}
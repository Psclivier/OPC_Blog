<?php
/**
 * Created by PhpStorm.
 * User: Paulin
 * Date: 28/07/2018
 * Time: 10:27
 */

namespace BlogPSC;

abstract class Database {

    const DB_HOST ='mysql:host=localhost;dbname=monblog;charset=utf8';
    const DB_USER ='root';
    const DB_PASS ='root';

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
            $this->bdd = new \PDO(self::DB_HOST, self::DB_USER, self::DB_PASS,
                array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION));
        }
        return $this->bdd;
    }

}
<?php

require_once 'src/Modele/Modele.php';


class Billet extends Modele {
//    // Liste des billets du blog.
//    public function getBillets() {
//        $sql = 'select BIL_ID as id, BIL_DATE as date,'
//                . ' BIL_TITRE as titre, BIL_CONTENU as contenu from T_BILLET'
//                . ' order by BIL_ID desc';
//        $billets = $this->executerRequete($sql);
//        return $billets;
//    }
//
//    // Récupère les infos d'un billet.
//    public function getBillet($idBillet) {
//        $sql = 'select BIL_ID as id, BIL_DATE as date,'
//                . ' BIL_TITRE as titre, BIL_CONTENU as contenu from T_BILLET'
//                . ' where BIL_ID=?';
//        $billet = $this->executerRequete($sql, array($idBillet));
//        if ($billet->rowCount() > 0)
//            return $billet->fetch();  // Accès à la première ligne de résultat
//        else
//            throw new Exception("Aucun billet ne correspond à l'identifiant '$idBillet'");
//    }


    // Ajoute un nouveau billet.
    public function addBillet($titre, $contenu) {
        $sql = 'insert into T_Billet(BIL_DATE, BIL_TITRE, BIL_CONTENU)'
            . ' values(?, ?, ?)';
        $date = date(DATE_W3C);  // Récupère la date courante
        $this->executerRequete($sql, array($date, $titre, $contenu));
    }

    public function updatePost($titre, $contenu, $idBillet){
        $sql ='UPDATE t_billet SET BIL_TITRE = ?, BIL_CONTENU = ? WHERE BIL_ID = ?';
        $this->executerRequete($sql, array( $titre, $contenu, $idBillet));
    }

    // Supprimer billet.
    public function deleteBillet($idBillet){
        $sql = 'DELETE FROM T_BILLET WHERE BIL_ID = ?';
        $this->executerRequete($sql, array($idBillet));
    }

}
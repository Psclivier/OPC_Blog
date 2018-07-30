<?php

require_once 'src/Modele/Modele.php';

class Commentaire extends Modele {

//    // Renvoie la liste des commentaires associés à un billet
//    public function getCommentaires($idBillet) {
//        $sql = 'select COM_ID as id, COM_DATE as date,'
//                . ' COM_AUTEUR as auteur, COM_CONTENU as contenu from T_COMMENTAIRE'
//                . ' where BIL_ID=?';
//        $commentaires = $this->executerRequete($sql, array($idBillet));
//        return $commentaires;
//    }
//
//    public function getAllCom(){
//        $sql = 'select COM_ID as id, COM_DATE as date,'
//            . ' COM_AUTEUR as auteur, COM_CONTENU as contenu from T_COMMENTAIRE'
//            . ' order by COM_INDEX desc';
//        $commentaires = $this->executerRequete($sql);
//        return $commentaires;
//    }
//
//    public function getComInfo ($idCommentaire){
//        $sql = 'select COM_ID as id, COM_DATE as date,'
//            . ' COM_AUTEUR as auteur, COM_CONTENU as contenu from T_COMMENTAIRE'
//            . ' where COM_ID=?';
//        $commentaires = $this->executerRequete($sql, array($idCommentaire));
//        return $commentaires->fetch();
//    }

    // Ajoute un commentaire dans la base
    public function ajouterCommentaire($auteur, $contenu, $idBillet) {
        $sql = 'insert into T_COMMENTAIRE(COM_DATE, COM_AUTEUR, COM_CONTENU, BIL_ID)'
            . ' values(?, ?, ?, ?)';
        $date = date(DATE_W3C);  // Récupère la date courante
        $this->executerRequete($sql, array($date, $auteur, $contenu, $idBillet));
    }

    // Supprimer un commentaire.
    public function supprimerCommentaire($idCommentaire){
        $sql = 'DELETE FROM T_COMMENTAIRE WHERE COM_ID = ?';
        $this->executerRequete($sql, array($idCommentaire));
    }

    // Editer un commentaire.
    public function updateCom($auteur, $contenu, $idCommentaire){
        $sql ='UPDATE t_commentaire SET COM_AUTEUR = ?, COM_CONTENU = ? WHERE COM_ID = ?';
        $this->executerRequete($sql, array( $auteur, $contenu, $idCommentaire));
    }

    // Signaler un commentaire.
    public function incrementIndex($idCommentaire){
        $sql ='UPDATE t_commentaire SET COM_INDEX = COM_INDEX + 1 WHERE COM_ID = ?';
        $this->executerRequete($sql, array($idCommentaire));
        echo "Le commentaire a été signaler.";
    }
}
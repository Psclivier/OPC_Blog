<?php
/**
 * Created by PhpStorm.
 * User: Paulin
 * Date: 28/07/2018
 * Time: 10:27
 */


require_once 'src/DAO/DAO.php';

class CommentDAO extends \BlogPSC\Database {

    // Retrive all comments of an article.
    public function getCommentaires($idBillet) {
        $sql = 'select COM_ID as id, COM_DATE as date,'
            . ' COM_AUTEUR as auteur, COM_CONTENU as contenu from T_COMMENTAIRE'
            . ' where BIL_ID=?';
        $commentaires = $this->executerRequete($sql, array($idBillet));
        return $commentaires;
    }

    // Retrive all comments.
    public function getAllCom(){
        $sql = 'select COM_ID as id, COM_DATE as date,'
            . ' COM_AUTEUR as auteur, COM_CONTENU as contenu from T_COMMENTAIRE'
            . ' where flag= "true" ';
        $commentaires = $this->executerRequete($sql);
        return $commentaires;
    }


    public function getComInfo ($idCommentaire){
        $sql = 'select COM_ID as id, COM_DATE as date,'
            . ' COM_AUTEUR as auteur, COM_CONTENU as contenu from T_COMMENTAIRE'
            . ' where COM_ID=?';
        $commentaires = $this->executerRequete($sql, array($idCommentaire));
        return $commentaires->fetch();
    }
    // Add a comment.
    public function addComment($auteur, $contenu, $idBillet) {
        $sql = 'INSERT INTO T_COMMENTAIRE(COM_DATE, COM_AUTEUR, COM_CONTENU, BIL_ID)'
            . ' VALUES(?, ?, ?, ?)';
        $date = date(DATE_W3C);  // Récupère la date courante
        $this->executerRequete($sql, array($date, $auteur, $contenu, $idBillet));
    }

    // Delete a comment.
    public function deleteComment($idCommentaire){
        $sql = 'DELETE FROM T_COMMENTAIRE WHERE COM_ID = ?';
        $this->executerRequete($sql, array($idCommentaire));
    }

    // Update a comment.
    public function updateCom($auteur, $contenu, $idCommentaire){
        $sql ='UPDATE T_COMMENTAIRE SET COM_AUTEUR = ?, COM_CONTENU = ?, flag = "false" WHERE COM_ID = ?';
        $this->executerRequete($sql, array( $auteur, $contenu, $idCommentaire));
    }

    // Signal a comment.
    public function incrementIndex($idCommentaire){
        $sql ='UPDATE T_COMMENTAIRE SET flag = "true" WHERE COM_ID = ?';
        $this->executerRequete($sql, array($idCommentaire));
        echo "<script>alert('Ce commentaire a été signalé.');</script>";
    }

    // Take off  signal.
    public function takeOffFlag($idCommentaire){
        $sql = 'UPDATE T_COMMENTAIRE SET flag = "false" WHERE COM_ID = ?';
        $this->executerRequete($sql, array($idCommentaire));
    }
}
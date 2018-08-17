<?php
/**
 * Created by PhpStorm.
 * User: Paulin
 * Date: 28/07/2018
 * Time: 10:27
 */

namespace  App\src\DAO;

use App\src\Model\Comment;

class CommentDAO extends DAO {

    // Retrive all comments of an article.
    public function getComments($idBillet) {
        $sql = 'select COM_ID as id, COM_DATE as date,'
            . ' COM_AUTEUR as auteur, COM_CONTENU as contenu from T_COMMENT'
            . ' where ART_ID=?';
        $result = $this->executerRequete($sql, array($idBillet));
        $comments = [];
        foreach ($result as $row){
            $commentId = $row['id'];
            $comments[$commentId] = $this->buildObject($row);
        }
        return $comments;
    }

    // Retrive all comments.
    public function getAllCom()
    {
        $sql = 'select COM_ID as id, COM_DATE as date,'
            . ' COM_AUTEUR as auteur, COM_CONTENU as contenu from T_COMMENT'
            . ' where flag= "true" ';
        $result = $this->executerRequete($sql);
        $comments = [];
        foreach ($result as $row) {
            $commentId = $row['id'];
            $comments[$commentId] = $this->buildObject($row);
            return $comments;
        }
    }


    public function getComInfo ($idCommentaire){
        $sql = 'select COM_ID as id, COM_DATE as date,'
            . ' COM_AUTEUR as auteur, COM_CONTENU as contenu from T_COMMENT'
            . ' where COM_ID=?';
        $commentaires = $this->executerRequete($sql, array($idCommentaire));
        return $commentaires->fetch();
    }
    // Add a comment.
    public function addComment($auteur, $contenu, $idBillet) {
        $sql = 'INSERT INTO T_COMMENT(COM_DATE, COM_AUTEUR, COM_CONTENU, ART_ID)'
            . ' VALUES(?, ?, ?, ?)';
        $date = date(DATE_W3C);  // Récupère la date courante
        $this->executerRequete($sql, array($date, $auteur, $contenu, $idBillet));
    }

    // Delete a comment.
    public function deleteComment($idCommentaire){
        $sql = 'DELETE FROM T_COMMENT WHERE COM_ID = ?';
        $this->executerRequete($sql, array($idCommentaire));
    }

    // Update a comment.
    public function updateCom($auteur, $contenu, $idCommentaire){
        $sql ='UPDATE T_COMMENT SET COM_AUTEUR = ?, COM_CONTENU = ?, flag = "false" WHERE COM_ID = ?';
        $this->executerRequete($sql, array( $auteur, $contenu, $idCommentaire));
    }

    // Signal a comment.
    public function incrementIndex($idCommentaire){
        $sql ='UPDATE T_COMMENT SET flag = "true" WHERE COM_ID = ?';
        $this->executerRequete($sql, array($idCommentaire));
        echo "<script>alert('Ce commentaire a été signalé.');</script>";
    }

    // Take off  signal.
    public function takeOffFlag($idCommentaire){
        $sql = 'UPDATE T_COMMENT SET flag = "false" WHERE COM_ID = ?';
        $this->executerRequete($sql, array($idCommentaire));
    }

    private function buildObject(array $row)
    {
        $comment = new Comment();
        $comment->setId($row['id']);
        $comment->setPseudo($row['auteur']);
        $comment->setContent($row['contenu']);
        return $comment;
    }


}
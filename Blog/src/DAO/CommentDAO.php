<?php

namespace  App\src\DAO;

use App\src\Model\Comment;

class CommentDAO extends DAO {

    // Retrive all comments of an article.
    public function getComments($idBillet) {
        $sql = 'select com_id as id, com_date as date,'
            . ' com_auteur as auteur, com_content as contenu from comment'
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
        $sql = 'select com_id as id, com_date as date,'
            . ' com_auteur as auteur, com_content as contenu from comment'
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
        $sql = 'select com_id as id, com_date as date,'
            . ' com_auteur as auteur, com_content as contenu from comment'
            . ' where com_id=?';
        $commentaires = $this->executerRequete($sql, array($idCommentaire));
        return $commentaires->fetch();
    }
    // Add a comment.
    public function addComment($auteur, $contenu, $idBillet) {
        $sql = 'INSERT INTO comment(com_date, com_auteur, com_content, ART_ID)'
            . ' VALUES(?, ?, ?, ?)';
        $date = date(DATE_W3C);  // Récupère la date courante
        $this->executerRequete($sql, array($date, $auteur, $contenu, $idBillet));
    }

    // Delete a comment.
    public function deleteComment($idCommentaire){
        $sql = 'DELETE FROM comment WHERE com_id = ?';
        $this->executerRequete($sql, array($idCommentaire));
    }

    // Update a comment.
    public function updateCom($auteur, $contenu, $idCommentaire){
        $sql ='UPDATE comment SET com_auteur = ?, com_content = ?, flag = "false" WHERE com_id = ?';
        $this->executerRequete($sql, array( $auteur, $contenu, $idCommentaire));
    }

    // Signal a comment.
    public function incrementIndex($idCommentaire){
        $sql ='UPDATE comment SET flag = "true" WHERE com_id = ?';
        $this->executerRequete($sql, array($idCommentaire));
        echo "<script>alert('Ce commentaire a été signalé.');</script>";
    }

    // Take off  signal.
    public function takeOffFlag($idCommentaire){
        $sql = 'UPDATE comment SET flag = "false" WHERE com_id = ?';
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
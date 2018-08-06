<?php
/**
 * Created by PhpStorm.
 * User: Paulin
 * Date: 28/07/2018
 * Time: 10:27
 */



require_once 'src/DAO/DAO.php';
require_once 'src/model/Article.php';

use TutoMVC\src\Model\Article;

class BilletDAO extends \BlogPSC\Database{
    // List articles.
    public function getBillets()
    {
        $sql = 'select BIL_ID as id, BIL_DATE as date,'
            . ' BIL_TITRE as titre, BIL_CONTENU as contenu from T_BILLET'
            . ' order by BIL_ID desc';
        $billets = $this->executerRequete($sql);
        return $billets;
    }

    // Retrive article info.
    public function getBillet($idBillet)
    {
        $sql = 'select BIL_ID as id, BIL_DATE as date,'
            . ' BIL_TITRE as titre, BIL_CONTENU as contenu from T_BILLET'
            . ' where BIL_ID=?';
        $billet = $this->executerRequete($sql, array($idBillet));
        if ($billet->rowCount() > 0)
            return $billet->fetch();  // Accès à la première ligne de résultat
        else
            throw new Exception("Aucun billet ne correspond à l'identifiant '$idBillet'");
    }



//    public function getBillets()
//    {
//        $sql = 'select BIL_ID as id, BIL_DATE as date,'
//            . ' BIL_TITRE as titre, BIL_CONTENU as contenu from T_BILLET'
//            . ' order by BIL_ID desc';
//        $billets = $this->executerRequete($sql);
//        $articles = [];
//        foreach ($billets as $row) {
//            $articleId = $row['id'];
//            $articles[$articleId] = $this->buildObject($row);
//        }
//        return $articles;
//    }
//
//    // Récupère les infos d'un billet.
//    public function getBillet($idBillet)
//    {
//        $sql = 'select BIL_ID as id, BIL_DATE as date,'
//            . ' BIL_TITRE as titre, BIL_CONTENU as contenu from T_BILLET'
//            . ' where BIL_ID=?';
//        $billet = $this->executerRequete($sql, array($idBillet));
//        $row = $billet->fetch();
//        if ($row) {
//            return $this->buildObject($row);  // Accès à la première ligne de résultat
//
//        }else {
//            throw new Exception("Aucun billet ne correspond cet l'identifiant");
//        }
//    }


    // Add an articles.
    public function addBillet($titre, $contenu) {
        $sql = 'INSERT INTO T_BILLET(BIL_DATE, BIL_TITRE, BIL_CONTENU)'
            . ' VALUES(?, ?, ?)';
        $date = date(DATE_W3C);  // Récupère la date courante
        $this->executerRequete($sql, array($date, $titre, $contenu));
    }

    // Update an article.
    public function updatePost($titre, $contenu, $idBillet){
        $sql ='UPDATE t_billet SET BIL_TITRE = ?, BIL_CONTENU = ? WHERE BIL_ID = ?';
        $this->executerRequete($sql, array( $titre, $contenu, $idBillet));
    }

    // Delete an article.
    public function deleteArticle($idBillet){
        $sql = 'DELETE FROM T_COMMENTAIRE WHERE BIL_ID = ?';
        $this->executerRequete($sql, array($idBillet));
        $sql1 = 'DELETE FROM T_BILLET WHERE BIL_ID = ?';
        $this->executerRequete($sql1, array($idBillet));

//        $sql = 'DELETE c, a FROM T_BILLET a INNER JOIN T_COMMENTAIRE c ON c.BIL_ID = a.BIL_ID WHERE a.BIL_ID = ?';
//        $sql = 'DELETE c, a,'
//             . 'FROM t_billet a'
//             . 'INNER JOIN t_commentaire c'
//             . ' ON c.bil_id = a.bil_id'
//             . ' WHERE a.bil_id = ?';
    }


    private function buildObject(array $row)
    {
        $article = new Article();
        $article->setId($row['id']);
        $article->setTitle($row['titre']);
        $article->setContent($row['contenu']);
        $article->setDate($row['date']);
        return $article;
    }
}
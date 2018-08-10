<?php
/**
 * Created by PhpStorm.
 * User: Paulin
 * Date: 28/07/2018
 * Time: 10:27
 */

namespace src\DAO;

require_once 'src/DAO/DAO.php';
require_once 'src/model/Article.php';

use TutoMVC\src\Model\Article;

class ArticleDAO extends \BlogPSC\Database{

    public function getArticles()
    {
        $sql = 'select ART_ID as id, ART_DATE as date,'
            . ' ART_title as title, ART_CONTENT as CONTENT from T_article'
            . ' order by ART_ID desc';
        $result = $this->executerRequete($sql);
        $articles = [];
        foreach ($result as $row) {
            $articleId = $row['id'];
            $articles[$articleId] = $this->buildObject($row);
        }
        return $articles;
    }

    // Récupère les infos d'un article.
    public function getArticle($idarticle)
    {
        $sql = 'select ART_ID as id, ART_DATE as date,'
            . ' ART_title as title, ART_CONTENT as CONTENT from T_article'
            . ' where ART_ID=?';
        $article = $this->executerRequete($sql, array($idarticle));
        $row = $article->fetch();
        if ($row) {
            return $this->buildObject($row);  // Accès à la première ligne de résultat

        }else {
            throw new Exception("Aucun article ne correspond cet l'identifiant");
        }
    }


    // Add an articles.
    public function addarticle($title, $CONTENT) {
        $sql = 'INSERT INTO T_article(ART_DATE, ART_title, ART_CONTENT)'
            . ' VALUES(?, ?, ?)';
        $date = date(DATE_W3C);  // Récupère la date courante
        $this->executerRequete($sql, array($date, $title, $CONTENT));
    }

    // Update an article.
    public function updatePost($title, $CONTENT, $idarticle){
        $sql ='UPDATE t_article SET ART_title = ?, ART_CONTENT = ? WHERE ART_ID = ?';
        $this->executerRequete($sql, array( $title, $CONTENT, $idarticle));
    }

    // Delete an article.
    public function deleteArticle($idarticle){
        $sql = 'DELETE FROM T_comment WHERE ART_ID = ?';
        $this->executerRequete($sql, array($idarticle));
        $sql1 = 'DELETE FROM T_article WHERE ART_ID = ?';
        $this->executerRequete($sql1, array($idarticle));

//        $sql = 'DELETE c, a FROM T_article a INNER JOIN T_COMMENTAIRE c ON c.ART_ID = a.ART_ID WHERE a.ART_ID = ?';
//        $sql = 'DELETE c, a,'
//             . 'FROM t_article a'
//             . 'INNER JOIN t_commentaire c'
//             . ' ON c.ART_id = a.ART_id'
//             . ' WHERE a.ART_id = ?';
    }


    private function buildObject(array $row)
    {
        $article = new Article();
        $article->setId($row['id']);
        $article->setTitle($row['title']);
        $article->setContent($row['CONTENT']);
        $article->setDate($row['date']);
        return $article;
    }
}
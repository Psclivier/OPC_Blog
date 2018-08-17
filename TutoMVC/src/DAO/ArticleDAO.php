<?php
/**
 * Created by PhpStorm.
 * User: Paulin
 * Date: 28/07/2018
 * Time: 10:27
 */

namespace App\src\DAO;

use App\src\Model\Article;
use Exception;

class ArticleDAO extends DAO {

    public function getArticles()
    {
        $sql = 'select count(ART_ID) as nbART from T_article';
        $req = $this->executerRequete($sql);
        $data = $req->fetch();


        $nbART = $data['nbART'];
        $perPage = 4;
        $nbPage = ceil($nbART/$perPage);

        if(isset($_GET['p']) && $_GET['p']>0 && $_GET['p']<=$nbPage){
            $cPage = $_GET['p'];
        }
        else{
            $cPage = 1;
        }

        $sql = 'select ART_ID as id, ART_DATE as date,'
            . ' ART_title as title, ART_CONTENT as CONTENT from T_article'
            . ' order by ART_ID desc limit '.(($cPage-1)*$perPage).', '.$perPage.'';
        $result = $this->executerRequete($sql);
        $articles = [];
        foreach ($result as $row) {
            $articleId = $row['id'];
            $articles[$articleId] = $this->buildObject($row);
        }
        $data = [$articles, $nbPage];
        return $data;
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
        $sql = 'DELETE FROM T_article WHERE ART_ID = ?';
        $this->executerRequete($sql, array($idarticle));
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
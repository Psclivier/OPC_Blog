<?php

namespace App\src\DAO;

use App\src\Model\Article;
use Exception;

class ArticleDAO extends DAO {

    public function getArticles()
    {
        $sql = 'select count(art_id) as nbART from article';
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

        $sql = 'select art_id as id, art_date as date,'
            . ' art_title as title, art_content as content from article'
            . ' order by art_id desc limit '.(($cPage-1)*$perPage).', '.$perPage.'';
        $result = $this->executerRequete($sql);
        $articles = [];
        foreach ($result as $row) {
            $articleId = $row['id'];
            $articles[$articleId] = $this->buildObject($row);
        }
        $data = [$articles, $nbPage, $cPage];
        return $data;
    }

//    public function getArticles()
//    {
//        $sql = 'select art_id as id, art_date as date,'
//            . 'art_title as title, art_content as content from article'
//            . ' order by art_id desc';
//        $result = $this->executerRequete($sql);
//        $articles = [];
//        foreach ($result as $row) {
//            $articleId = $row['id'];
//            $articles[$articleId] = $this->buildObject($row);
//        }
//        $data = [$articles];
//        return $data;
//    }

//    public function getArticles()
//    {
//        $sql = 'select art_id as id, art_date as date,'
//            . ' art_title as title, art_content as content from article'
//            . ' order by art_id desc';
//        $articles = $this->executerRequete($sql);
//        return $articles;
//    }



    // Récupère les infos d'un article.
    public function getArticle($idarticle)
    {
        $sql = 'select art_id as id, art_date as date,'
            . 'art_title as title, art_content as content from article'
            . ' where art_id=?';
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
        $sql = 'INSERT INTO article(art_date, art_title, art_content)'
            . ' VALUES(?, ?, ?)';
        $date = date(DATE_W3C);  // Récupère la date courante
        $this->executerRequete($sql, array($date, $title, $CONTENT));
    }

    // Update an article.
    public function updatePost($title, $CONTENT, $idarticle){
        $sql ='UPDATE article SET art_title = ?, art_content = ? WHERE art_id = ?';
        $this->executerRequete($sql, array( $title, $CONTENT, $idarticle));
    }

    // Delete an article.
    public function deleteArticle($idarticle){
        $sql = 'DELETE FROM comment WHERE art_id = ?';
        $this->executerRequete($sql, array($idarticle));
        $sql = 'DELETE FROM article WHERE art_id = ?';
        $this->executerRequete($sql, array($idarticle));
    }


    private function buildObject(array $row)
    {
        $article = new Article();
        $article->setId($row['id']);
        $article->setTitle($row['title']);
        $article->setContent($row['content']);
        $article->setDate($row['date']);
        return $article;
    }
}
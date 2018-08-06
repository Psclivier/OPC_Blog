<?php
/**
 * Created by PhpStorm.
 * User: Paulin
 * Date: 02/07/2018
 * Time: 09:50
 */
?>
<?php $this->titre = "Mon Blog"; ?>

<form method="post" action="index.php?action=poster">
    <input id="titre" name="titre" type="text" placeholder="Titre"
           required /><br />
    <textarea name="contenu" id="editeur" contenteditable style="width: 850px; height: 500px;" required></textarea><br />
    <input type="hidden" name="id" value="<?= $billet['id'] ?>" />
    <input type="submit" value="Poster" />
</form>
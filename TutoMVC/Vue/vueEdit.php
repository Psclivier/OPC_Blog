
/**
 * Created by PhpStorm.
 * User: Paulin
 * Date: 06/07/2018
 * Time: 12:10
 */

<?php $this->titre = "Mon Blog"; ?>



<form method="post" action="index.php?action=remplacer">
    <input id="titre" name="titre" type="text" placeholder="Titre"
           required /><br />
    <textarea name="contenu" id="editeur" contenteditable style="width: 850px; height: 500px;"></textarea>
    <input type="submit" value="Editer" />
</form>
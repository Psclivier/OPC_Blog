<?php
/**
 * Created by PhpStorm.
 * User: Paulin
 * Date: 17/07/2018
 * Time: 11:05
 */

//if ($_SESSION['rank'] == "admin") : ?>

<form method="post" action="index.php?action=poster">
    <input id="titre" name="titre" type="text" placeholder="Titre"
           required /><br />
    <textarea name="editeur" id="editeur" contenteditable style="width: 850px; height: 500px;"></textarea>
    <input type="submit" class="btn-info" value="Publier" />
</form>
<!---->
<?php //endif; ?>
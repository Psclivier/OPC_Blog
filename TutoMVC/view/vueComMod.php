<?php
/**
 * Created by PhpStorm.
 * User: Paulin
 * Date: 14/07/2018
 * Time: 10:05
 */

?>


<?php foreach ($comments as $comment): ?>
<div class="media thumbnail">
    <p><?= $comment->getPseudo(); ?> dit :</p>
    <p><?= $comment->getContent(); ?></p>

    <!-- Formulaire suppression commentaire.-->
    <p><a href="<?= "index.php?action=supprimer&id=" . $comment->getId(); ?>"id="delete" class="btn btn-danger">Supprimer</a></p>

    <!-- édition commentaire.-->
    <p><a href="<?= "index.php?action=getcomedit&idcom=" . $comment->getId(); ?>"id="edit" class="btn btn-warning">Editer</a></p>
</div>
<?php endforeach; ?>




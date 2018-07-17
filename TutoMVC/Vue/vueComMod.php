<?php
/**
 * Created by PhpStorm.
 * User: Paulin
 * Date: 14/07/2018
 * Time: 10:05
 */

?>


<?php foreach ($commentaires as $commentaire): ?>
    <p><?= $commentaire['auteur'] ?> dit :</p>
    <p><?= $commentaire['contenu'] ?></p>



    <!-- Formulaire suppression commentaire.   -->
    <form method="post" id="supprimer" action="index.php?action=supprimer">
        <input type="hidden" name="id" value="<?= $commentaire['id'] ?>" />
        <input type="submit" class="btn-danger" value="Supprimer" />
    </form>


    <!--  Formulaire édition commentaire.  -->
    <form method="post" id="editer" action="index.php?action=getcomedit">
        <input type="hidden" name="id" value="<?= $billet['id'] ?>" />
        <input type="hidden" name="id" value="<?= $commentaire['id'] ?>" />
        <input type="hidden" name="contenu" value="<?= $commentaire['contenu'] ?>" />
        <input type="hidden" name="auteur" value="<?= $commentaire['auteur'] ?>" />
        <input type="submit" class="btn-warning" value="Editer" />
    </form>
    <hr />


<?php endforeach; ?>




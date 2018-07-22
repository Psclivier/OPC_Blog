<?php
/**
 * Created by PhpStorm.
 * User: Paulin
 * Date: 14/07/2018
 * Time: 10:05
 */

?>


<?php foreach ($commentaires as $commentaire): ?>
<div class="media thumbnail">
    <p><?= $commentaire['auteur'] ?> dit :</p>
    <p><?= $commentaire['contenu'] ?></p>



    <!-- Formulaire suppression commentaire.   -->
    <p><a href="<?= "index.php?action=supprimer&id=" . $commentaire['id'] ?>" class="btn btn-danger">Supprimer</a></p>


    <!-- édition commentaire.  -->
    <p><a href="<?= "index.php?action=getcomedit&id=" . $commentaire['id'] . "&auteur=" . $commentaire['auteur'] . "&contenu=" . $commentaire['contenu'] ?>"class="btn btn-warning">Editer</a></p>
</div>



<?php endforeach; ?>




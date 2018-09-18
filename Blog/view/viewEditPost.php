<?php
if (isset($_SESSION['rank']) && ($_SESSION['rank'] == "admin")) : ?>
<article>
    <header>
        <h1 class="titreBillet"><?= $article->getTitle(); ?></h1>
    </header>

    <form method="post" action="index.php?action=setpostedit">
        <input id="titre" name="titre"  style="width: 850px" type="text"  value= " <?= htmlspecialchars($article->getTitle()); ?> "/><br />
        <textarea name="contenu" id="editeur" contenteditable style="width: 850px; height: 500px;"><?= htmlspecialchars($article->getContent()); ?></textarea>
        <input type="hidden" name="id" value="<?=$article->getId();?>" />
        <input type="submit" class="btn-info" value="Mettre à jour" />
    </form>
</article>
<?php endif; ?>
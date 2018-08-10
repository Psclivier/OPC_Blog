<article>
    <header>
        <h1 class="titreBillet"><?= $article->getTitle(); ?></h1>
    </header>

    <form method="post" action="index.php?action=setpostedit">
        <input id="titre" name="titre" type="text" value= <?= $article->getTitle(); ?>
               required /><br />
        <textarea name="contenu" id="editeur" contenteditable style="width: 850px; height: 500px;"><?= $article->getContent(); ?></textarea>
        <input type="hidden" name="id" value="<?=$article->getId();?>" />
        <input type="submit" class="btn-info" value="Mettere à jour" />
    </form>
</article>


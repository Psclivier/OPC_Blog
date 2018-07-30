<article>
    <header>
        <h1 class="titreBillet"><?= $titre ?></h1>
    </header>

    <form method="post" action="index.php?action=setpostedit">
        <input id="titre" name="titre" type="text" value= <?= $titre ?>
               required /><br />
        <textarea name="contenu" id="editeur" contenteditable style="width: 850px; height: 500px;"><?= $contenu ?></textarea>
        <input type="hidden" name="id" value="<?=$id?>" />
        <input type="submit" class="btn-info" value="Mettere à jour" />
    </form>
</article>


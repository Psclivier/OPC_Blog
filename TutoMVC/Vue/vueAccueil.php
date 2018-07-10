<?php $this->titre = "Mon Blog"; ?>



<form method="post" action="index.php?action=poster">
    <input id="titre" name="titre" type="text" placeholder="Titre"
           required /><br />
    <textarea name="contenu" id="editeur" contenteditable style="width: 850px; height: 500px;"></textarea>
    <input type="submit" value="Publier" />
</form>



<?php foreach ($billets as $billet):

    ?>
    <article>
        <header>
            <a href="<?= "index.php?action=billet&id=" . $billet['id'] ?>">
                <h1 class="titreBillet"><?= $billet['titre'] ?></h1>
            </a>
            <time><?= $billet['date'] ?></time>
        </header>
        <p><?= $billet['contenu'] ?></p>
    </article>
    <hr />
<?php endforeach; ?>

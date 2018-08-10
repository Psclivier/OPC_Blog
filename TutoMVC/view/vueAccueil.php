
<?php foreach ($articles as $article):

    ?>
    <article>
        <header>
            <a href="<?= "index.php?action=article&id=" . $article->getId(); ?>">
                <h1 class="articletitle"><?= $article->getTitle(); ?></h1>
            </a>
            <time><?= $article->getDate(); ?></time>
        </header>
        <p><?= substr($article->getContent(),0, 1000) ?></p>
    </article>
    <hr />
<?php endforeach; ?>

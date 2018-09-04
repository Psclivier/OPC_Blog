<section class="posts">
<?php foreach ($data[0] as $article):

    ?>
        <article>
            <header>
                <span class="date"><?= $article->getDate(); ?></span>
                <h2><a href="<?= "index.php?action=article&id=" . $article->getId(); ?>"><?= $article->getTitle(); ?>
                       </a></h2>
            </header>
            <p><?= substr($article->getContent(),0, 500) ?></p>
            <ul class="actions special">
                <li><a href="<?= "index.php?action=article&id=" . $article->getId(); ?>" class="button">Lire la suite</a></li>
            </ul>
        </article>
<!---->
<!--        <article>-->
<!--            <header>-->
<!--                <span class="date">--><?//= $article['date'] ?><!--</span>-->
<!--                <h2><a href="--><?//= "index.php?action=article&id=" . $article['id'] ?><!--">--><?//= $article['title'] ?>
<!--                       </a></h2>-->
<!--            </header>-->
<!--            <p>--><?//= substr($article['content'],0, 500) ?><!--</p>-->
<!--            <ul class="actions special">-->
<!--                <li><a href="--><?//= "index.php?action=article&id=" . $article['id'] ?><!--" class="button">Lire la suite</a></li>-->
<!--            </ul>-->
<!--        </article>-->

<?php endforeach; ?>
</section>

<footer>
    <div class="pagination">

        <?php         for ($i=1;$i<=$data[1];$i++){
            if($i==$data[2]){
                echo " $i /";
            }else{
                echo "<a href=\"index.php?p=$i\"> $i </a>";}
        }?>
    </div>
</footer>




<?php
    use \Lisonsjeunesse\Core\Utils\Template;
    use \Lisonsjeunesse\Core\Utils\Pagination;
?>
<div class="LastPosts is-flex is-wrap">
    <?php foreach($posts as $post): ?>
    <div class="is-column is-4">
        <?php Template::component('preview/post', array('post' => $post)); ?>
    </div>
    <?php endforeach; ?>

    <div class="is-flex is-center has-width-100">
        <a class="button is-flex is-center" href="<?= Pagination::getNextPage() ?>">Charger plus d'articles</a>
    </div>
</div>
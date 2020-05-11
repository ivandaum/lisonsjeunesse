<?php
    use \Lisonsjeunesse\Core\Utils\Template;
    use \Lisonsjeunesse\Core\Utils\Pagination;
?>
<?php if (Pagination::getCurrentPage() > 1): ?>
    <p class="is-secondary-title is-padding-top-7 is-padding-bottom-6 has-text-center has-font-serif">Page <?= Pagination::getCurrentPage() ?></p>
<?php endif; ?>

<div class="LastPosts is-flex is-wrap js-posts">
    <?php foreach($posts as $post): ?>
    <div class="is-column is-4 is-12-touch">
        <?php Template::component('preview/post', array('post' => $post)); ?>
    </div>
    <?php endforeach; ?>

    <?php if(!count($posts)): ?>
        <p class="is-secondary-title has-font-serif has-width-100 has-text-center">Il n'y a pas d'articles.</p>
    <?php endif; ?>
</div>

<?php if(!count($posts)): ?>
    <?php if (!isset($noPagination) || $noPagination === false): ?>
    <div class="is-flex is-center has-width-100">
        <a class="button is-flex is-center js-detach-core js-infinite-load-btn" href="<?= Pagination::getNextPage() ?>">Charger plus d'articles</a>
    </div>
    <?php endif; ?>
<?php endif; ?>
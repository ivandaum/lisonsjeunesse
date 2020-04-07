<?php
    use \Lisonsjeunesse\Core\Utils\Template;
    use \Lisonsjeunesse\Core\Utils\Pagination;
?>
<?php if (Pagination::getCurrentPage() > 1): ?>
    <p class="is-secondary-title is-padding-top-6">Page <?= Pagination::getCurrentPage() ?></p>
<?php endif; ?>
<div class="LastPosts is-flex is-wrap">
    <?php foreach($posts as $post): ?>
    <div class="is-column is-4">
        <?php Template::component('preview/post', array('post' => $post)); ?>
    </div>
    <?php endforeach; ?>
</div>

<?php if (!isset($noPagination) || $noPagination === false): ?>
<div class="is-flex is-center has-width-100">
    <a class="button is-flex is-center" href="<?= Pagination::getNextPage() ?>">Charger plus d'articles</a>
</div>
<?php endif; ?>
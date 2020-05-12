<?php
    use \Lisonsjeunesse\Core\Utils\Template;
    use \Lisonsjeunesse\Core\Utils\Pagination;

        header('Content-type: text/html; charset=utf-8');
?>
<?php if (Pagination::getCurrentPage() > 1 && !wp_doing_ajax()): ?>
    <p class="is-secondary-title is-padding-top-7 is-padding-bottom-6 has-text-center has-font-serif">Page <?= Pagination::getCurrentPage() ?></p>
<?php endif; ?>

<?php if(!wp_doing_ajax()): ?>
<div class="LastPosts is-flex is-wrap js-posts">
<?php endif; ?>

<?php foreach($posts as $post): ?>
<div class="is-column is-4 is-12-touch">
    <?= Template::component('preview/post', array('post' => $post)); ?>
</div>
<?php endforeach; ?>

<?php if(!wp_doing_ajax()): ?>
    <?php if(!count($posts)): ?>
        <p class="is-secondary-title has-font-serif has-width-100 has-text-center is-padding-bottom-10 is-padding-top-10">Il n'y a pas d'articles.</p>
    <?php endif; ?>
</div>
<?php endif; ?>

<?php if(count($posts) && !wp_doing_ajax()): ?>
    <?php if (!isset($noPagination) || $noPagination === false): ?>
    <div class="is-flex is-center has-width-100">
        <a class="button is-flex is-center js-detach-core js-infinite-load-btn" data-ajax='<?php if(isset($ajax)): echo $ajax; else: echo "{}"; endif; ?>' href="<?= Pagination::getNextPage() ?>">Charger plus d'articles</a>
    </div>
    <?php endif; ?>
<?php endif; ?>

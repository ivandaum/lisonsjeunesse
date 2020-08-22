<?php
    use \Lisonsjeunesse\Core\Utils\Template;
    use \Lisonsjeunesse\Core\Utils\Pagination;
?>
<?php if (Pagination::getCurrentPage() > 1 && !wp_doing_ajax()): ?>
    <p class="is-secondary-title is-padding-top-7 is-padding-bottom-6 has-text-center has-font-serif is-column is-12 is-12-touch is-relative">Page <?= Pagination::getCurrentPage() ?></p>
<?php endif; ?>

<?php if(!wp_doing_ajax()): ?>
<div class="LastPosts is-flex is-wrap js-posts">
<?php endif; ?>

<?php foreach($posts as $k => $post): ?>
<div class="is-column is-4 is-12-touch is-relative">
    <?= Template::component('preview/post', array('post' => $post)); ?>
</div>
<?php endforeach; ?>

<?php if(!wp_doing_ajax()): ?>
    <?php if(is_array($posts) && !count($posts)): ?>
        <p class="is-secondary-title has-font-serif has-width-100 has-text-center is-padding-bottom-10 is-padding-top-10 is-padding-bottom-10-touch is-padding-top-10-touch">Il n'y a pas encore de livres</br> dans cette catégorie.</p>
    <?php endif; ?>
</div>
<?php endif; ?>

<?php if(!wp_doing_ajax()): ?>
<div class="js-ajax-preload is-absolute" style="bottom: 100vh"></div>
<?php endif; ?>

<?php if(is_array($posts) && count($posts) && !wp_doing_ajax()): ?>
    <?php if (!isset($noPagination) || $noPagination === false): ?>
    <div class="is-flex is-center has-width-100">
        <a class="button button--loading is-flex is-center js-detach-core js-infinite-load-btn" data-ajax='<?php if(isset($ajax)): echo json_encode($ajax); else: echo "{}"; endif; ?>' href="<?= Pagination::getNextPage() ?>"><span>Charger plus de livres</span></a>
    </div>
    <?php endif; ?>
<?php endif; ?>

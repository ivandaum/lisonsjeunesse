<?php
    use \Lisonsjeunesse\Core\Utils\Template;
    use \Lisonsjeunesse\Core\Layouts\Category;

    $category = new Category();
    get_header(); 
?>
<article class="Category is-main-category Category--greige" data-router-view="category">
    <div class="Category__header">
        <div class="container">
            <h1 class="is-title has-font-serif" hidden>Découvrir par <span class="is-lowercase"><?= $category->mainCategory->name ?></span></h1>
            <?= Template::layout('post/featured', array('post' => $category->firstPost, 'isHover' => true)); ?>
        </div>
    </div>

    <div class="has-background-white">
        <div class="container">
            <?= Template::layout('posts', array('posts' => $category->posts, 'ajax' => $category->getAjaxParams())); ?>
        </div>
    </div>
</article>

<?php
    get_footer();
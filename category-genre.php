<?php
    use \Lisonsjeunesse\Core\Utils\Template;
    use \Lisonsjeunesse\Core\Layouts\Category;

    $count = get_option('posts_per_page') + 1;
    $category = new Category($count);

    $ajax = array_merge($category->getAjaxParams(), array('offset' => 1));
    $featured = $category->posts[0];
    unset($category->posts[0]);

    get_header(); 
?>
<article class="Category is-main-category Category--greige" data-router-view="category">
    <div class="Category__header">
        <div class="container ">
            <?php if(!$category->hasParent): ?>
                <h1 hidden>Découvrir par genre</h1>
            <?php else: ?>
                <h1 hidden>Découvrir par <?=strtolower($featured->mainCategory->name) ?></h1>
            <?php endif; ?>
            <?= Template::layout('post/featured', array('post' => $featured, 'isHover' => true)); ?>
        </div>
    </div>

    <div class="has-background-white is-padding-top-7">
        <div class="container">
            <?= Template::layout('posts', array('posts' => $category->posts, 'ajax' => $ajax)); ?>
        </div>
    </div>
</article>

<?php
    get_footer();
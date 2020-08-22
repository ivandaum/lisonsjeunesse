<?php
    use \Lisonsjeunesse\Core\Utils\Template;
    use \Lisonsjeunesse\Core\Layouts\Category;

    $count = get_option('posts_per_page') + 1;
    $category = new Category($count);

    $ajax = array_merge($category->getAjaxParams(), array('offset' => 1));
    $featured = null;
    
    if(count($category->posts)) {
        $featured = $category->posts[0];
        unset($category->posts[0]);
    }

    get_header();
?>
<article class="Category is-main-category Category--greige" data-router-view="category">
    <div class="Category__header is-relative">
        <div class="container">
            <?php if(!$category->hasParent || !$featured): ?>
                <h1 hidden>Découvrir par genre</h1>
            <?php else: ?>
                <h1 hidden>Découvrir par <?= strtolower($featured->mainCategory->name) ?></h1>
            <?php endif; ?>
            <?php if($featured): ?>
            <?= Template::layout('post/featured', array('post' => $featured, 'isHover' => true)); ?>
            <?php endif; ?>
        </div>
    </div>

    <div class="Category__posts is-relative has-background-white is-padding-top-7">
        <?= Template::layout('filters', array('categories' => $category->filters)); ?>
        <div class="container">
            <?= Template::layout('posts', array('posts' => $category->posts, 'ajax' => $ajax)); ?>
        </div>
    </div>
</article>

<?php
    get_footer();
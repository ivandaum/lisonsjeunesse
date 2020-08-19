<?php
    use \Lisonsjeunesse\Core\Utils\Template;
    use \Lisonsjeunesse\Core\Layouts\Category;

    $category = new Category();
    get_header(); 
?>
<article class="Category is-main-category Category--greige" data-router-view="category">
    <div class="Category__header ">
        <div class="container">
            <h1 class="is-title has-font-serif ">Explorer par <span class="is-lowercase"><?= $category->mainCategory->name ?></span></h1>
            <?= Template::layout('filters', array('categories' => $category->subCategories, 'isActivable' => true)); ?>
        </div>
    </div>
    <div class="has-background-white is-padding-top-7">
        <div class="container">
            <?= Template::layout('posts', array('posts' => $category->posts, 'ajax' => $category->getAjaxParams())); ?>
        </div>
    </div>
</article>
<?php
get_footer();
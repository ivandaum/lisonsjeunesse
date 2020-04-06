<?php
    use \Lisonsjeunesse\Core\Utils\Template;
    use \Lisonsjeunesse\Core\Layouts\Category;

    $category = new Category();

    get_header(); 
?>
<article class="Category" data-router-view="category">
    <h1 class="is-title is-center is-flex">Explorer par âge</h1>
    <div class="container">
        <?php Template::layout('categories', array('categories' => $category->subCategories)); ?>
    </div>
    <div class="container">
        <?php Template::layout('posts', array('posts' => $category->posts)); ?>
    </div>
</article>
<?php get_footer(); ?>
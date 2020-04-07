<?php
    use \Lisonsjeunesse\Core\Utils\Template;
    use \Lisonsjeunesse\Core\Layouts\Category;

    $category = new Category();

    if ($category->haveMainCategory) {
        $file = 'category-' . $category->mainCategory->slug;
        if (Template::exists($file)) {
            Template::file($file, array('category' => $category));
            die;
        }
    }

    get_header(); 

?>
    <article class="Category" data-router-view="category">
        <h1 class="is-title is-center is-flex"><?= $category->name ?></h1>
        <div class="has-background-white">
            <div class="container">
                <?php Template::layout('filters', array('categories' => $category->subCategories)); ?>  
                <?php Template::layout('posts', array('posts' => $category->posts)); ?>
            </div>
        </div>
    </article>
<?php get_footer(); ?>
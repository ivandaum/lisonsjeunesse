<?php
    use \Lisonsjeunesse\Core\Utils\Template;
    use \Lisonsjeunesse\Core\Layouts\Category;

    $category = new Category();

    if ($category->haveMainCategory) {
        $file = 'category-' . $category->mainCategory->slug;
        if (Template::exists($file)) {
            echo Template::file($file, array('category' => $category));
            die;
        }
    }

    get_header(); 

?>
    <article class="Category " data-router-view="category">
        <h1 class="is-title is-center is-flex has-font-serif "><?= $category->name ?></h1>
        <div class="has-background-white Category__posts is-relative">
            <div class="container">
                <?= Template::layout('sub-categories', array('categories' => $category->subCategories)); ?>  
                <?= Template::layout('posts', array('posts' => $category->posts, 'ajax' => $category->getAjaxParams())); ?>
            </div>
        </div>
    </article>
<?php get_footer(); ?>
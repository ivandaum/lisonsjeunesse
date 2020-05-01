<?php
    use \Lisonsjeunesse\Core\Utils\Template;
    use \Lisonsjeunesse\Core\Layouts\Category;
?>
<article class="Category is-main-category" data-router-view="category">
    <div class="Category__header">
        <div class="container">
            <h1 class="is-title has-font-serif ">Explorer par <span class="is-lowercase"><?= $category->mainCategory->name ?></span></h1>
            <?php Template::layout('filters', array('categories' => $category->subCategories, 'isActivable' => true)); ?>
        </div>
    </div>
    <div class="has-background-white">
        <div class="container">
            <?php Template::layout('posts', array('posts' => $category->posts)); ?>
        </div>
    </div>
</article>
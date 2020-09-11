<?php
    use \Lisonsjeunesse\Core\Utils\Template;
    use \Lisonsjeunesse\Core\Layouts\Author;

    $author = new Author();

    get_header(); 

?>
    <article class="Category " data-router-view="category">
        <h1 class="is-title is-center is-flex has-font-serif ">Articles de <?= $author->name ?></h1>
        <div class="has-background-white Category__posts is-relative">
            <div class="container">
                <?= Template::layout('posts', array('posts' => $author->posts, 'ajax' => $author->getAjaxParams())); ?>
            </div>
        </div>
    </article>
<?php get_footer(); ?>
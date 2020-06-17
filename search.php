<?php
    get_header(); 
    use \Lisonsjeunesse\Core\Layouts\Search;
    use \Lisonsjeunesse\Core\Utils\Template;

    $search = new Search($_GET['s']);
?>
    <article class="Search" data-router-view="search">
        <div class="container">
            <h1 class="is-title is-center is-flex has-font-serif">Recherche</h1>
            <div class="is-margin-top-2 is-margin-bottom-5 is-margin-bottom-5-touch">
                <?= Template::component('search', array('value' => $search->value)); ?>
            </div>
        </div>

        <div class="has-background-white ">
            <div class="container is-padding-top-4 is-padding-top-4-touch">
                <?= Template::layout('posts', array('posts' => $search->posts, 'noPagination' => true)); ?>
            </div>
        </div>
    </article>
<?php get_footer(); ?>
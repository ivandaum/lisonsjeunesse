<?php
    get_header(); 
    use \Lisonsjeunesse\Core\Layouts\Librairy;
    use \Lisonsjeunesse\Core\Utils\Template;

    $page = new Librairy();
?>
    <article class="Librairy" data-router-view="page">
        <header class="Librairy__header container">
            <h1 class="is-title is-center is-flex has-font-serif "><?= $page->title ?></h1>
            <p class="Librairy__subtitle has-font-serif is-relative is-padding-top-5-touch">
                <span class="is-first-letter is-absolute">R</span>
                <span class="is-relative">Retrouvez ici tous vos livres préférés. Enregistrez vos futures lectures ou des idées de découvertes pour petits et grands !</span>
            </p>
        </header>

        <div class="Librairy__posts has-background-white">
            <div class="container">
                <?php Template::layout('posts', array('posts' => $page->posts, 'noPagination' => true)); ?>
            </div>
        </div>
    </article>
<?php get_footer(); ?>
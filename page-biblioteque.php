<?php
    get_header(); 
    use \Lisonsjeunesse\Core\Layouts\Librairy;
    use \Lisonsjeunesse\Core\Utils\Template;
    use \Lisonsjeunesse\Core\Utils\Svg;

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
                <?php if(count($page->posts)): ?>
                <?php Template::layout('posts', array('posts' => $page->posts, 'noPagination' => true)); ?>
                <?php else: ?>
                    <p class="has-width-100 has-text-center Librairy__empty">
                        <span class="is-block has-font-serif is-padding-bottom-3">Il n'y a pas encore d'article enregistré dans votre bibliotèque.</span>
                        Ajoutez-en un dès maintenant en cliquant sur le <?= Svg::print('like'); ?> en dessous de chaque article.</p>
                <?php endif; ?>
            </div>
        </div>
    </article>
<?php get_footer(); ?>
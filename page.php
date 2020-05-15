<?php
    get_header(); 
    use \Lisonsjeunesse\Core\Layouts\Single;

    $single = new Single();
?>
    <article class="Single" data-router-view="page">
        <div class="container">
            <h1 class="is-title is-center is-flex has-font-serif "><?= $single->title ?></h1>
            <div class="Single__content no-first-p is-margin-top-5 is-relative wp-content">
                <?= $single->content ?>
            </div>
        </div>
    </article>
<?php get_footer(); ?>
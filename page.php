<?php
    get_header(); 
    use \Lisonsjeunesse\Core\Layouts\Single;

    $single = new Single();
?>
    <article class="Single" data-router-view="page">
        <div class="container">
            <h1 class="is-title is-center is-flex has-font-serif "><?= $single->title ?></h1>
        </div>
    </article>
<?php get_footer(); ?>
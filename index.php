<?php 
use \Lisonsjeunesse\Core\Utils\Image; 
use \Lisonsjeunesse\Core\Utils\Template; 
use \Lisonsjeunesse\Core\Utils\Svg; 
use \Lisonsjeunesse\Core\Layouts\Home;

$home = new Home();

get_header(); ?>
<article class="Home is-flex is-center" data-router-view="home">
    <div class="Home__slider is-relative is-flex is-center-y no-shrink">
    <?php foreach($home->posts as $k => $post): ?>
        <div class="Home__post is-relative no-shrink is-flex is-center js-slider-item">
            <a href="<?= $post->link ?>" class="Home__image has-height-100 has-width-100 is-flex is-center is-relative">
                <?php if($post->previewImage): ?>
                <?= Image::create($post->previewImage); ?>
                <?php endif; ?>
                <?php if($post->mainCategory): ?>
                <p class="Home__category is-absolute has-font-serif has-text-center has-width-100 is-margin-top-2-touch">
                    <?= $post->mainCategory->name ?>
                </p>
                <?php endif; ?>
            </a>
        </div>
    <?php endforeach; ?>
    </div>
</article>
<?php get_footer(); ?>
<?php 
use \Lisonsjeunesse\Core\Utils\Image; 
use \Lisonsjeunesse\Core\Utils\Template; 
use \Lisonsjeunesse\Core\Utils\Svg; 
use \Lisonsjeunesse\Core\Layouts\Home;

$home = new Home();

get_header(); ?>
<article class="Home is-flex is-center" data-router-view="home">
    <div class="Home__slider is-relative is-flex is-center-y no-shrink js-slider">
    <?php foreach($home->posts as $k => $post): ?>
        <div class="Home__post <?php if($k == 0): ?>is-active<?php endif; ?> is-relative no-shrink is-flex is-center js-slider-item">
            <div class="Home__post--inner has-width-100 has-height-100 is-flex is-center">
                <p class="Home__category js-home-category is-absolute has-font-serif"><?= $post->mainCategory->name ?></p>
    
                <?php if ($post->previewImage): ?>
                    <a class="Home__image is-relative is-flex is-center js-slider-itemImage" href="<?= $post->link ?>">
                        <?= Image::create($post->previewImage); ?>
                    </a>
                <?php endif; ?>
    
                <div class="Home__content is-absolute">
                    <h2 class="is-secondary-title"><?= $post->title ?></h2>
                    <p class="is-margin-top-2 is-margin-bottom-2"><?= $post->excerpt ?></p>
                    <span class="is-flex is-center-y is-margin-top-3"><?= Svg::print('clock'); ?><?= $post->readTime ?> min</span>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    </div>

    <div class="Home__circles has-width-100 is-absolute js-slider-circleDiv is-flex is-center">
        <?php for($i = 0; $i < 3; $i++): ?>
            <div class="Home__circle is-absolute Home__circle--<?= $i ?> js-slider-circle">
                <?php foreach($home->posts as $k => $post): ?>
                    <div class="Home__circle--image has-width-100 has-height-100 is-block is-absolute js-slider-circleImage" style="background-image: url(<?= Image::getColor($post->previewImage); ?>)"></div>
                <?php endforeach; ?>
            </div>
        <?php endfor; ?>
    </div>
</article>
<?php get_footer(); ?>
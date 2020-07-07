<?php 
use \Lisonsjeunesse\Core\Utils\Image; 
use \Lisonsjeunesse\Core\Utils\Template; 
use \Lisonsjeunesse\Core\Utils\Svg;
use \Lisonsjeunesse\Core\Utils\Text;
use \Lisonsjeunesse\Core\Layouts\Home;

$home = new Home();

get_header(); ?>
<article class="Home is-flex is-center" data-router-view="home">
    <div class="Home__slider-indicator is-absolute is-flex is-center-y container">
            <span class="is-hidden-desktop">Swipe</span>
            <span class="is-hidden-touch">Scroll</span>
            <span class="Home__indicator"></span>
    </div>
    <div class="Home__slider js-slider is-relative is-flex is-center-y no-shrink ">
    <?php foreach($home->posts as $k => $post): ?>
        <div class="Home__post is-relative no-shrink is-flex is-center js-slider-item">
            <a href="<?= $post->link ?>" class="Home__image js-image has-height-100 has-width-100 is-flex is-center">
                <?php if($post->previewImage): ?>
                <?= Image::create($post->previewImage); ?>
                <?php endif; ?>
                <?php if($post->mainCategory): ?>
                <p class="Home__category has-font-serif has-text-center has-width-100 is-margin-top-2-touch is-flex is-wrap is-center">
                    <?= Text::explodeToSpan($post->mainCategory->name) ?>
                </p>
                <?php endif; ?>

                <div class="Home__content is-column is-hidden-touch is-5 is-margin-bottom-4 is-margin-top-2-touch is-absolute">
                    <h2 class="is-secondary-title has-font-serif"><?= $post->title ?></h2>
                    <p class="is-margin-top-1 is-margin-top-2-touch"><?= $post->excerpt ?></p>
                </div>
            </a>
            <?php if($post->mainCategory): ?>
                <p class="Home__category Home__category--white is-absolute has-font-serif has-text-center has-width-100 is-flex is-wrap is-center">
                    <?= Text::explodeToSpan($post->mainCategory->name) ?>
                </p>
                <?php endif; ?>
        </div>
    <?php endforeach; ?>
        <div class="Home__last has-height-100 is-relative no-shrink is-flex is-center"></div>
    </div>
    
    <div class="Home__circle has-width-100 has-height-100 is-absolute is-flex is-center">
        <?php for($i = 0; $i < 3; $i++): ?>
            <div class="Home__circle--entry is-absolute js-circle" data-indexPos="<?= $i+$i ?>" >
            <?php foreach($home->posts as $k => $post): ?>
                <?php if($post->previewImage): ?>
                <div class="is-absolute has-height-100 has-width-100" data-id="<?= $post->id ?>" style="background: url('<?= Image::getColor($post->previewImage) ?>')"></div>
                <?php endif; ?>
            <?php endforeach; ?>
            </div>
        <?php endfor ?>
    </div>
</article>
<?php get_footer(); ?>
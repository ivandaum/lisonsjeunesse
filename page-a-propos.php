<?php
    use \Lisonsjeunesse\Core\Utils\Text;
    use \Lisonsjeunesse\Core\Utils\Image;
    use \Lisonsjeunesse\Core\Layouts\About;

    $about = new About();
get_header(); 
?>
    <article class="About" data-router-view="about">
        <div class="container ">
            <h1 hidden><?= $page->title ?></h1>
            <p class="Librairy__subtitle has-font-serif is-relative is-padding-top-5-touch">
                <span class="is-first-letter is-absolute"><?= Text::getFirstLetter($about->introduction) ?></span>
                <span class="is-relative"><?= $about->introduction ?></span>
            </p>
        </div>
        <div class="has-background-white  is-margin-top-5 is-margin-top-5-touch is-padding-top-5 is-padding-bottom-5 is-padding-top-5-touch is-padding-bottom-5-touch">
            <div class="container">
                <div class="About__team is-relative js-slider is-center is-flex">
                    <?php if($about->team): ?>
                        <div class="About__arrow is-flex is-absolute is-right">
                            <button class="arrow left no-shrink js-slider-trigger" data-direction="-1"></button>
                            <button class="arrow right no-shrink js-slider-trigger" data-direction="1"></button>
                        </div>
                        <?php foreach($about->team as $k =>$people): ?>
                            <div class="About__people is-flex is-wrap is-center js-slider-item <?php if($k === 0): ?>is-active<?php endif; ?>">
                                <div class="About__people--image no-shrink is-relative is-margin-bottom-6">
                                    <?php if($people['image']): ?>
                                    <?= Image::create($people['image']); ?>
                                    <?php endif; ?>
                                </div>
                                <div class="About__people--text is-relative is-column is-6 is-12-tablet is-margin-top-10-touch">
                                    <h3 class="has-font-serif"><?= $people['name']; ?></h3>
                                    <p class="is-margin-top-3 is-margin-top-3-touch"><?= $people['text'] ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <div class="is-flex">
                    <div class="no-first-p is-margin-top-10 is-margin-top-5-touch is-relative wp-content is-column is-7">
                        <?= $about->content ?>
                    </div>
                </div>
            </div>
        </div>
    </article>
<?php get_footer(); ?>
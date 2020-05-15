<?php
    use \Lisonsjeunesse\Core\Utils\Text;
    use \Lisonsjeunesse\Core\Utils\Image;
    use \Lisonsjeunesse\Core\Layouts\About;

    $about = new About();
get_header(); 
?>
    <article class="About" data-router-view="page">
        <div class="container">
            <h1 hidden><?= $page->title ?></h1>
            <p class="Librairy__subtitle has-font-serif is-relative is-padding-top-5-touch">
                <span class="is-first-letter is-absolute"><?= Text::getFirstLetter($about->introduction) ?></span>
                <span class="is-relative"><?= $about->introduction ?></span>
            </p>
        </div>
        <div class="has-background-white is-margin-top-5 is-margin-top-5-touch is-padding-top-5 is-padding-bottom-5 is-padding-top-5-touch is-padding-bottom-5-touch">
            <div class="container">
                <div class="About__team is-relative">
                    <?php if($about->team): ?>
                        <?php foreach($about->team as $people): ?>
                            <div class="About__people is-margin-top-5 is-margin-top-5-touch is-flex is-wrap is-center">
                                <div class="About__people--image no-shrink is-relative">
                                    <?php if($people['image']): ?>
                                    <?= Image::create($people['image']); ?>
                                    <?php endif; ?>
                                </div>
                                <div class="About__people--text is-relative is-column is-6 is-12-tablet is-margin-top-3-touch">
                                    <h3 class="has-font-serif"><?= $people['name']; ?></h3>
                                    <p class="is-margin-top-3 is-margin-top-3-touch"><?= $people['text'] ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <div class="About__description is-flex">
                    <div class="no-first-p is-margin-top-5  is-margin-top-5-touch is-relative wp-content  is-column is-7">
                        <?= $about->content ?>
                    </div>
                </div>
            </div>
        </div>
    </article>
<?php get_footer(); ?>
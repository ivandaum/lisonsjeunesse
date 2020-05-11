<?php 
    use \Lisonsjeunesse\Core\Utils\Image; 
    use \Lisonsjeunesse\Core\Utils\Template; 
    use \Lisonsjeunesse\Core\Utils\Svg; 
?>
<div class="Featured <?php if(isset($isHover) && $isHover): ?>is-hover <?php endif; ?>is-flex is-center">
    <div class="container is-relative is-flex is-center">
        <div class="is-column is-4 is-12-touch">
            <a href="<?= $post->link ?>" class="Featured__image is-flex is-center is-relative">
                <?php if($post->previewImage): ?>
                <?= Image::create($post->previewImage); ?>
                <?php endif; ?>
                <?php if($post->mainCategory): ?>
                <p class="Featured__category is-absolute has-font-serif">
                    <?= $post->mainCategory->name ?>
                </p>
                <?php endif; ?>
            </a>
            <div class="Featured__tools is-flex is-justified is-margin-top-2">
                <?php Template::component('button/add-librairy', array('id' => $post->id, 'active' => $post->isLiked)); ?>
                <span class="is-flex is-center no-shrink"><?= Svg::print('clock'); ?><?= $post->readTime ?> min</span>
            </div>
        </div>
        <div class="Featured__content is-column is-4 is-12-touch is-padding-left-3 is-margin-bottom-3">
            <h2 class="is-secondary-title has-font-serif"><?= $post->title ?></h2>
            <p class="is-block no-shrink is-margin-top-1">Article par <a href="<?= $post->author->url ?>"><?= $post->author->name ?></a></p>
            <p class="is-margin-top-1"><?= $post->excerpt ?></p>
        </div>
    </div>
</div>
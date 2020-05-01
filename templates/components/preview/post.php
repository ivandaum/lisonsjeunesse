<?php 
    use \Lisonsjeunesse\Core\Utils\Image; 
    use \Lisonsjeunesse\Core\Utils\Template; 
    use \Lisonsjeunesse\Core\Utils\Svg; 
?>
<div class="PostPreview">
    <div class="PostPreview__category is-flex is-center">
        <?php if($post->mainCategory): ?>
        <a class="is-flex is-center" href="<?= $post->mainCategory->url ?>">
            <span class="no-shrink"><?= $post->mainCategory->name ?></span>
        </a>
        <?php endif; ?>
    </div>

    <a class="PostPreview__link" href="<?= $post->link ?>">
        <?php if ($post->previewImage): ?>
            <div class="PostPreview__image is-relative is-block">
                <?= Image::create($post->previewImage); ?>
            </div>
        <?php endif; ?>
        <h3 class="PostPreview__title has-font-serif"><?= $post->title ?></h3>
    </a>
        
    <p class="PostPreview__date is-flex is-justified">
        <span class="no-shrink"><?= $post->date ?> par <a href="<?= $post->author->url ?>"><?= $post->author->name ?></a></span>
        <span class="is-flex is-center no-shrink"><?= Svg::print('clock'); ?><?= $post->readTime ?> min</span>
    </p>
    <p class="PostPreview__excerpt"><?= $post->excerpt ?></p>

    <?php Template::component('button/add-librairy', array('id' => $post->id, 'active' => $post->isLiked)); ?>
</div>
<?php 
    use \Lisonsjeunesse\Core\Utils\Image; 
    use \Lisonsjeunesse\Core\Utils\Svg; 
?>
<div class="PostPreview">
    <a class="PostPreview__category is-flex is-center" href="<?= get_category_link($post->mainCategory) ?>">
        <span class="no-shrink"><?= $post->mainCategory->name ?></span>
    </a>

    <a href="<?= $post->link ?>" class="PostPreview__image is-relative is-block">
        <?php if ($post->previewImage): ?>
            <?= Image::create($post->previewImage); ?>
        <?php endif; ?>
    </a>

    <h3 class="PostPreview__title"><a href="<?= $post->link ?>"><?= $post->title ?></a></h3>

    <p class="PostPreview__date is-flex is-justified">
        <span class="no-shrink"><?= $post->date ?> par <a href="<?= $post->author->url ?>"><?= $post->author->name ?></a></span>
        <span class="is-flex is-center no-shrink"><?= Svg::print('clock'); ?><?= $post->readTime ?> min</span>
    </p>
    <p class="PostPreview__excerpt"><?= $post->excerpt ?></p>

    <button class="is-flex is-center"><?= Svg::print('like'); ?> Ajouter à ma bibliothèque</button>
</div>
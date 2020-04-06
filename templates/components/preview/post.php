<?php
    $customColor = '';

    if (isset($options['isBlue'])) {
        $customColor .= ' has-color-humanoid-blue ';
    }
?>
<div class="PostPreview">
    <a href="<?= $post->link ?>" class="PostPreview__image has-radius-top-right is-relative is-block">
        <?php if ($post->previewImage): ?>
        <?= \Humanoid\Core\Utils\Image::create($post->previewImage); ?>
        <?php endif; ?>
    </a>
    <p class="PostPreview__date date is-size-6 <?= $customColor ?>"><?= $post->date ?></p>
    <h3 class="PostPreview__title is-size-3 has-text-weight-bold <?= $customColor ?>"><?= $post->title ?></h3>
    <?php if ($post->introduction): ?>
    <p class="PostPreview__introduction is-size-5 <?= $customColor ?>"><?= $post->introduction ?></p>
    <?php endif; ?>

    <a href="<?= $post->link ?>" class="button button--orange is-lowercase is-size-6">Lire l'article</a>
</div>
<?php use \Lisonsjeunesse\Core\Utils\Svg; ?>
<?php if(isset($id)): ?>
<button class="button-librairy is-flex is-center js-add-to-librairy" data-id="<?= $id ?>">
    <span class="button-librairy--add is-flex is-center"><?= Svg::print('like'); ?> Ajouter à ma bibliothèque</span>
    <span class="button-librairy--remove is-flex is-center"><?= Svg::print('like-full'); ?> Retirer de ma bibliothèque</span>
</button>
<?php endif; ?>
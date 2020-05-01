<?php use \Lisonsjeunesse\Core\Utils\Svg; ?>
<?php if(isset($id)): ?>
<button class="button-librairy js-add-to-librairy is-relative has-width-100 <?php if($active): ?>is-active<?php endif; ?>" data-id="<?= $id ?>">
    <span class="button-librairy--add is-flex is-center-y"><?= Svg::print('like'); ?> Ajouter à ma bibliothèque</span>
    <span class="button-librairy--remove is-flex is-center-y"><?= Svg::print('like-full'); ?> Retirer de ma bibliothèque</span>
</button>
<?php endif; ?>
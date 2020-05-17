<?php use \Lisonsjeunesse\Core\Utils\Svg; ?>
<?php if(isset($id)): ?>
<button class="button-librairy js-add-to-librairy is-relative has-width-100 is-flex <?php if($active): ?>is-active<?php endif; ?>" data-id="<?= $id ?>">
    <?= Svg::print('like'); ?>
    <div class="button-librairy--wording has-width-100 has-text-left">
        <span class="is-block">Ajouter à ma bibliothèque</span>
        <span class="is-block">Retirer de ma bibliothèque</span>
    </div>
</button>
<?php endif; ?>
<?php use \Lisonsjeunesse\Core\Utils\Svg; ?>
<div class="SearchForm has-width-100  <?php if(isset($noIcon) && $noIcon): ?>no-icon<?php endif; ?>">
    <form action="/" class="is-relative">
        <?php if(!isset($noIcon) || isset($noIcon) && $noIcon == false): ?>
        <span class="SearchForm__svg is-block is-absolute has-height-100"><?= Svg::print('search') ?></span>
        <?php endif; ?>
        <input 
            type="text"
            class="has-width-100"
            name="s"
            placeholder="Rechercher un livre, un article..."
            <?php if(isset($value) && $value): ?>
                value="<?= $value ?>"
            <?php endif; ?>>
    </form>
</div>
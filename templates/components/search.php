<?php use \Lisonsjeunesse\Core\Utils\Svg; ?>
<div class="SearchForm has-width-100">
    <form action="/" class="is-relative">
        <span class="SearchForm__svg is-block is-absolute has-height-100"><?= Svg::print('search') ?></span>
        <input 
            type="text"
            class="has-width-100"
            name="s"
            placeholder="Rechercher grâce au titre d'un livre, d'un article..."
            <?php if(isset($value) && $value): ?>
                value="<?= $value ?>"
            <?php endif; ?>>
    </form>
</div>
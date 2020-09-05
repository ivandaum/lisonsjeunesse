<?php 
use Lisonsjeunesse\Core\Utils\Url;
use \Lisonsjeunesse\Constants\TaxonomyConstants;
?>
<?php if ($categories): ?>
    <ul class="Filters sub-filters is-flex has-width-100 is-center">

    <?php foreach($categories as $category): ?>
    <li class="no-shrink <?php if($category->isActive): ?>is-active<?php endif; ?>">
        <a class="is-flex is-center" data-transition="snapPage" href="<?= Url::getWithFilter($category->isActive ? null : $category->slug) ?>"><?= $category->name ?></a>
    </li>
    <?php endforeach; ?>
</ul>
<?php endif; ?>
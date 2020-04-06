<?php use \Lisonsjeunesse\Core\Utils\Url; ?>

<?php if ($categories): ?>
<ul class="CategoriesList is-flex is-justified is-center-y">
    <?php foreach($categories as $category): ?>
    <li class="<?php if(Url::isActive(get_category_link($category))): ?>is-active<?php endif; ?>"><a href="<?= get_category_link($category) ?>"><?= $category->name ?></a></li>
    <?php endforeach; ?>
</ul>
<?php endif; ?>
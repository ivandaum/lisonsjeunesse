<?php if ($categories): ?>
<ul class="CategoriesList is-flex is-justified is-center-y">
    <?php foreach($categories as $category): ?>
    <li class="<?php if($category->isActive): ?>is-active<?php endif; ?>"><a href="<?= $category->url ?>"><?= $category->name ?></a></li>
    <?php endforeach; ?>
</ul>
<?php endif; ?>
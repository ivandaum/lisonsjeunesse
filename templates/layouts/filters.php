<?php if ($categories): ?>
    <ul class="Filters is-flex  is-center <?php if(isset($isActivable)): ?>is-activable<?php endif; ?>">
    <?php foreach($categories as $category): ?>
    <li class="<?php if($category->isActive): ?>is-active<?php endif; ?>">
        <a class="is-flex is-center" href="<?= $category->url ?>"><?= $category->name ?></a>
    </li>
    <?php endforeach; ?>
</ul>
<?php endif; ?>
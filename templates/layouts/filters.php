<?php if ($categories): ?>
    <ul class="Filters is-flex has-width-100 is-center <?php if(isset($isActivable)): ?>is-activable<?php endif; ?>">
    <?php foreach($categories as $category): ?>
    <li class="no-shrink <?php if($category->isActive): ?>is-active<?php endif; ?>">
        <a class="is-flex is-center" href="<?= $category->url ?>"><?= $category->name ?></a>
    </li>
    <?php endforeach; ?>
</ul>
<?php endif; ?>
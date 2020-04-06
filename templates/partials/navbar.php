<?php
    use \Lisonsjeunesse\Core\Utils\Menu;
    use \Lisonsjeunesse\Core\Utils\Text;

    $menu = Menu::get('header');
?>
<nav class="Navbar is-flex is-absolute is-justified">
    <a href="/" class="Navbar__logo">
        Lisons<br>Jeunesse
    </a>
    <ul class="Navbar__links is-flex no-shrink">
        <?php foreach($menu as $item): ?>
            <li class="Navbar__item Navbar__item--main is-relative  no-shrink">
                <a class="is-center is-flex" href="<?= $item->url ?>"><?= $item->title ?></a>

                <?php if(count($item->child)): ?>
                    <ul class="Navbar__sublinks is-absolute">
                    <?php foreach($item->child as $subitem): ?>
                        <li class="Navbar__item">
                            <a class="is-left-x is-center-y is-flex" href="<?= $subitem->url ?>">
                                <?= $subitem->title ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
</nav>
<?php
    use \Lisonsjeunesse\Core\Utils\Menu;
    use \Lisonsjeunesse\Core\Utils\Text;

    $menu = Menu::get('header');
    $librairyCount = 0;
    if(isset($_COOKIE['librairy'])) {
        $ids = json_decode(str_replace('\"','"', $_COOKIE['librairy']));
        $librairyCount = count($ids);
    }
?>
<nav class="Navbar is-flex is-absolute is-justified">
    <a href="/" class="Navbar__logo has-font-serif">
        Lisons<br>Jeunesse
    </a>
    <ul class="Navbar__links is-flex no-shrink">
        <?php foreach($menu as $item): ?>
            <li class="Navbar__item Navbar__item--main is-relative no-shrink">
                <a class="is-center is-flex js-<?= $item->slug ?>" href="<?= $item->url ?>">
                <?= $item->title ?>
                <?php if( $item->slug === 'biblioteque'): ?>
                    <span class="Navbar__librairy-pins js-librairy-pins">
                        <?php if($librairyCount): ?>
                            <?= $librairyCount ?>
                        <?php endif; ?>
                    </span>
                <?php endif; ?>
                </a>

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
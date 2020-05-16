<?php
    use \Lisonsjeunesse\Core\Utils\Menu;
    use \Lisonsjeunesse\Core\Utils\Text;
    use \Lisonsjeunesse\Core\Utils\Template;
    use \Lisonsjeunesse\Core\Utils\Svg;
    use Lisonsjeunesse\Constants\TaxonomyConstants;

    $menu = Menu::get('header');
    $librairyCount = 0;
    if(isset($_COOKIE['librairy'])) {
        $ids = json_decode(str_replace('\"','"', $_COOKIE['librairy']));
        $librairyCount = count($ids);
    }
?>
<nav class="Navbar is-flex is-absolute is-justified js-nav">
    <a href="/" class="Navbar__logo has-font-serif">
        Lisons<br>Jeunesse
    </a>
    <button class="is-hidden-desktop is-fixed js-phone-menu-btn Navbar__phoneBtn">Menu</button>
    <ul class="Navbar__links is-flex no-shrink">
        <?php foreach($menu as $item): ?>
            <li class="Navbar__item Navbar__item--main is-relative no-shrink">
                <a class="is-center is-flex js-<?= $item->slug ?>" href="<?= $item->url ?>">
                <?= $item->title ?>
                <?php if( $item->slug === TaxonomyConstants::librairy): ?>
                    <span class="Navbar__librairy-pins is-flex js-librairy-pins">
                        <?php if($librairyCount): ?>
                        <?= $librairyCount ?>
                        <?php endif; ?>
                    </span>
                <?php endif; ?>
                </a>

                <?php if(count($item->child)): ?>
                    <ul class="Navbar__sublinks is-absolute is-margin-bottom-2-touch">
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

        <li class="Navbar__item Navbar__search Navbar__item--main is-relative no-shrink is-margin-bottom-4-touch">
            <button class="js-search is-flex"><span class="is-hidden-desktop">Rechercher</span><?= Svg::print('search') ?></button>
        </li>
    </ul>
</nav>

<div class="Navbar__search-overlay js-nav-search is-absolute has-background-white has-width-100 is-padding-top-3 is-padding-bottom-2 is-padding-top-2-touch is-padding-bottom-2-touch">
    <div class="container is-flex is-center">
        <?= Template::component('search', array('noIcon' => true, 'greige' => true)); ?>
        <button class="Navbar__search-close js-close-search no-shrink is-block cross"></button>
    </div>
</div>
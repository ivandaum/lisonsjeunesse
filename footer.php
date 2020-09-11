<?php
    use \Lisonsjeunesse\Constants\NetworksConstants;
    use \Lisonsjeunesse\Core\Utils\Menu;
    use \Lisonsjeunesse\Core\Utils\Text;
    use \Lisonsjeunesse\Core\Utils\Svg;

    $menu = Menu::get('footer');
?>
    </main>
    <footer class="Footer">
        <div class="container is-flex is-wrap">
            

            <div class="no-shrink is-3 is-column is-12-touch is-margin-bottom-3-touch">
                <a href="/" class="Navbar__logo is-block is-relative has-font-serif is-padding-bottom-2 is-margin-bottom-2 is-padding-bottom-2-touch is-margin-bottom-2-touch">
                    Lisons<br>Jeunesse !
                </a>
                <ul class="Footer__social is-flex">
                    <li class="is-margin-right-2 is-margin-right-2-touch"><a target="_blank" class="is-flex is-center facebook" href="<?= NetworksConstants::facebook ?>"><?= Svg::print('facebook') ?></a></li>
                    <li class="is-margin-right-2 is-margin-right-2-touch"><a target="_blank" style="padding-top: 0.2em;" class="is-flex is-center" href="<?= NetworksConstants::twitter ?>"><?= Svg::print('twitter') ?></a></li>
                    <li><a target="_blank" class="is-flex is-center" href="<?= NetworksConstants::instagram ?>"><?= Svg::print('instagram') ?></a></li>
                </ul>
            </div>


            <ul class="Footer__links is-flex is-column is-8 is-12-touch">
            <?php foreach($menu as $item): ?>
                <li class="Footer__links--item is-main">
                    <a class="has-text-bold" href="<?= $item->url ?>"><?= $item->title ?></a>
                </li>

                <?php if($item->child): ?>
                
                <li class="Footer__links--item">
                    <ul class="has-width-100 is-flex is-wrap">
                <?php foreach($item->child as $subitem): ?>
                    <li class="is-column is-6 is-6-touch">
                        <a href="<?= $subitem->url ?>"><?= $subitem->title ?></a>
                    </li>
                <?php endforeach; ?>
                    </ul>
                </li>
                <?php endif; ?>
            <?php endforeach; ?>
            </ul>
        </div>
    </footer>
    <div class="Loader is-fixed has-width-100 js-loader has-height-100"></div>
    <script src="<?= get_theme_file_uri('/dist/index.js?v=1');  ?>" type="text/javascript"></script>
</html>
</body>
</html>
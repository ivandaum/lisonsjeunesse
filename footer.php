<?php
    use \Lisonsjeunesse\Constants\NetworksConstants;
    use \Lisonsjeunesse\Core\Utils\Menu;
    use \Lisonsjeunesse\Core\Utils\Text;

    $menu = Menu::get('footer');
?>
    </main>
    <footer class="Footer">
        <div class="container is-flex is-wrap">
            <ul class="Footer__links">
            <?php foreach($menu as $item): ?>
                <li class="Footer__links--item">
                    <a class="has-text-bold" href="<?= $item->url ?>"><?= $item->title ?></a>
                </li>

                <?php if($item->child): ?>
                <?php foreach($item->child as $subitem): ?>
                    <li>
                        <a href="<?= $subitem->url ?>"><?= $subitem->title ?></a>
                    </li>
                <?php endforeach; ?>
                <?php endif; ?>
            <?php endforeach; ?>
            </ul>

            <div class="Footer__contact no-shrink">
                <div>
                    <h2 class="has-font-serif">Nos réseaux sociaux</h2>
                    <ul class="is-flex">
                        <li><a href="<?= NetworksConstants::facebook ?>">Facebook</a></li>
                        <li><a href="<?= NetworksConstants::twitter ?>">Twitter</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <script src="<?= get_theme_file_uri('/dist/index.js');  ?>" type="text/javascript"></script>
</html>
</body>
</html>
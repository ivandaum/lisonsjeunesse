<?php
namespace Humanoid\Core\Utils;

class Seo {
    public static function title() {
        $title = get_the_title();
        $name = bloginfo();

        if (is_front_page()) {
            return $name;
        }

        return $name . ' - ' . $title;
    }
}
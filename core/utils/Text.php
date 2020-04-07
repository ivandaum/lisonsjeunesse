<?php
namespace Lisonsjeunesse\Core\Utils;

class Text {
    public static function cleanWpEditor(string $html) {
        $html = preg_replace('/class=".*?"/', '', $html);
        return $html;
    }


    public static function slugify(string $string) {
        return strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', preg_replace('/\s+/', '', $string)));
    }

    public static function toJson($arr) {
        if (is_array($arr) || is_object($arr)) {
            return json_encode($arr);
        }

        return "{}";
    }

    public static function getExcerpt(string $str = null) {
        return substr(wp_strip_all_tags($str), 0, 120);
    }
}
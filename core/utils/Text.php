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

    public static function explodeToSpan(string $string) {
        $s = explode(' ', $string);
        $final = '';
        for($i = 0; $i < count($s); $i++) {
            $final .= '<span>' . $s[$i] . '</span>';
        }

        return $final;
    }

    public static function getExcerpt(string $string = null) {
        $excerpt = substr(wp_strip_all_tags($string), 0, 120) . '...';
        
        // preg_match('/<p (.*?)>(.*?)<\/p>/', $string, $paragraph);
        // if ($paragraph[2]) {
        //     $excerpt = wp_strip_all_tags($paragraph[2]);
        // }

        return str_replace('&nbsp;', '', $excerpt);
    }

    public static function getFirstLetter(string $string = null) {
        $string = str_replace(array('«', '"'), '', $string);
        $string = preg_replace('/\s+/', '', $string);
        return substr(wp_strip_all_tags($string), 0, 1);
    }

    public static function formatWpContent(string $string = null) {
        $string = preg_replace('/<p/', '<p class="first-of-content"', $string, 1);
        return $string;
    }
}
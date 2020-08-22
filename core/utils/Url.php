<?php
namespace Lisonsjeunesse\Core\Utils;
use \Lisonsjeunesse\Constants\TaxonomyConstants as TaxonomyConstants;

class Url {
    public static function isEmail(string $url) {
        return preg_match('/mailto:/', $url);
    }

    public static function isExternal(string $url) {
        return !preg_match('/http(s){0,1}:\/\/'.$_SERVER['SERVER_NAME'].'/', $url);
    }

    public static function printDomaine(string $url) {
        $url = preg_replace('/http(s){0,1}:\/\//', '', $url);
        $url = explode('/', $url)[0];
        return $url;
    }

    public static function getCurrent() {
        return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    }

    public static function getWithFilter($string) {
        $origin = explode('?', self::getCurrent());

        if (!$string) {
            return $origin[0];
        }

        return $origin[0]  . '?' . TaxonomyConstants::filter . '=' . $string;
    }

    public static function getRoot() {
        return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
    }

    public static function isActive(string $url) {
        $origin = explode('?', self::getCurrent());
        $current = $origin[0];

        if (get_query_var('paged')) {
            $current = preg_replace('/\/page\/[0-9]/', '', $current);
        }

        return $url === $current;
    }
}
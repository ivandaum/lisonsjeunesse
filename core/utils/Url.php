<?php
namespace Lisonsjeunesse\Core\Utils;

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

    public static function getRoot() {
        return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
    }

    public static function isActive(string $url) {
        $current = self::getCurrent();

        if (get_query_var('paged')) {
            $current = preg_replace('/\/page\/[0-9]/', '', $current);
        }

        return $url === $current;
    }
}
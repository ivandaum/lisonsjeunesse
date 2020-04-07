<?php
namespace Lisonsjeunesse\Core\Utils;

use Lisonsjeunesse\Core\Utils\Url;

class Pagination {
    public static function getUrl() {
        return preg_replace('/\/page\/[0-9]/', '', Url::getCurrent());
    }

    public static function getCurrentPage() {
        $paged = (int) get_query_var('paged');
        if ($paged === 0) {
            $paged = 1;
        }

        return $paged;
    }

    public static function getNextPage() {
        return self::getUrl() . '/page/' . (self::getCurrentPage() + 1);
    }

    public static function getPrevPage() {
        if (self::getCurrentPage() <= 2) {
            return self::getUrl();
        }

        return self::getUrl() . '/page/' . (self::getCurrentPage() - 1);
    }
}
<?php
namespace Humanoid\Core\Utils;

class Number {
    public static function isEven(int $number) {
        return $number % 2 === 0;
    }
}
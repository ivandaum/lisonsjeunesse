<?php
namespace Lisonsjeunesse\Core\Models;
use \Lisonsjeunesse\Core\Utils\Url;

class Taxonomy {
    public static function find(string $taxonomy) {
        return get_terms(array( 
            'taxonomy' => $taxonomy,
            'hide_empty' => false,
            'order' => 'ASC',
            'orderby' => 'ID'
        ));
    }

    public static function getById(int $id) {
        return self::format(array(get_category($id)))[0];
    }

    public static function getByParent(int $id) {
        return self::format(get_categories(array('parent' => $id)));
    }
    public static function format(array $categories) {
        $arr = array();
        foreach($categories as $category) {
            $temp = new \stdClass();
            $temp->id = $category->term_id;
            $temp->url = str_replace('category/', '', get_category_link($category));
            $temp->name = $category->name;
            $temp->slug = $category->slug;
            $temp->isActive = Url::isActive($temp->url);

            $arr[] = $temp;
        }

        return $arr;
    }
}
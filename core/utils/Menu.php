<?php
namespace Lisonsjeunesse\Core\Utils;
use \Lisonsjeunesse\Core\Models\Taxonomy;
use \Lisonsjeunesse\Core\Utils\Url;

class Menu {
    public static function get(string $string) {
        $locations = get_nav_menu_locations();
        $id = $locations[$string];
        $items = array();
        
        if (!isset($id)) {
            return array();
        }

        $objects = wp_get_nav_menu_items($id);

        if(!$objects) {
            return array();
        }

        foreach($objects as $object) {
            $item = new \stdClass();
            $item->title = $object->title;
            $item->url = str_replace('category/', '', $object->url);
            $item->id = (int) $object->object_id;
            $item->isExternal = Url::isExternal($object->url);
            $item->uniqueId = $object->object_id . '-' . rand(0, time());
            $item->isActive = $object->url === Url::getCurrent();
            $item->parent = (int) $object->post_parent;
            $item->child = array();
            $items[] = $item;
        }

        $menu = array();
        foreach($items as $i => $item) {
            if ($item->parent !== 0) {
                $index = self::getParent($item->parent, $menu);
                $menu[$index]->child[] = $item;
            } else {
                $menu[] = $item;
            }
        }

        return $menu;
    }

    public static function getParent($parentId, $menu) {
        foreach($menu as $k => $item) {
            if ($parentId === $item->id) {
                return $k;
            }
        }
    }
}
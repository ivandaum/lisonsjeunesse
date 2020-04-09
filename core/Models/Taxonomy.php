<?php
namespace Lisonsjeunesse\Core\Models;

use \Lisonsjeunesse\Core\Utils\Url;
use \Lisonsjeunesse\Constants\TaxonomyConstants;

class Taxonomy {
    public static function find(string $taxonomy) {
        return self::format( get_terms(array( 
            'taxonomy' => $taxonomy,
            'hide_empty' => false,
            'order' => 'ASC',
            'orderby' => 'name'
        )));
    }

    public static function findByPostId(int $id) {
        return self::format( get_the_category($id) );
    }

    public static function findBySlug(string $slug) {
        return self::format( array(get_term_by('slug', $slug, 'category')) )[0];
    }

    public static function findOneById(int $id) {
        if ($id === 0) {
            return new \stdClass();
        }

        return self::format( array(get_category($id)) )[0];
    }

    public static function findByParent(int $id) {
        return self::format(
            get_categories(
                array(
                    'parent' => $id,
                    'orderby' => 'name',
                    'order'   => 'ASC'
                )
            )
        );
    }

    public static function format(array $categories) {
        $arr = array();
        foreach($categories as $category) {
            $temp = new \stdClass();
            $temp->id = (int) $category->term_id;
            $temp->url = str_replace('/category', '', get_category_link($category));

            $temp->name = $category->name;
            $temp->slug = $category->slug;
            $temp->isActive = Url::isActive($temp->url);
            $temp->hasParent = (int) $category->parent !== 0;
            $temp->parent = self::findOneById($category->parent);
            $temp->mainCategory = self::getMainCategory($temp);
            $temp->haveMainCategory = $temp->mainCategory !== false;

            $arr[] = $temp;
        }

        return $arr;
    }

    static public function getMainCategory($category) {
        if (in_array($category->slug, TaxonomyConstants::mainCategories)) {
            return $category;
        }

        if ($category->hasParent && in_array($category->parent->slug, TaxonomyConstants::mainCategories)) {
            return $category->parent;
        }

        return false;
    }
}
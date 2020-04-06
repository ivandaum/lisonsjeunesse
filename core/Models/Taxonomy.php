<?php
namespace Lisonsjeunesse\Core\Models;
use \Lisonsjeunesse\Constants\Taxonomy as TaxonomyConstant;

class Taxonomy {
    public static function find(string $taxonomy) {
        return get_terms(array( 
            'taxonomy' => $taxonomy,
            'hide_empty' => false,
            'order' => 'ASC',
            'orderby' => 'ID'
        ));
    }

    public static function findOne(string $slug, string $taxonomy) {
        return get_terms(array( 
            'taxonomy' => $taxonomy,
            'hide_empty' => false,
            'slug' => $slug
        ));
    }

    public static function findByPostId(int $postId, string $taxonomy) {
        return get_the_terms($postId, $taxonomy);
    }
}
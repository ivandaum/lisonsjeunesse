<?php
namespace Lisonsjeunesse\Core\Layouts;

use \Lisonsjeunesse\Core\Models\Post;
use \Lisonsjeunesse\Core\Models\Taxonomy;
use \Lisonsjeunesse\Constants\TaxonomyConstants;

class Home {
    public function __construct() {

        $this->mainCategory = Taxonomy::findBySlug( TaxonomyConstants::genre );
        $this->categories = Taxonomy::findByParent($this->mainCategory->id);
        $this->posts = array();
        $posts = array();
        $ids = array();
        foreach($this->categories as $k => $category) {
            $this->posts[] = Post::findByCategory($category->id, 1, 1, 0, $ids)[0];
            $ids[] = $this->posts[$k]->id;
        }

        uasort($this->posts, function($a, $b) {
            return $b->timestamp - $a->timestamp;
        });


    }
}

<?php
namespace Lisonsjeunesse\Core\Layouts;

use \Lisonsjeunesse\Core\Models\Post;
use Lisonsjeunesse\Core\Models\Taxonomy;

class Category {
    public function __construct() {
        $cat = get_queried_object();
        $this->id = (int) $cat->term_id;
        $this->name = $cat->name;
        $this->slug = $cat->slug;
        $this->hasParent = (int) $cat->parent !== 0;
        $this->parent = null;

        if ($this->hasParent) {
            $this->parent = Taxonomy::getById($cat->parent);
            $this->subCategories = Taxonomy::getByParent($cat->parent);
        } else {
            $this->subCategories =  Taxonomy::getByParent($this->id);
        }

        $this->isMainCategory = $this->isMainCategory();
        $this->posts = Post::findByCategory($this->id, 12);
    }

    public function isMainCategory() {
        $main = array('genre', 'age');

        if (in_array($this->slug, $main)) {
            return true;
        }

        if ($this->hasParent) {
            return in_array($this->parent->slug, $main);
        }

        return false;
    }
}

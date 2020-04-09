<?php
namespace Lisonsjeunesse\Core\Layouts;

use \Lisonsjeunesse\Core\Models\Post;
use \Lisonsjeunesse\Core\Models\Taxonomy;

class Category {
    public function __construct() {
        $category = get_queried_object();

        $data = Taxonomy::format( array($category) )[0];

        foreach($data as $name => $value) {
            $this->{$name} = $value;
        }

        $this->posts = Post::findByCategory($this->id, 0, get_query_var('paged'));

        if ($this->hasParent) {
            $this->subCategories = Taxonomy::findByParent($this->parent->id);
        } else {
            $this->subCategories = Taxonomy::findByParent($this->id);
        }
    }
}

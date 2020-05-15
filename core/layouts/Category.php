<?php
namespace Lisonsjeunesse\Core\Layouts;

use \Lisonsjeunesse\Core\Models\Post;
use \Lisonsjeunesse\Core\Models\Taxonomy;

class Category {
    public function __construct($count = 0, $offset = 0) {
        $category = get_queried_object();

        $data = Taxonomy::format( array($category) )[0];

        $this->page = get_query_var('paged');
        if ($this->page === 0) {
            $this->page = 1;
        }

        $this->count = $count;
        $this->offset = $offset;

        foreach($data as $name => $value) {
            $this->{$name} = $value;
        }

        $this->posts = Post::findByCategory($this->id, $this->count, $this->page, $this->offset);

        if ($this->hasParent) {
            $this->subCategories = Taxonomy::findByParent($this->parent->id);
        } else {
            $this->subCategories = Taxonomy::findByParent($this->id);
        }
    }
    
    public function getAjaxParams() {
        $params = array(
            'cat' => $this->id,
            'page' => $this->page + 1
        );

        return $params;
    }
}

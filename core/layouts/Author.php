<?php
namespace Lisonsjeunesse\Core\Layouts;

use \Lisonsjeunesse\Core\Models\Post;
use \Lisonsjeunesse\Core\Models\Taxonomy;
use \Lisonsjeunesse\Constants\TaxonomyConstants as TaxonomyConstants;

class Author {
    public function __construct($count = 0, $offset = 0) {
        $author = get_queried_object();

        $this->name = $author->display_name;
        $this->id = $author->ID;

        $this->page = get_query_var('paged');
        if ($this->page === 0) {
            $this->page = 1;
        }

        $this->count = $count;
        $this->offset = $offset;
        $this->posts = Post::findByAuthor($author->ID, $this->count, $this->page, $this->offset);
    }
    
    public function getAjaxParams() {
        $params = array(
            'author' => $this->id,
            'page' => $this->page + 1
        );

        return $params;
    }
}

<?php
namespace Lisonsjeunesse\Core\Layouts;

use \Lisonsjeunesse\Core\Models\Post;

class Search {
    public function __construct($search = '') {
        $this->value = $search;
        $this->hasValue = strlen(trim($search)) > 0;

        $this->posts = array();
        if ($this->hasValue) {
            $this->posts = Post::search($this->value);
        }
    }
}

<?php
namespace Lisonsjeunesse\Core\Layouts;

use \Lisonsjeunesse\Core\Models\Post;
use \Lisonsjeunesse\Core\Models\Taxonomy;

class Single {
    public function __construct() {
        global $post;

        $data = Post::findOne($post->ID);

        foreach($data as $name => $value) {
            $this->{$name} = $value;
        }

        $this->comments = get_comments(array('post_id' => $this->id));
        $this->posts = Post::findRelatedPost($this->id);
    }
}

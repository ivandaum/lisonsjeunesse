<?php
namespace Lisonsjeunesse\Core\Layouts;

use \Lisonsjeunesse\Core\Models\Post;

class About {
    public function __construct() {
        global $post;

        $data = Post::findOne($post->ID);

        foreach($data as $name => $value) {
            $this->{$name} = $value;
        }

        $this->team = get_field('about__team', $post->ID);
        $this->introduction = get_field('about__introduction', $post->ID);
    }
}

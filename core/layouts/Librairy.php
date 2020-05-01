<?php
namespace Lisonsjeunesse\Core\Layouts;

use \Lisonsjeunesse\Core\Models\Post;

class Librairy {
    public function __construct() {
        $this->posts = array();
        $this->title = get_the_title();

        $ids = array();
        if(isset($_COOKIE['librairy'])) {
            $ids = json_decode(str_replace('\"','"', $_COOKIE['librairy']));
        }

        foreach($ids as $id) {
            $this->posts[] = Post::findOne($id);
        }
    }
}

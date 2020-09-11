<?php
namespace Lisonsjeunesse\Core;

use \Lisonsjeunesse\Core\Models\Post;
use \Lisonsjeunesse\Core\Utils\Template;

class Ajax {
    public function __construct() {
        add_action( 'wp_ajax_load_posts', array($this, 'onLoadPosts'));
        add_action( 'wp_ajax_nopriv_load_posts', array($this, 'onLoadPosts'));
    }

    public function onLoadPosts() {
        $cat = isset($_POST['cat']) ? (string) $_POST['cat'] : null;
        $page = isset($_POST['page']) ? (int) $_POST['page'] : null;
        $offset = isset($_POST['offset']) ? (int) $_POST['offset'] : 0;
        $author = isset($_POST['author']) ? (string) $_POST['author'] : null;

        $posts = array();
        
        $cat = explode(',', $cat);

        if(!$cat) {
            $this->toJson(array('success' => false, 'error' => 'missing_cat_id'));
        }
        
        $page = $page ? $page : 1;
        $count = get_option('posts_per_page');

        if ($author) {
            $posts = Post::findByAuthor($author, $count, $page, $offset);
        } else {
            $posts = Post::findByCategories($cat, $count, $page, $offset);
        }
        
        $html = Template::layout('posts', array('posts' => $posts, 'noPagination' => true));

        if(is_array($posts)) {
            $loadMore = count($posts) >= $count;
        } else {
            $loadMore = false;
        }

        $this->toJson(array('loadMore' => $loadMore, 'success' => true, 'html' => $html)); 
    }

    public function toJson($data) {
        echo json_encode($data);
        exit();
    }
}


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
        $cat = isset($_POST['cat']) ? (int) $_POST['cat'] : null;
        $page = isset($_POST['page']) ? (int) $_POST['page'] : null;
        $offset = isset($_POST['offset']) ? (int) $_POST['offset'] : 0;

        $posts = array();
        
        if(!$cat) {
            $this->toJson(array('success' => false, 'error' => 'missing_cat_id'));
        }
        
        $page = $page ? $page : 1;
        $count = get_option('posts_per_page');
        $posts = Post::findByCategory($cat, $count, $page, $offset);

        $html = Template::layout('posts', array('posts' => $posts, 'noPagination' => true));
        $html = utf8_decode($html);

        $loadMore = count($posts) >= $count;
        $this->toJson(array('loadMore' => $loadMore, 'success' => true, 'html' => utf8_encode($html))); 
    }

    public function toJson($data) {
        // header('Content-Type: application/json; charset=utf-8');
        // header('Content-type: application/json; charset=utf-8');
        echo json_encode($data, true);
        die;
    }
}


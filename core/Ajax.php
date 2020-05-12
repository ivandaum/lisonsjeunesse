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

        $posts = array();
        
        if(!$cat) {
            $this->toJson(array('success' => false, 'error' => 'missing_cat_id'));
        }
        
        $page = $page ? $page : 1;
        $posts = Post::findByCategory($cat, get_option('posts_per_page'), $page);
        $html = Template::layout('posts', array('posts' => $posts, 'noPagination' => true));
        $html = mb_convert_encoding($html, 'ISO-8859-1', 'UTF-8');
        
        $this->toJson(array('success' => true, 'html' => utf8_encode($html))); 
    }

    public function toJson($data) {
        echo json_encode($data);
        die;
    }
}


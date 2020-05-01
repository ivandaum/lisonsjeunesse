<?php

namespace Lisonsjeunesse\Core;

use Lisonsjeunesse\Core\Layouts\Newsletter;

class Ajax {
    public static $passwordIsValid = false;

    public function __construct() {
        add_action( 'wp_ajax_loadPosts', array($this, 'onLoadPosts'));
        add_action( 'wp_ajax_nopriv_loadPosts', array($this, 'onLoadPosts'));

    }

    public function onLoadPosts() {
        $this->toJson(array('success' => $_POST));
    }

    public function toJson($data) {
        echo json_encode($data);
        die;
    }
}


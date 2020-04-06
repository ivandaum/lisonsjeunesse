<?php

namespace Lisonsjeunesse\Core;

use Lisonsjeunesse\Core\Layouts\Newsletter;

class Ajax {
    public static $passwordIsValid = false;

    public function __construct() {
        add_action( 'wp_ajax_submitNewsletter', array($this, 'onNewsletterSubmit'));
        add_action( 'wp_ajax_nopriv_submitNewsletter', array($this, 'onNewsletterSubmit'));
    }

    public function onNewsletterSubmit() {
        if (!isset($_POST['pageId'])) {
            $this->toJson(array('error' => 'missing_id'));
        }

        $pageId = $_POST['pageId'];

        if (!isset($_POST['password'])) {
            $this->toJson(array('error' => 'missing_password'));
        }
        
        $password = $_POST['password'];
        $newsletter = new Newsletter($pageId);

        if (!$newsletter->checkPassword($password)) {
            $this->toJson(array('error' => 'wrong_password'));
        }

        if (isset($_POST['step'])) {
            $step = $_POST['step'];
            switch($step) {
                case 'subscribe':
                    if (!isset($_POST['email'])) {
                        $this->toJson(array('error' => 'missing_email'));
                    } else {
                        $this->toJson($newsletter->checkEmail($_POST['email']));
                    }
                break;
                case 'password':
                    $this->toJson($newsletter->getSubscribeTemplate());
                break;
                default:
                $this->toJson(array('error' => 'wrong_step'));
                break;
            }
            die;
        }

        $this->toJson(array('error' => 'undefined_error'));
    }

    public function toJson($data) {
        $step = null;
        if (isset($_POST['step'])) {
            $step = $_POST['step'];
        }

        echo json_encode(array_merge($data, array('step' => $step)));
        die;
    }
}


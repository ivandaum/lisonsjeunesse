<?php
namespace Lisonsjeunesse\Core\Models;

use \Lisonsjeunesse\Core\Utils\Text;

class Post {
    public static function find(int $count = 6, int $paged = 0) {
        $query = new \WP_Query(array(
            'posts_per_page' => $count,
            'status' => 'publish',
            'fields' => 'ids',
            'paged' => $paged,
            'orderby' => 'date',
            'order' => 'DESC',
        ));

        return self::format($query->posts);
    }
    public static function count() {
        $query = new \WP_Query(array(
            'posts_per_page' => 1,
            'status' => 'publish',
            'fields' => 'ids',
        ));

        return $query->found_posts;
    }

    public static function findByCategory(int $catId = null, int $count = 6, int $paged = 0) {

        $query = new \WP_Query(array(
            'posts_per_page' => $count,
            'cat' => $catId,
            'status' => 'publish',
            'fields' => 'ids',
            'paged' => $paged,
            'orderby' => 'date',
            'order' => 'DESC',
        ));

        return self::format($query->posts);
    }

    public static function findBut(array $ids = array(), int $count = 6) {
        $query = new \WP_Query(array(
            'posts_per_page' => $count,
            'status' => 'publish',
            'fields' => 'ids',
            'post__not_in' => $ids,
            'orderby' => 'date',
            'order' => 'DESC',
        ));

        return self::format($query->posts);
    }

    public static function findOne(int $id) {
        return self::format(array($id))[0];
    }

    public static function format(array $ids) {

        if (!count($ids)) {
            return array();
        }
        $arr = array();
        foreach($ids as $id) {
            $p = get_post($id);
            $temp = new \stdClass();
            $temp->id = $id;
            $temp->title = $p->post_title;
            $temp->content = apply_filters('the_content', $p->post_content);
            $temp->excerpt = Text::getExcerpt($temp->content);
            $temp->link = get_permalink($id);
            $temp->date = get_the_date('d/m/Y', $id);
            $temp->previewImage = (int) get_post_thumbnail_id($id);
            $temp->categories = get_the_category($id);
            $temp->mainCategory = $temp->categories[0];

            $temp->readTime = rand(3, 10);
            $author = new \stdClass();
            $author->url = get_author_posts_url($p->post_author);
            $author->name = get_userdata($p->post_author)->display_name;
            $author->userdata = get_userdata($p->post_author);

            $temp->author = $author;
            $arr[] = $temp;
        }

        return $arr;
    }
}

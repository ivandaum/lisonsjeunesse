<?php
namespace Humanoid\Core\Models;

class Post {
    const subtitle = 'post__subtitle';
    const introduction = 'post__introduction';

    public static function find(int $count = -1, int $paged = 0, $orderBy = 'date (post_date)') {
        $query = new \WP_Query(array(
            'posts_per_page' => $count,
            'status' => 'publish',
            'fields' => 'ids',
            'paged' => $paged,
            'orderby' => $orderBy
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

    public static function findBut(array $ids = array(), int $count = -1, $orderBy = 'date (post_date)') {
        $query = new \WP_Query(array(
            'posts_per_page' => $count,
            'status' => 'publish',
            'fields' => 'ids',
            'post__not_in' => $ids,
            'orderby' => $orderBy
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
            $temp->title = $p->post_title;
            $temp->subtitle = get_field(self::subtitle, $id);
            $temp->introduction = get_field(self::introduction, $id);
            $temp->content = apply_filters('the_content', $p->post_content);
            $temp->link = get_permalink($id);
            $temp->date = get_the_date('d/m/Y', $id);
            $temp->previewImage = (int) get_post_thumbnail_id($id);
            $arr[] = $temp;
        }

        return $arr;
    }
}

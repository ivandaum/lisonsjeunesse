<?php
namespace Lisonsjeunesse\Core\Models;

use \Lisonsjeunesse\Core\Utils\Text;
use \Lisonsjeunesse\Core\Models\Taxonomy;
use \Lisonsjeunesse\Constants\TaxonomyConstants;

class Post {
    public static function find(int $count = 0, int $paged = 0) {
        if (!$count) {
            $count = get_option('posts_per_page');
        }

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

    public static function findRelatedPost(int $id, int $count = 3) {
        $query = new \WP_Query(array(
            'posts_per_page' => $count,
            'status' => 'publish',
            'fields' => 'ids',
            'orderby' => 'rand',
        ));

        return self::format($query->posts);
    }

    public static function findByCategory(int $catId = null, int $count = 0, int $paged = 0, $notIn = array()) {
        if (!$count) {
            $count = get_option('posts_per_page');
        }

        $query = new \WP_Query(array(
            'posts_per_page' => $count,
            'cat' => $catId,
            'status' => 'publish',
            'fields' => 'ids',
            'post__not_in' => $notIn,
            'paged' => $paged,
            'orderby' => 'date',
            'order' => 'DESC',
        ));

        return self::format($query->posts);
    }

    public static function findBut(array $ids = array(), int $count = 0) {
        if (!$count) {
            $count = get_option('posts_per_page');
        }

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
            $temp->content = Text::formatWpContent($temp->content);
            $temp->excerpt = Text::getExcerpt($temp->content);
            $temp->link = get_permalink($id);
            $temp->date = get_the_date('d/m/Y', $id);
            $temp->timestamp = strtotime(str_replace('/', '-', $temp->date));
            $temp->previewImage = (int) get_post_thumbnail_id($id);
            $temp->categories = Taxonomy::findByPostId($id);
            $temp->mainCategory = self::getMainCategory($temp->categories);
            
            $temp->isLiked = false;
            if(isset($_COOKIE['librairy'])) {
                $ids = json_decode(str_replace('\"','"', $_COOKIE['librairy']));
                $temp->isLiked = in_array($id, $ids);
            }

            $temp->readTime = round(count(explode(' ', strip_tags($temp->content))) / 200);
            $author = new \stdClass();
            $author->url = get_author_posts_url($p->post_author);
            $author->name = get_userdata($p->post_author)->display_name;
            $author->userdata = get_userdata($p->post_author);

            $temp->author = $author;
            $arr[] = $temp;
        }

        return $arr;
    }

    public static function getMainCategory(array $categories) {
        foreach($categories as $category) {
            if ($category->hasParent && $category->parent->slug === TaxonomyConstants::genre) {
                return $category;
            }
        }

        return null;
    }
}

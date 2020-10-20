<?php
namespace Lisonsjeunesse\Core\Layouts;

use \Lisonsjeunesse\Core\Models\Post;
use \Lisonsjeunesse\Core\Models\Taxonomy;
use \Lisonsjeunesse\Constants\TaxonomyConstants as TaxonomyConstants;

class Category {
    public function __construct($count = 0, $offset = 0) {
        $category = get_queried_object();
        
        $data = Taxonomy::format( array($category) )[0];

        $this->page = get_query_var('paged');
        if ($this->page === 0) {
            $this->page = 1;
        }

        $this->count = $count;
        $this->offset = $offset;

        foreach($data as $name => $value) {
            $this->{$name} = $value;
        }

        $categories = array($this->id);
        if(isset($_GET[TaxonomyConstants::filter])) {
            if($this->mainCategory->id === $this->id) $categories = array();

            $slug = $_GET[TaxonomyConstants::filter];
            $tax = Taxonomy::findBySlug($slug);
            if ($tax->id) $categories[] = $tax->id;
        }
        
        $this->posts = Post::findByCategories($categories, $this->count, $this->page, $this->offset);

        if ($this->hasParent) {
            $this->subCategories = Taxonomy::findByParent($this->parent->id);
        } else {
            $this->subCategories = Taxonomy::findByParent($this->id);
        }

        $this->filters = [];
        if($this->haveMainCategory) {
            $slug = TaxonomyConstants::age === $this->mainCategory->slug ? TaxonomyConstants::genre : TaxonomyConstants::age;
            $filtersParent = Taxonomy::findBySlug($slug);
            if ($filtersParent->id) {
                $this->filters = Taxonomy::findByParent($filtersParent->id);
            }
        }

        uasort($this->filters, array($this, 'sortCatByNames'));
        uasort($this->subCategories, array($this, 'sortCatByNames'));
    }

    public static function sortCatByNames($a, $b) {
        return strnatcmp(str_replace('-', '', $a->slug), str_replace('-','', $b->slug));
    }
    
    public function getAjaxParams() {
        $params = array(
            'cat' => array($this->id),
            'page' => $this->page + 1
        );

        if(isset($_GET[TaxonomyConstants::filter])) {
            $slug = $_GET[TaxonomyConstants::filter];
            $tax = Taxonomy::findBySlug($slug);

            if ($tax->id) $params['cat'][] = $tax->id;
        }

        return $params;
    }
}

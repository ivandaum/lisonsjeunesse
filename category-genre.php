<?php
    use \Lisonsjeunesse\Core\Utils\Template;
    use \Lisonsjeunesse\Core\Layouts\Category;

    $category = new Category();
    get_header(); 
    Template::layout('category/genre', array('category' => $category));

    get_footer();
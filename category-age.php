<?php
    use \Lisonsjeunesse\Core\Utils\Template;
    use \Lisonsjeunesse\Core\Layouts\Category;

    $category = new Category();
    get_header(); 
    Template::layout('category/age', array('category' => $category)); 

    get_footer();
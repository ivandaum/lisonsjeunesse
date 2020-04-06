<?php
    use \Humanoid\Core\Utils\Template;
    $count = isset($count) ? $count : 3;
    $paged = get_query_var('paged');
    $options = isset($options) && is_array($options) ? $options : array();
    $posts = isset($posts) && count($posts) ? $posts : \Humanoid\Core\Models\Post::find($count, $paged);
?>
<div class="LastPosts columns is-multiline">
    <?php foreach($posts as $post): ?>
    <div class="column is-4 js-animation-item">
        <?php Template::component('preview/post', array('post' => $post, 'options' => $options)); ?>
    </div>
    <?php endforeach; ?>
    
    <?php if (isset($pagination)): ?>
        <div class="column is-12">
            <?php Template::component('pagination', array('max' =>  \Humanoid\Core\Models\Post::count(), 'count' => $count)); ?>
        </div>
    <?php endif; ?>
</div>
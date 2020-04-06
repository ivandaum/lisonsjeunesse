<?php
    use \Lisonsjeunesse\Core\Utils\Template;
?>
<div class="LastPosts is-flex is-wrap">
    <?php foreach($posts as $post): ?>
    <div class="is-column is-4">
        <?php Template::component('preview/post', array('post' => $post)); ?>
    </div>
    <?php endforeach; ?>
</div>
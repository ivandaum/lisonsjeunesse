<?php
  $paged = get_query_var('paged');
  $pagination = new \Humanoid\Core\Utils\Pagination($count, $max, $paged);
?>
<div class="columns is-mobile is-left-x">
    <?php foreach($pagination->pages as $num): ?>
      <a 
        class="is-narrow is-2-mobile column is-size-3 <?php if ($pagination->paged === $num): ?>has-color-humanoid-orange<?php endif; ?>"
        href="<?= $pagination->baseUrl ?><?php if($num > 1): ?>page/<?= $num ?><?php endif; ?>"
      >
        <?= $num ?></a>
    <?php endforeach; ?>
</div>
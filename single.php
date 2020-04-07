<?php
    use \Lisonsjeunesse\Core\Utils\Image; 
    use \Lisonsjeunesse\Core\Utils\Svg; 
    use \Lisonsjeunesse\Core\Utils\Text; 
    use \Lisonsjeunesse\Core\Utils\Template; 
    use \Lisonsjeunesse\Core\Layouts\Single;
    
    $single = new Single();

    get_header(); 
?>
    <article class="Single" data-router-view="single">
        <div class="container is-flex is-justified">
            <div class="Single__left is-column is-3 no-shrink">
                <?php if ($single->previewImage): ?>
                    <div class="Single__image is-relative is-block has-width-100 is-sticky">
                        <?= Image::create($single->previewImage); ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="Single__right is-column is-7 no-shrink is-relative">
                <p class="is-first-letter is-absolute"><?= Text::getFirstLetter($single->title) ?></p>
                <h1 class="Single__title is-margin-top-5 is-relative"><?= $single->title ?></h1>
                <div class="Single__content is-relative wp-content">
                    <?= $single->content ?>
                </div>
                
                <div class="Single__footer is-flex is-justified">
                    <button class="is-flex is-center"><?= Svg::print('like'); ?> Ajouter à ma bibliothèque</button>
                    <span class="no-shrink"><?= $single->date ?> par <a href="<?= $single->author->url ?>"><?= $single->author->name ?></a></span>
                </div>

                <div class="Single__comments">
                    <h2 class="Single__comments--title is-secondary-title is-flex is-center-y">Avis de lecteurs</h2>
                    <ul>
                        <?php foreach($single->comments as $comment): ?>
                        <li class="Single__comment" id="comment-<?= $comment->comment_ID ?>">
                            <p class="is-margin-bottom-2"><strong><?= $comment->comment_author ?></strong></p>
                            <p><?= $comment->comment_content ?></p>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="Single__comments--form is-margin-top-3">
                        <p class="is-margin-bottom-3"><strong>Rédiger un commentaire</strong></p>
                        <?php comment_form(array(), $single->id); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="Single__relatedPosts has-background-white">
            <div class="container">
                <h2 class="is-secondary-title is-flex is-center-y">À lire aussi</h2>
                <?php Template::layout('posts', array('noPagination' => true, 'posts' => $single->posts)); ?>
            </div>
        </div>
    </article>
<?php get_footer(); ?>
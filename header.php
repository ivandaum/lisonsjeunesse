<?php global $post;?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?= get_theme_file_uri('/dist/index.css?v=1') ?>" rel="stylesheet">
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <?php do_action('wp_head'); ?>
    <meta property="og:image" content="<?= wp_get_attachment_url(get_post_thumbnail_id($post->ID)) ?>" />
    <meta property="og:image:secure_url" content="<?= wp_get_attachment_url(get_post_thumbnail_id($post->ID)) ?>" />
    <link rel="apple-touch-icon" sizes="57x57" href="<?= get_theme_file_uri('assets/images/favico/apple-icon-57x57.png') ?>">
    <link rel="apple-touch-icon" sizes="60x60" href="<?= get_theme_file_uri('assets/images/favico/apple-icon-60x60.png') ?>">
    <link rel="apple-touch-icon" sizes="72x72" href="<?= get_theme_file_uri('assets/images/favico/apple-icon-72x72.png') ?>">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= get_theme_file_uri('assets/images/favico/apple-icon-76x76.png') ?>">
    <link rel="apple-touch-icon" sizes="114x114" href="<?= get_theme_file_uri('assets/images/favico/apple-icon-114x114.png') ?>">
    <link rel="apple-touch-icon" sizes="120x120" href="<?= get_theme_file_uri('assets/images/favico/apple-icon-120x120.png') ?>">
    <link rel="apple-touch-icon" sizes="144x144" href="<?= get_theme_file_uri('assets/images/favico/apple-icon-144x144.png') ?>">
    <link rel="apple-touch-icon" sizes="152x152" href="<?= get_theme_file_uri('assets/images/favico/apple-icon-152x152.png') ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= get_theme_file_uri('assets/images/favico/apple-icon-180x180.png') ?>">
    <link rel="icon" type="image/png" sizes="192x192"  href="<?= get_theme_file_uri('assets/images/favico/android-icon-192x192.png') ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= get_theme_file_uri('assets/images/favico/favicon-32x32.png') ?>">
    <link rel="icon" type="image/png" sizes="96x96" href="<?= get_theme_file_uri('assets/images/favico/favicon-96x96.png') ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= get_theme_file_uri('assets/images/favico/favicon-16x16.png') ?>">
    <link rel="manifest" href="<?= get_theme_file_uri('assets/images/favico/manifest.json') ?>">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png') ?>">
    <meta name="theme-color" content="#ffffff">

    <script type="text/javascript">
        var ajaxUrl = "<?= admin_url( 'admin-ajax.php' ) ?>";
    </script>
</head>
<body <?php body_class() ?>>
<?= \Lisonsjeunesse\Core\Utils\Template::partial('navbar'); ?>
<main data-router-wrapper>
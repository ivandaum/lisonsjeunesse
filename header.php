<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?= get_theme_file_uri('/dist/index.css') ?>" rel="stylesheet">
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <?php do_action('wp_head'); ?>
    <script type="text/javascript">
        var ajaxUrl = "<?= admin_url( 'admin-ajax.php' ) ?>";
    </script>
</head>
<body <?php body_class() ?>>
<?= \Lisonsjeunesse\Core\Utils\Template::partial('navbar'); ?>
<main data-router-wrapper>
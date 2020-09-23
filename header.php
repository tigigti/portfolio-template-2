<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title><?php bloginfo("name");?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" sizes="57x57" href="<?php echo(get_template_directory_uri() . "/img/favicon/apple-icon-57x57.png");?>">
        <link rel="apple-touch-icon" sizes="60x60" href="<?php echo(get_template_directory_uri() ."/img/favicon/apple-icon-60x60.png");?>">
        <link rel="apple-touch-icon" sizes="72x72" href="<?php echo(get_template_directory_uri() ."/img/favicon/apple-icon-72x72.png");?>">
        <link rel="apple-touch-icon" sizes="76x76" href="<?php echo(get_template_directory_uri() ."/img/favicon/apple-icon-76x76.png");?>">
        <link rel="apple-touch-icon" sizes="114x114" href="<?php echo(get_template_directory_uri() ."/img/favicon/apple-icon-114x114.png");?>">
        <link rel="apple-touch-icon" sizes="120x120" href="<?php echo(get_template_directory_uri() ."/img/favicon/apple-icon-120x120.png");?>">
        <link rel="apple-touch-icon" sizes="144x144" href="<?php echo(get_template_directory_uri() ."/img/favicon/apple-icon-144x144.png");?>">
        <link rel="apple-touch-icon" sizes="152x152" href="<?php echo(get_template_directory_uri() ."/img/favicon/apple-icon-152x152.png");?>">
        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo(get_template_directory_uri() ."/img/favicon/apple-icon-180x180.png");?>">
        <link rel="icon" type="image/png" sizes="192x192"  href="<?php echo(get_template_directory_uri() ."/img/favicon/android-icon-192x192.png");?>">
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo(get_template_directory_uri() ."/img/favicon/favicon-32x32.png");?>">
        <link rel="icon" type="image/png" sizes="96x96" href="<?php echo(get_template_directory_uri() ."/img/favicon/favicon-96x96.png");?>">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo(get_template_directory_uri() ."/img/favicon/favicon-16x16.png");?>">
        <!-- <link rel="manifest" href="<?php echo(get_template_directory_uri() ."/img/favicon/manifest.json");?>"> -->
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="<?php echo(get_template_directory_uri() ."/img/favicon/ms-icon-144x144.png");?>">
        <meta name="theme-color" content="#ffffff">
        <!-- Place favicon.ico in the root directory -->
        <!--    This code is necessary to trigger the wp_enqueue_scripts action
                good lord.... -->
        <?php wp_head();?>
    </head>
    <body>
        <script type="text/javascript">
            // Necessary for Ajax Requests
            var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
        </script>
            
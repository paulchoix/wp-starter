<?php
namespace Starter_Theme\Header;
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <title><?php wp_title( '&gt;' ); ?></title>

  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="" />
  <meta name="keywords" content="" />
  <meta name="theme-color" content="#fff" />

  <link rel="manifest" href="site.webmanifest" />
  <link rel="apple-touch-icon" href="icon.png" />
  <!-- Place favicon.ico in the root directory -->

  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="page">
<header class="header">
    <?php 
    // Fix menu overlap
    if ( is_admin_bar_showing() ) echo '<div style="min-height: 32px;"></div>'; 
    ?>
</header>
<?php
namespace Starter_Theme\Header;
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<?php include_once( 'head.php' ); ?>

<body <?php body_class(); ?>>
<div id="page" class="page">
<header class="header">
    <?php 
    // Fix menu overlap
    if ( is_admin_bar_showing() ) echo '<div style="min-height: 32px;"></div>'; 
    ?>
</header>
<?php

namespace Starter_Theme\Search;

/*
Template Name: Search Form
*/

// Retrieve using get_search_form();

?>

<form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
    <input type="text" name="s" placeholder="<?php _e('Search', 'starter-theme'); ?>" />
</form>
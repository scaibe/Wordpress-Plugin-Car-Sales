<?php 

function gallery_metabox_enqueue($hook) {
    if ( 'post.php' == $hook || 'post-new.php' == $hook ) {
        wp_enqueue_script('gallery-metabox', '/wp-content/plugins/' . PLUGIN_NAME . '/assets/admin/gallery/js/gallery-metabox.js', array('jquery', 'jquery-ui-sortable'),'',true);
        wp_enqueue_style('gallery-metabox', '/wp-content/plugins/' . PLUGIN_NAME . '/assets/admin/gallery/css/gallery-metabox.css');
    }
}

function feature_metabox_enqueue($hook) {
    if ( 'post.php' == $hook || 'post-new.php' == $hook ) {
        wp_enqueue_style('feature-metabox', '/wp-content/plugins/' . PLUGIN_NAME . '/assets/admin/feature/css/feature-metabox.css');
    }
}

function add_splide_enqueue(){
    if(is_singular('auto')) {
        wp_dequeue_style('kadence-splide');
        wp_enqueue_style('splide','https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css','','');
        wp_enqueue_script('splide', 'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js', '', '', true);
    }
}

function add_scutom_style_and_script() {
    wp_enqueue_script('jwebcarsales','/wp-content/plugins/' . PLUGIN_NAME . '/assets/js/jwebcarsales.js', '', '', true);
    wp_enqueue_style('jwebcarsales','/wp-content/plugins/' . PLUGIN_NAME . '/assets/css/jwebcarsales.css', '', '');
}


?>
<?php
/**
* Plugin name:       Jweb Gestione Auto in Vendita
* Description:       Inserimento e gestione auto con inserimento dati vettura
* Version:           1.0
* Requires PHP:      7.2
* Author:            Jweb Studio - Marin Luca
* License:           GPL v2 or later
* License URI:       https://www.gnu.org/licenses/gpl-2.0.html
*/

define('PLUGIN_NAME', 'jweb-carsales');

require_once('inc/init-carsales.php');
require_once('inc/metabox-carsales.php');
require_once('inc/assets-carsales.php');

/* Init Post Type and Taxonomy Auto */
add_action('init','add_post_type_carsales');
add_action('init','add_taxonomy_auto_carsales', 0);


/* Init Metabox Auto */
add_action( 'admin_init', 'init_metabox_gallery_carsales' );

/* Hook Processing Metabox */
add_action('save_post', 'gallery_meta_save');
add_action('save_post', 'feature_meta_save');

/* Init Assets */
add_action('admin_enqueue_scripts', 'gallery_metabox_enqueue'); // for gallery car
add_action('admin_enqueue_scripts', 'feature_metabox_enqueue'); // for feature car
add_action('wp_enqueue_scripts','add_scutom_style_and_script');
add_action('wp_enqueue_scripts','add_splide_enqueue', 50);


/* Filter the single_template with our custom function*/
add_filter('single_template', 'my_custom_template');

function my_custom_template($single) {

    global $post;

    if ( $post->post_type == 'auto' ) {
        return __DIR__ . '/template/single-auto.php';
    }

    return $single;

}

function widget_list_marchi() {

    $terms = get_terms( 'auto-brand', array('hide_empty' => true));
    ?>
    <div class="widget-list-brand">
    <?php
    foreach($terms as $item) : ?>
        <?php $term_image = get_term_meta($item->term_id, 'kwp-tax-image-id', true); ?>
        <div class="item-brand" data-autobrand="<?php echo $item->slug; ?>">
            <div class="image"><?php echo wp_get_attachment_image( $term_image, 'large', array('class' => 'alignnone')); ?></div>
            <div class="brand-name"><?php echo $item->name; ?></div>
            <div class="count"><?php echo $item->count; ?></div>
        </div>
    <?php endforeach; ?>    
    </div>
    <?php
}

add_shortcode('list_marchi','widget_list_marchi');


?>
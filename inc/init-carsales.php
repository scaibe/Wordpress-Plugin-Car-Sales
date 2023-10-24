<?php 

function add_post_type_carsales() {

    // Set UI labels for Custom Post Type
    $labels = array(
        'name'                => 'Auto in vendita',
        'singular_name'       => 'Auto in vendita',
        'menu_name'           => 'Auto in vendita',
        'all_items'           => 'Tutte le Auto in Vendita',
        'view_item'           => 'Visualizza Auto in vendita',
        'add_new_item'        => 'Aggiungi nuova Auto in vendita',
        'add_new'             => 'Aggiungi Auto in vendita',
        'edit_item'           => 'Modifica Auto in vendita',
        'update_item'         => 'Aggiorna Auto in vendita',
        'search_items'        => 'Cerca Auto in vendita',
        'not_found'           => 'Non trovato',
        'not_found_in_trash'  => 'Non trovato nel cestino',
    );
     
    // Set other options for Custom Post Type
    $args = array(
        'label'               => 'Auto in vendita',
        'description'         => 'Gestione Auto in vendita',
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'thumbnail', 'revisions', 'author' ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'menu_icon'           => 'dashicons-car',
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => true,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest'        => true,
        'taxonomies'          => array('alimentazione-auto','cambio-auto','chilometri-auto','auto-brand','year-model','type-car')
    );
     
    // Registering your Custom Post Type
    register_post_type('auto', $args );
}

function add_taxonomy_auto_carsales() {

    $taxonomy_array = array(
        array('slug' => 'alimentazione-auto', 'name' => 'Alimentazione', 'singular_name' => 'Alimentazione'),
        array('slug' => 'cambio-auto', 'name' => 'Cambio', 'singular_name' => 'Cambio'),
        array('slug' => 'chilometri-auto', 'name' => 'Chilomentri', 'singular_name' => 'Chilomentri'),
        array('slug' => 'auto-brand', 'name' => 'Marchi', 'singular_name' => 'Marchio'),
        array('slug' => 'year-model', 'name' => 'Anno del modello', 'singular_name' => 'Anno del modello'),
        array('slug' => 'type-car', 'name' => 'Tipi di auto', 'singular_name' => 'Tipo di auto'),
    );

    foreach($taxonomy_array as $item) {

        register_taxonomy($item['slug'], array('auto'), array(
            'labels' => array(  
                'name'                       => _x( $item['name'], 'Taxonomy General Name', 'text_domain' ),
                'singular_name'              => _x( $item['singular_name'], 'Taxonomy Singular Name', 'text_domain' ),
                'menu_name'                  => __( $item['name'], 'text_domain' ),
                'all_items'                  => __( 'Tutti '.$item['name'], 'text_domain' ),
                'parent_item'                => null,
                'parent_item_colon'          => null,
                'new_item_name'              => __( 'Nuovo '.$item['singular_name'], 'text_domain' ),
                'add_new_item'               => __( 'Aggiungi nuovo '.$item['singular_name'], 'text_domain' ),
                'edit_item'                  => __( 'Modifica '.$item['singular_name'], 'text_domain' ),
                'update_item'                => __( 'Aggiorna '.$item['singular_name'], 'text_domain' ),
                'view_item'                  => __( 'Visualizza '.$item['singular_name'], 'text_domain' ),
                'separate_items_with_commas' => __( 'Seprata '.$item['singular_name'].' con virgole', 'text_domain' ),
                'add_or_remove_items'        => __( 'Aggiungi o rimuovi '.$item['singular_name'], 'text_domain' ),
                'choose_from_most_used'      => __( 'Scegli tra i piu utilizzati', 'text_domain' ),
                'popular_items'              => __( 'Popolare '.$item['singular_name'], 'text_domain' ),
                'search_items'               => __( 'Cerca '.$item['singular_name'], 'text_domain' ),
                'not_found'                  => __( 'Non trovato', 'text_domain' ),
                'no_terms'                   => __( 'Nessun '.$item['singular_name'], 'text_domain' ),
                'items_list'                 => __( 'Lista elementi', 'text_domain' ),
                'items_list_navigation'      => __( 'Menu lista elementi', 'text_domain' )
            ),
            'hierarchical'               => true,
            'public'                     => true,
            'show_ui'                    => true,
            'show_admin_column'          => true,
            "show_in_menu"               => true,
            'show_in_nav_menus'          => true,
            'show_tagcloud'              => true,
            'show_in_rest'               => true,
            'query_var'                  => true,
            "publicly_queryable"         => true,
            'rewrite'                    => array('slug' => $item['slug'], 'with_front' => true)
        ));
    }
}

function columns_recensioni($columns) {

    // $before = 'date'; // move before this
 
    // foreach($columns as $key => $value) {
    //     if ($key==$before){
    //         $n_columns['featured_progetto'] = 'In evidenza';
    //     }
    //     $n_columns[$key] = $value;
    // }

    // return $n_columns;

}
add_filter('manage_recensione_posts_columns', 'columns_recensioni');

?>
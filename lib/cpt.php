<?php

function create_cpt() {
  
  // Projet
  $labels = array(
    'name'                => 'Projets',
    'singular_name'       => 'Projet',
    'menu_name'           => 'Projets',
    'parent_item_colon'   => 'Parent Projet',
    'all_items'           => 'All Projets',
    'view_item'           => 'View Projet',
    'add_new_item'        => 'Add New Projet',
    'add_new'             => 'Add New',
    'edit_item'           => 'Edit Projet',
    'update_item'         => 'Update Projet',
    'search_items'        => 'Search Projet',
    'not_found'           => 'Not Found',
    'not_found_in_trash'  => 'Not found in Trash',
  );
  $args = array(
    'label'               => 'projet',
    'description'         => 'Projet',
    'labels'              => $labels,
    'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
    'taxonomies'          => array( 'expertise' ),
    'hierarchical'        => false,
    'public'              => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_nav_menus'   => true,
    'show_in_admin_bar'   => true,
    'menu_position'       => 4,
    'can_export'          => true,
    'has_archive'         => false,
    'exclude_from_search' => false,
    'publicly_queryable'  => true,
    'query-var'           => true,
    'rewrite'             => array( 'slug' => 'projet', 'with_front' => false ),
    'capability_type'     => 'page',
  );
  register_post_type( 'projet', $args );

}

function create_taxonomy() {
 
  $labels = array(
    'name' => _x( 'Expertises', 'taxonomy general name' ),
    'singular_name' => _x( 'Expertise', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Expertises' ),
    'popular_items' => __( 'Popular Expertises' ),
    'all_items' => __( 'All Expertises' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Expertise' ), 
    'update_item' => __( 'Update Expertise' ),
    'add_new_item' => __( 'Add New Expertise' ),
    'new_item_name' => __( 'New Expertise Name' ),
    'separate_items_with_commas' => __( 'Separate Expertises with commas' ),
    'add_or_remove_items' => __( 'Add or remove Expertises' ),
    'choose_from_most_used' => __( 'Choose from the most used Expertises' ),
    'menu_name' => __( 'Expertise' ),
  );
  register_taxonomy('expertise','projet',array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'expertise', 'with_front' => false ),
  ));

}

// add_action( 'init', 'create_cpt', 0 );
// add_action( 'init', 'create_taxonomy', 0 );
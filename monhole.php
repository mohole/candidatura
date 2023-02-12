<?php
/*
 * Plugin Name: Personaggi di romanzo
 * Description: Aggiunge un nuovo tipo di post personalizzato "Personaggi di romanzo". Incluso due tassonomie personalizzate.
 * Version: 1.0
 * Author: Tuo nome
 * Author URI: http://tuo-sito.it
 */

// Aggiunge il nuovo tipo di post "Personaggi di romanzo"
function create_post_type_characters() {
  register_post_type( 'characters',
    array(
      'labels' => array(
        'name' => __( 'Personaggi di romanzo' ),
        'singular_name' => __( 'Personaggio' )
      ),
      'public' => true,
      'has_archive' => true,
      'supports' => array( 'title', 'editor', 'thumbnail' ),
    )
  );
}
add_action( 'init', 'create_post_type_characters' );

// Aggiunge la tassonomia gerarchica "Fazioni"
function create_taxonomy_factions() {
  register_taxonomy(
    'factions',
    'characters',
    array(
      'labels' => array(
        'name' => 'Fazioni',
        'add_new_item' => 'Aggiungi nuova fazione',
        'new_item_name' => "Nuova fazione"
      ),
      'show_ui' => true,
      'show_tagcloud' => false,
      'hierarchical' => true,
    )
  );
}
add_action( 'init', 'create_taxonomy_factions' );

// Aggiunge la tassonomia non gerarchica "Gruppi di avventura"
function create_taxonomy_adventure_groups() {
  register_taxonomy(
    'adventure_groups',
    'characters',
    array(
      'labels' => array(
        'name' => 'Gruppi di avventura',
        'add_new_item' => 'Aggiungi nuovo gruppo di avventura',
        'new_item_name' => "Nuovo gruppo di avventura"
      ),
      'show_ui' => true,
      'show_tagcloud' => true,
      'hierarchical' => false,
    )
  );
}
add_action( 'init', 'create_taxonomy_adventure_groups' );

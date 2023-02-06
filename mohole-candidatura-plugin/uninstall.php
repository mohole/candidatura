<?php
/**
* 
* @package mohole-candidatura-plugin
* 
* Author Alberto Carenini
*/

// Evita accesso esterno allo script verificando che sia stata definita la costante WP_UNINSTALL_PLUGIN
if( !defined( 'WP_UNINSTALL_PLUGIN' )){
	exit;
}

// Creo un array con tutti i CPT di tipo 'personaggi'
$tutti_i_cpt = get_posts(array('post_type' => 'personaggi', 'numberposts' => -1));

// Iterazione per eliminare gli elementi dell array 
foreach($tutti_i_cpt as $cpt){
	
   // Questo metodo elimina solo i CPT ma non le tassonomie associate. 
   wp_delete_post($cpt->ID, true);

/* 
In alternativa potremmo usare la classe wpdb per fare delle query in SQL per eliminare i dati 
dalle tabelle wp_posts, wp_postmeta e wp_term_relationships. E magari anche wp_term_taxonomy dopo
aver verificato che le tassonomie in questione non sono state registrate da altri CPT. 

Le query potrebbero assomigliare a qualcosa di questo genere:

global $wpdb;

   $wpdb->query( "DELETE FROM wp_posts WHERE post_type = 'personaggi'" );
   $wpdb->query( "DELETE FROM wp_postmeta WHERE post_id NOT IN (SELECT id FROM wp_posts)" );
   $wpdb->query( "DELETE FROM wp_term_relationships WHERE object_id NOT IN (SELECT id FROM wp_posts)" );
   */

   
}

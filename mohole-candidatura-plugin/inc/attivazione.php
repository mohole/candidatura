<?php
/**
* 
* @package mohole-candidatura-plugin
* 
* Author Alberto Carenini
*/

// Evita accesso esterno allo script
if( !defined( 'ABSPATH' )){
	exit;
}

/* 
Nonostante non abbia molto senso creare una classe solo per contenere questo metodo, questo è un boilerplate valido
per una struttura scalabile e modulare in caso questo plugin dovesse crescere in termini di funzionalità. 
*/

if(!class_exists('ClasseAttivazione')){

    class ClasseAttivazione{

        /* 
        Questo metodo è statico e verrà chiamato in modo statico perchè non voglio inizializzare la classe
        */
        public static function attivazione(){

            // Riscriviamo la struttura dei permalinks dopo aver registrato nuovi CPT e nuove tassonomie
            
            flush_rewrite_rules();   // svuota e riscrive le regole rewrite del htaccess

            delete_option('rewrite_rules');  // elimina la voce dal DB in modo che WP le ricrei
        
        }
    }

}
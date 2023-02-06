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

if(!class_exists('ClasseDisattivazione')){

    class ClasseDisattivazione{

        /* 
        Questo metodo è statico e verrà chiamato in modo statico perchè non voglio inizializzare la classe. 
        */
        public static function disattivazione(){

            // Riscriviamo la struttura dei permalinks dopo aver disattivato il plugin
            flush_rewrite_rules();

        }
    }

}
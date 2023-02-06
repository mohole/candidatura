<?php
/**
* Plugin Name: Plugin per Candidatura Mohole
* Plugin URI:  https://ac-sviluppo.it/
* Description: Crea un custom post type, una tassonomia gerarchica e una tassonomia non gerarchica. 
* Version:     1.0.0
* Author:      Alberto Carenini
* License:     GPL-2.0+
* Author URI:  https://ac-sviluppo.it/
* Copyright:   2023 AC Sviluppo
* Text Domain: candidatura_mohole
* Domain Path: /languages
*/

// Evita accesso diretto al file
if( !defined( 'ABSPATH' )){
	exit;
}

// Dentro questo file ho scritto i metodi per la creazione del CPT e Tassonomie
require_once plugin_dir_path(__FILE__) . '/inc/creaCPTeTassonomie.php';

// Controlliamo che la classe non esista già
if(!class_exists('PluginCandidaturaMohole')){

    class PluginCandidaturaMohole{


        function __construct(){

            // Creo costanti utili per il tuturo
            define('NOME_PLUGIN', plugin_basename(__FILE__)); // cartella/nomefile.php
            define('URL_PLUGIN', plugin_dir_url(__FILE__));    // url completo
            define('URL_PLUGINS', plugin_dir_url( dirname(__FILE__)));  // url fino a /cartella
            define('PATH_PLUGIN', plugin_dir_path(__FILE__));  // percorso completo
            
        }

        function attiva(){
            // Dentro questo file si trova il metodo per l'attivazione
            require_once plugin_dir_path(__FILE__) . '/inc/attivazione.php';

            // Lo richiamo in modo statico perchè non ho inizializzato la classe
            ClasseAttivazione::attivazione();
        }

        function disattiva(){
            // Dentro questo file si trova il metodo per la disattivazione
            require_once plugin_dir_path(__FILE__) . '/inc/disattivazione.php';

            // Lo richiamo in modo statico perchè non ho inizializzato la classe
            ClasseDisattivazione::disattivazione();
        }

    }

    $pluginCandidaturaMohole = new PluginCandidaturaMohole();

     // Il metodo attiva viene chiamato quando l'utente attiva il plugin
    register_activation_hook(__FILE__, array($pluginCandidaturaMohole, 'attiva'));

    // Il metodo disattiva viene chiamato quando l'utente disattiva il plugin
    register_deactivation_hook(__FILE__, array($pluginCandidaturaMohole, 'disattiva'));

}
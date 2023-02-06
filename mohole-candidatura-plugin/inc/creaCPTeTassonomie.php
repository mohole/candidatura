<?php
/**
* 
* @package mohole-candidatura-plugin
* 
* Author Alberto Carenini
*/

// EVITA ACCESSO DIRETTO AL FILE
if( !defined( 'ABSPATH' )){
	exit;
}

// Controlla che la classe non esista 
if(!class_exists('MoholeCreaCPTeTassonomie')){

    class MoholeCreaCPTeTassonomie{

        function __construct(){

        }

        function registra(){
            // il metodo pubblico 'creaCPTeTassonomie' genera CPT e Tassonomie e viene chiamato nel hook "init"
            add_action('init', array($this, 'creaCPTeTassonomie'));

            // il metodo pubblico 'incodaAssets' incoda gli asset CSS e JS e viene chiamato nel hook "wp_enqueue_scripts"
            add_action('wp_enqueue_scripts', array($this, 'incodaAssets'));
        }

    // ---------------------------------- CREA CUSTOM POST TYPE -----------------------------
        private function creaCPT(){
        
            $argomenti = array(
                    'label' => 'Personaggi',
                    'labels' => array('name' => 'Personaggi', 'singular_name' => 'Personaggio', 'menu_name' => 'Personaggi', 'add_new' => 'Aggiungi Personaggio', 'all_items' => 'Tutti i Personaggi'),
                    'description' => 'Crea un Post Type specifico per i personaggi del libro',
                    'hierarchical' => true,
                    'public' => true,
                    'has_archive' => true,
                    'show_in_rest' => true,
                    'menu_icon' => 'dashicons-groups',
                    'taxonomies' => array('razze', 'gruppi'),
                    'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
            );
            
            register_post_type('personaggi', $argomenti);
            
        }
        
    // ------------------------------------------ CREA TASSONOMIE ---------------------------------------

        private function creaTassonomiaCPT(){

            //  TASSONOMIA RAZZE - gerarchica
            $argomenti = array(
                'labels' => array('name' => 'Razze', 'singular_name' => 'Razza'),
                'hierarchical' => true,
                'description' => 'Organizza i personaggi in razze e fazioni',
                'public' => true,
                'show_in_rest' => true
            );
            
            register_taxonomy('razze', array('personaggi'), $argomenti);

            // TASSONOMIA GRUPPI non gerarchica
            $argomenti = array(
                'labels' => array('name' => 'Gruppi', 'singular_name' => 'Gruppo'),
                'hierarchical' => false,
                'description' => 'Organizza i personaggi in gruppi di avventura',
                'public' => true,
                'show_in_rest' => true
            );

            register_taxonomy('gruppi', array('personaggi'), $argomenti);

        }

        // Questo metodo è pubblico perchè deve essere usato nell add_action
        public function creaCPTeTassonomie(){

            $this->creaCPT();
            $this->creaTassonomiaCPT();

        }

        // Questo metodo pubblico lo uso per chiamare il metodo privato per incodare gli asset
        public function incodaAssets(){

            $this->incodaGliAsset();
        }

        // Questo è il metodo privato per incodare gli asset
        private function incodaGliAsset(){

            // incodo i CSS
            wp_enqueue_style('stiloso-css', URL_PLUGIN . 'asset/style.css');

            // incodo i JS - non ha dipendenze e lo incodo del footer
            wp_enqueue_script('javascritto-js', URL_PLUGIN . 'asset/index.js', array(), false, true);
        }

    }

    // Creo istanza della classe
    $moholeCreaCPTeTassonomie = new MoholeCreaCPTeTassonomie();

    /* 
    Subito dopo aver creato l'istanza della classe chiamo il metodo 'registra' che si occupa
    dei metodi riguardanti la creazione del CPT e Tassonomie. Invece di mettere tutto nel constructor
    */
    $moholeCreaCPTeTassonomie->registra();
}

<?php
/**
 * The taxonomies register archive
 * 
 * @package nautilusnet
 */


/**
 * Taxonomia tipo_conexao para os planos
 * 
 * @link https://codex.wordpress.org/Function_Reference/register_taxonomy
 */
add_action( 'init', 'create_tipo_conexao_taxomony', 0 );

// Criação da taxonomia "Tipos de conexões" utilizada para especificar o tipo no plano oferecido
function create_tipo_conexao_taxomony() {
    $plural_name    = 'Conexões';
    $singular_name  = 'Conexão';

    $labels = array(
        'name'              => 'Tipo da ' . $singular_name,
        'singular_name'     => 'Tipo da' . $singular_name,
        'search_items'      => 'Procurar ' . $singular_name,
        'all_items'         => 'Todos as' . $plural_name,
        'edit_item'         => 'Editar ' . $singular_name,
        'add_new_item'      => 'Adicionar novo tipo de ' . $singular_name,
        'update_item'       => 'Atualizar tipo de ' . $singular_name,
        'menu_name'         => 'Tipo(s) de ' . $plural_name
    );

	$args = array(
		'hierarchical'      => false,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'tipo_conexao' ),
    );
    
    register_taxonomy('tipo_conexao', array('planos'), $args);
}
<?php
/**
 * Registro de custom-post-types
 * 
 * @package nautilusnet
 * @since 1.0.0
 */

// Custom post type: Avisos
add_action('init','cpt_avisos');
function cpt_avisos(){

    $cpt_name           = 'avisos';
    $cpt_description    = 'Cadastre avisos e envie para o site e via SMS para os clientes';
    $singular_name      = 'aviso';
    $plural_name        = 'avisos';

    $labels = array(
        'singular_name'         => $singular_name,
        'menu_name'             => $plural_name,
        'name_admin_bar'        => $singular_name,
        'add_new'               => 'Adicionar novo',
        'add_new_item'          => 'Adicionar ' . $singular_name,
        'new_item'              => 'Novo ' . $singular_name,
        'edit_item'             => 'Editar ' . $singular_name,
        'view_item'             => 'Visualizar ' . $singular_name,
        'all_items'             => 'Todos os ' . $plural_name,
        'search_item'           => 'Procurar ' . $singular_name,
        'not_found'             => $singular_name . ' Não encontrado',
        'not_found_in_trash'    => $singular_name . ' Não encontrado na lixeira'
    );

    $args = array(
        'labels'                => $labels,
        'description'           => $cpt_description,
        'public'                => true,
        'public_queryable'      => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'query_var'             => true,
        'rewrite'               => array('slug' => $singular_name),
        'has_archive'           => true,
        'capability_type'       => 'post',
        'hierarchical'          => false,
        'menu_position'         => null,
        'supports'              => array('title', 'editor', 'thumbnail')
    );
    
    register_post_type($cpt_name, $args);
}

// Custom post type: Beneficios
add_action('init', 'cpt_beneficios');
function cpt_beneficios(){
    
    $cpt_name           = 'beneficios';
    $cpt_description    = 'Mostre aos seus visitantes o porque a nautilus é a melhor no que faz!';
    $singular_name      = 'beneficio';
    $plural_name        = 'beneficios';

    $labels = array(
        'singular_name'         => $singular_name,
        'menu_name'             => $plural_name,
        'name_admin_bar'        => $singular_name,
        'add_new'               => 'Adicionar novo',
        'add_new_item'          => 'Adicionar ' . $singular_name,
        'new_item'              => 'Novo ' . $singular_name,
        'edit_item'             => 'Editar ' . $singular_name,
        'view_item'             => 'Visualizar ' . $singular_name,
        'all_items'             => 'Todos os ' . $plural_name,
        'search_item'           => 'Procurar ' . $singular_name,
        'not_found'             => $singular_name . ' Não encontrado',
        'not_found_in_trash'    => $singular_name . ' Não encontrado na lixeira'
    );

    $args = array(
        'labels'                => $labels,
        'description'           => $cpt_description,
        'public'                => true,
        'public_queryable'      => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'query_var'             => true,
        'rewrite'               => array('slug' => $singular_name),
        'has_archive'           => true,
        'capability_type'       => 'post',
        'hierarchical'          => false,
        'menu_position'         => null,
        'supports'              => array('title', 'editor', 'thumbnail')
    );
    register_post_type($cpt_name, $args);
}

// Custom post type: Planos
add_action('init', 'cpt_planos');
function cpt_planos(){
    
    $cpt_name           = 'planos';
    $cpt_description    = 'Adicione os planos de internet via-rádio e fibra óptica.';
    $singular_name      = 'plano';
    $plural_name        = 'planos';

    $labels = array(
        'singular_name'         => $singular_name,
        'menu_name'             => $plural_name,
        'name_admin_bar'        => $singular_name,
        'add_new'               => 'Adicionar novo',
        'add_new_item'          => 'Adicionar ' . $singular_name,
        'new_item'              => 'Novo ' . $singular_name,
        'edit_item'             => 'Editar ' . $singular_name,
        'view_item'             => 'Visualizar ' . $singular_name,
        'all_items'             => 'Todos os ' . $plural_name,
        'search_item'           => 'Procurar ' . $singular_name,
        'not_found'             => $singular_name . ' Não encontrado',
        'not_found_in_trash'    => $singular_name . ' Não encontrado na lixeira'
    );

    $args = array(
        'labels'                => $labels,
        'description'           => $cpt_description,
        'public'                => true,
        'public_queryable'      => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'query_var'             => true,
        'rewrite'               => array('slug' => $singular_name),
        'has_archive'           => true,
        'capability_type'       => 'post',
        'hierarchical'          => false,
        'menu_position'         => null,
        'supports'              => array('title', 'editor', 'thumbnail')
    );
    register_post_type($cpt_name, $args);
}

// Custom post type: blog/noticias
add_action('init', 'cpt_blog');
function cpt_blog(){
    
    $cpt_name           = 'blog';
    $cpt_description    = 'Adicione novidades e noticias para manter seus clientes informados';
    $singular_name      = 'blog';
    $plural_name        = 'blog';

    $labels = array(
        'singular_name'         => $singular_name,
        'menu_name'             => $plural_name,
        'name_admin_bar'        => $singular_name,
        'add_new'               => 'Adicionar novo',
        'add_new_item'          => 'Adicionar ' . $singular_name,
        'new_item'              => 'Novo ' . $singular_name,
        'edit_item'             => 'Editar ' . $singular_name,
        'view_item'             => 'Visualizar ' . $singular_name,
        'all_items'             => 'Todos os ' . $plural_name,
        'search_item'           => 'Procurar ' . $singular_name,
        'not_found'             => $singular_name . ' Não encontrado',
        'not_found_in_trash'    => $singular_name . ' Não encontrado na lixeira'
    );

    $args = array(
        'labels'                => $labels,
        'description'           => $cpt_description,
        'public'                => true,
        'public_queryable'      => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'query_var'             => true,
        'rewrite'               => array('slug' => $singular_name),
        'has_archive'           => true,
        'capability_type'       => 'post',
        'hierarchical'          => false,
        'menu_position'         => null,
        'supports'              => array('title', 'editor', 'thumbnail')
    );
    register_post_type($cpt_name, $args);
}

// Custom post type: tickets
add_action('init', 'cpt_tickets');
function cpt_tickets(){
    
    $cpt_name           = 'tickets';
    $cpt_description    = 'Tickets são abertos sempre que algum visitante submete o formulário na seção de contato';
    $singular_name      = 'ticket';
    $plural_name        = 'tickets';

    $labels = array(
        'singular_name'         => $singular_name,
        'menu_name'             => $plural_name,
        'name_admin_bar'        => $singular_name,
        'add_new'               => 'Adicionar novo',
        'add_new_item'          => 'Adicionar ' . $singular_name,
        'new_item'              => 'Novo ' . $singular_name,
        'edit_item'             => 'Editar ' . $singular_name,
        'view_item'             => 'Visualizar ' . $singular_name,
        'all_items'             => 'Todos os ' . $plural_name,
        'search_item'           => 'Procurar ' . $singular_name,
        'not_found'             => $singular_name . ' Não encontrado',
        'not_found_in_trash'    => $singular_name . ' Não encontrado na lixeira'
    );

    $args = array(
        'labels'                => $labels,
        'description'           => $cpt_description,
        'public'                => true,
        'public_queryable'      => true,
        'show_ui'               => false, #escondido por enquanto
        'show_in_menu'          => true,
        'query_var'             => true,
        'rewrite'               => array('slug' => $singular_name),
        'has_archive'           => true,
        'capability_type'       => 'post',
        'hierarchical'          => false,
        'menu_position'         => null,
        'supports'              => array('title', 'editor', 'thumbnail', 'post-formats'),

    );
    register_post_type($cpt_name, $args);
}
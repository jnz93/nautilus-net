<?php
/**
 * The shortcodes template
 * 
 * @package nautilusnet
 */

////////////////////////////////////////////////////////////////////////////////////////////////
// Menu de navegação
////////////////////////////////////////////////////////////////////////////////////////////////
if( ! function_exists('get_menu_navigation') ){
    function get_menu_navigation(){
        $args_menu = array(
            'menu'              => 'Menu de navegação',
            'menu_class'        => 'container__flex menuList',
            'menu_id'           => '',
            'container'         => 'div',
            'container_class'   => 'container__flex mainMenuContainer mainMenuContainer__mobile--disabled',
            'container_id'      => 'main-menu',
            'fallback_cb'       => '', #Se não existir o menu chama uma função que será executada. Padrão 'wp_page_menu'.
            'before'            => '',
            'after'             => '',
            'link_before'       => '',
            'link_after'        => '',
            'echo'              => true,
            'depth'             => '',
            'walker'            => '', 
            'theme_location'    => 'menu-navegacao',
            'item_spacing'      => ''
        );

        return wp_nav_menu($args_menu);
    }
    add_shortcode('show_menu_navegacao', 'get_menu_navigation');
}

////////////////////////////////////////////////////////////////////////////////////////////////
// Menu Instuticional
////////////////////////////////////////////////////////////////////////////////////////////////
if( ! function_exists('get_menu_institutional') ){
    function get_menu_institutional(){
        $args_menu = array(
            'menu'              => 'Menu institucional',
            'menu_class'        => 'container__flex headerMenu',
            'menu_id'           => '',
            'container'         => 'div',
            'container_class'   => 'container__flex headerMenu__mobile--disabled',
            'container_id'      => 'main-menu',
            'fallback_cb'       => '', #Se não existir o menu chama uma função que será executada. Padrão 'wp_page_menu'.
            'before'            => '',
            'after'             => '',
            'link_before'       => '',
            'link_after'        => '',
            'echo'              => true,
            'depth'             => '',
            'walker'            => '', 
            'theme_location'    => 'menu-institucional',
            'item_spacing'      => ''
        );

        return wp_nav_menu($args_menu);
    }
    add_shortcode('menu_institucional', 'get_menu_institutional');
}

////////////////////////////////////////////////////////////////////////////////////////////////
// Homepage notifications
////////////////////////////////////////////////////////////////////////////////////////////////
if( !function_exists('get_notifications') ){
    function get_notifications(){
        $post_type      = 'avisos';
        $order          = 'DESC';
        $orderby        = 'date';
        $status         = 'publish';
        $number_posts   = '5';
        
        $args = array(
            'post_type'         => $post_type,
            'cat'               => $category,
            'order'             => $order,
            'orderby'           => $orderby,
            'post_status'       => $status,
            'posts_per_page'    => $number_posts
        );
    
        $notifications = new WP_Query($args);
        $output = '';
        if( $notifications->have_posts() ){
            while( $notifications->have_posts() ){
                $notifications->the_post();
                $post_id        = get_the_ID();
                $publish_date   = get_the_date('l,j,F', $post_id);
                $post_title     = get_the_title($post_id);
                $post_subtitle  = get_post_meta($post_id, 'post_subtitle', true);
                $post_content   = get_the_content();
                // $post_thumb_url = get_the_post_thumbnail_url($post_id, 'large');

                $output .= '<div id="" class="notificationWrapper">';
                $output .= '<div class="notificationWrapper__controls">
                                <span id="" class="notificationWrapper__icon"><i data-eva="bell" data-eva-fill="" data-eva-height="24" data-eva-width="24" data-eva-animation=""></i></span>
                                <span id="" class="notificationWrapper__icon" style="display: none;"><i data-eva="close" data-eva-fill="" data-eva-height="24" data-eva-width="24" data-eva-animation=""></i></span>
                            </div>';
                $output .= '<article id="notification-'. $post_id .'" class="container__flex notification" style="display: none">';
                $output .= '<div id="" class="col-md-12 col-lg-12">
                                <span class="notification__date" alt="Publicado '. $publish_date .'">Publicado '. $publish_date .'</span>
                                <h1 class="notification__title notification__title--small">'. $post_title .'</h1>
                                <h3 class="notification__subtitle">'. $post_subtitle .'</h3>
                            </div>';
                $output .= '<div id="" class="col-md-12 col-lg-12">
                                <p class="notification__content">'. $post_content .'</p>
                            </div>
                            <div class="notificationWrapper__shareBox">
                                Add share options
                            </div>';
                $output .= '</article>';
                $output .= '</div>';
            }
            echo $output;
        } else {
            echo "Não encontramos notificações. :)";
        }
    }
    add_shortcode('show_notifications', 'get_notifications');
}

////////////////////////////////////////////////////////////////////////////////////////////////
// Homepage article's slider
////////////////////////////////////////////////////////////////////////////////////////////////
if( !function_exists('get_article_sliders') ){
    function get_article_sliders(){
        $post_type      = 'post';
        $order          = 'DESC';
        $orderby        = 'date';
        $status         = 'publish';
        $number_posts   = '5';
        
        $args = array(
            'post_type'         => $post_type,
            'cat'               => $category,
            'order'             => $order,
            'orderby'           => $orderby,
            'post_status'       => $status,
            'posts_per_page'    => $number_posts
        );
    
        $notifications = new WP_Query($args);
        $output = '';
        if( $notifications->have_posts() ){
            while( $notifications->have_posts() ){
                $notifications->the_post();
                $post_id        = get_the_ID();
                $publish_date   = get_the_date('l,j,F', $post_id);
                $post_title     = get_the_title($post_id);
                $post_subtitle  = get_post_meta($post_id, 'post_subtitle', true);
                $post_content   = get_the_content();
                $post_excerpt   = get_the_excerpt($post_id);
                $post_thumb_url = get_the_post_thumbnail_url($post_id, 'large');

                $output .= '<article class="row articleHome">
                                <div class="col-md-6 col-lg-6 articleHome__wrapperContent">
                                    <h1 class="articleHome__title" title="'. $post_title .'">'. $post_title .'</h1>
                                    <p class="articleHome__excerpt">'. $post_excerpt .'</p>
                                    <button class="btn btn__primary btn__primary--big">Ver publicação</button>
                                </div>
                                <div class="col-md-6 col-lg-6 articleHome__wrapperContent">
                                    <figure class="articleHome__thumbContainer">
                                        <img src="'. $post_thumb_url .'" class="articleHome__img" />
                                    </figure>
                                </div>
                            </article>';
                
            }
            echo $output;
        } else {
            echo "Não encontramos notificações. :)";
        }
    }
    add_shortcode('show_article_sliders', 'get_article_sliders');
}

////////////////////////////////////////////////////////////////////////////////////////////////
// Homepage benefits articles
////////////////////////////////////////////////////////////////////////////////////////////////
if( !function_exists('get_article_benefits') ){
    function get_article_benefits(){
        $post_type      = 'beneficios';
        $order          = 'DESC';
        $orderby        = 'date';
        $status         = 'publish';
        $number_posts   = '6';
        
        $args = array(
            'post_type'         => $post_type,
            'cat'               => $category,
            'order'             => $order,
            'orderby'           => $orderby,
            'post_status'       => $status,
            'posts_per_page'    => $number_posts
        );
    
        $notifications = new WP_Query($args);
        $output = '';
        if( $notifications->have_posts() ){
            while( $notifications->have_posts() ){
                $notifications->the_post();
                $post_id        = get_the_ID();
                $publish_date   = get_the_date('l,j,F', $post_id);
                $post_title     = get_the_title($post_id);
                $post_content   = apply_filters('the_content', get_the_content());
                $post_icon      = get_post_meta($post_id, 'benefit_icon', true);

                $output .= '<article id="benefit-'. $post_id .'" class="col-xs-12 col-sm-12 col-md-4 col-lg-4 benefitCard">
                                <div class="col-12">
                                    <span class="benefitCard__wrapIcon"><i class="benefitCard__icon" data-eva="'. $post_icon .'" data-fill=""  data-height="" data-width=""></i></span>
                                </div>
                                <div class="col-12">
                                    <h3 class="benefitCard__title" title="'. $post_title .'">'. $post_title .'</h3>
                                    <p class="benefitCard__content">'. $post_content .'</p>
                                </div>
                            </article>';
                
            }
            echo $output;
        } else {
            echo "Não encontramos notificações. :)";
        }
    }
    add_shortcode('show_article_benefits', 'get_article_benefits');
}

////////////////////////////////////////////////////////////////////////////////////////////////
// Homepage Plans articles
////////////////////////////////////////////////////////////////////////////////////////////////
if( !function_exists('get_plans') ){
    function get_plans(){
        $post_type      = 'planos';
        $order          = 'DESC';
        $orderby        = 'date';
        $status         = 'publish';
        $number_posts   = '5';
        
        $args = array(
            'post_type'         => $post_type,
            // 'cat'               => $category,
            // 'order'             => $order,
            // 'orderby'           => $orderby,
            'post_status'       => $status,
            'posts_per_page'    => $number_posts
        );
    
        $plans = new WP_Query($args);
        $output = '';
        if( $plans->have_posts() ){
            while( $plans->have_posts() ){
                $plans->the_post();
                $post_id        = get_the_ID();
                $publish_date   = get_the_date('l,j,F', $post_id);
                $post_title     = get_the_title($post_id);
                $post_content   = apply_filters('the_content', get_the_content());

                $plan_download  = get_post_meta($post_id, 'speed_download', true);
                $plan_upload    = get_post_meta($post_id, 'speed_upload', true);
                $plan_price     = get_post_meta($post_id, 'plan_price', true);
                $plan_txt_btn   = get_post_meta($post_id, 'plan_button_text', true);
                $plan_payment_tag   = get_post_meta($post_id, 'payment_tag', true);

                $output .= '<article id="plano-'. $post_id .'" class="col-xs-10 col-sm-10 col-md-2 col-lg-2 planCard">
                                <h1 class="planCard__title" title="'. $post_title .'">'. $post_title .'</h1>
                                <span class="planCard__label">tipo da conxeção</span>
                                <div class="">
                                    <p class="planCard__content">'. $post_content .'</p>
                                </div>
                                <div class="">
                                    <span class="planCard__tag">R$</span>
                                    <h2 class="planCard__price" title="'. $plan_price .'">'. $plan_price .'</h2>
                                    <span class="planCard__tag">'. $plan_payment_tag .'</span>
                                </div>
                                <button id="submit-'. $post_id .'" class="btn btn__primary btn__primary--medium">'. $plan_txt_btn .'</button>
                            </article>';   
            }
            echo $output;
        } else {
            echo "Não encontramos planos cadastrados";
        }
    }
    add_shortcode('show_plans', 'get_plans');
}

////////////////////////////////////////////////////////////////////////////////////////////////
// Homepage Contact section
////////////////////////////////////////////////////////////////////////////////////////////////
if( !function_exists('create_contact_section') ){
    function create_contact_section(){

        // Armazenamento das informações
        $contact_email      = get_option('contact_email');
        $contact_phone      = get_option('contact_phone');
        $contact_whatsapp   = get_option('contact_whatsapp');
        $contact_address    = get_option('contact_address');
        $contact_cep        = get_option('contact_cep');
        $contact_cnpj       = get_option('contact_cnpj');
        $office_hours       = get_option('contact_office_hours');

        // Tratamento de grupos de informações para enviar na função de construção do card
        $arr_email          = explode(',', $contact_email);
        $arr_tel            = array($contact_phone, $contact_whatsapp);
        $arr_office_hours   = explode('~', $office_hours);
        $arr_address        = explode('~', $contact_address);

        ?>
        <!-- Container content -->
        <div id="" class="row container-fluid">
            <div id="" class="row col-xs-12 col-sm-12 col-md-8 col-lg-8">
                <?php
                // Chamada dos cards
                card_contact('mail', 'E-mail', $arr_email);
                card_contact('phone', 'Telefone/Whatsapp', $arr_tel);
                card_contact('clock', 'Horário de atendimento', $arr_office_hours);
                card_contact('map-pin', 'Endereço', $arr_address);
                ?>
            </div>

            <div class="row col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <div class="cardContact">
                    <h3 class="cardContact__title">Precisa de um especialista?</h3>
                    <p class="cardContact__text">Não encontrou o que estava procurando? Está precisando de ajuda? Não tem problema, abre um chamado que nós vamos solucionar seu problema o mais rápido possível!</p>
                    <button id="" class="btn btn-primary btn-primary__medium">Abrir chamado</button>
                </div>
            </div>
        </div>
        <?php
    }

    add_shortcode('show_contact_section', 'create_contact_section');
}

////////////////////////////////////////////////////////////////////////////////////////////////
// Footer type 1
////////////////////////////////////////////////////////////////////////////////////////////////
if( !function_exists('create_footer_type1') ){
    function create_footer_type1(){
        ?>
        <div class="row container-fluid">
            <p class="footer__text footer__text--copyright">Todos os direitos reservados NautilusNet 2019</p>
        </div>
        <?php
    }
    add_shortcode('show_footer_type_1', 'create_footer_type1');
}
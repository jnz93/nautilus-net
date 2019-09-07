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
        $output .= '<button id="openNotification" class="notification__iconWrap">
                        <i id="ico-show-notification" class="notification__icon notification__icon--show" data-eva="bell" data-eva-fill="" data-eva-height="24" data-eva-width="24" data-eva-animation=""></i>
                        <i id="ico-close-notification" class="notification__icon notification__icon--disabled" data-eva="close" data-eva-fill="" data-eva-height="24" data-eva-width="24" data-eva-animation=""></i>
                    </button>';
        if( $notifications->have_posts() ){
            while( $notifications->have_posts() ){
                $notifications->the_post();
                $post_id        = get_the_ID();
                $publish_date   = get_the_date('l, j, F', $post_id);
                $post_title     = get_the_title($post_id);
                $post_subtitle  = get_post_meta($post_id, 'post_subtitle', true);
                $post_content   = get_the_content();
                // $post_thumb_url = get_the_post_thumbnail_url($post_id, 'large');

                $output .= '<div id="appNotification" class="notification notification__wrapper--normal">';
                
                $output .= '<article id="notification-'. $post_id .'" class="notification__content notification__content--hide">';
                $output .= '<div id="" class="col-md-12 col-lg-12">
                                <span class="notification__date" alt="Publicado '. $publish_date .'">Publicado '. $publish_date .'</span>
                                <h1 class="notification__title">'. $post_title .'</h1>
                                <h3 class="notification__subtitle">'. $post_subtitle .'</h3>
                            </div>
                            <span class="notification__spacer"></span>';
                $output .= '<div id="" class="col-md-12 col-lg-12">
                                <p class="notification__text">'. $post_content .'</p>
                            </div>
                            <div class="notificationWrapper__shareBox" style="display: none">
                                Add share options
                            </div>';
                $output .= '</article>';
                $output .= '</div>';
            }
            echo $output;
        } else {
            echo "<p style='opacity: 0'>Não encontramos notificações. :)</p>";
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
    
        $posts_homepage = new WP_Query($args);
        $output = '';
        if( $posts_homepage->have_posts() ){
            while( $posts_homepage->have_posts() ){
                $posts_homepage->the_post();
                $post_id        = get_the_ID();
                $publish_date   = get_the_date('l,j,F', $post_id);
                $post_title     = get_the_title($post_id);
                $post_subtitle  = get_post_meta($post_id, 'post_subtitle', true);
                $post_content   = get_the_content();
                $post_excerpt   = get_the_excerpt($post_id);
                $post_thumb_url = get_the_post_thumbnail_url($post_id, 'large');

                $output .= '<article data-wow-delay=".2s" class="wow bounceInUp row articleHome">
                                <div class="col-md-6 col-lg-6 articleHome__wrapperContent">
                                    <h1 class="articleHome__title" title="'. $post_title .'">'. $post_title .'</h1>
                                    <p class="articleHome__excerpt">'. $post_excerpt .'</p>
                                    <a href="'. get_the_permalink($post_id) .'" class="btn btn__primary btn__primary--big">Ver publicação</a>
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
                $post_content   = get_the_content();
                $post_icon      = get_post_meta($post_id, 'benefit_icon', true);

                $output .= '<div data-wow-delay=".2s" class="wow bounceInUp col-md-4 col-lg-4">
                                <article id="benefit-'. $post_id .'" class="benefitCard">
                                    <div class="col-12">
                                        <span class="benefitCard__wrapIcon">
                                            <i class="benefitCard__icon" data-eva="'. $post_icon .'" data-fill=""  data-eva-height="28" data-eva-width="28"></i>
                                        </span>
                                    </div>
                                    <div class="col-12">
                                        <h3 class="benefitCard__title" title="'. $post_title .'">'. $post_title .'</h3>
                                        <p class="benefitCard__text">'. sanitize_text_field($post_content) .'</p>
                                    </div>
                                </article>
                            </div>';
                
            }
            echo $output;
        } else {
            echo "<p>Ainda não temos publicações.</p>";
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
        $status         = 'publish';
        $number_posts   = '-1';
        
        $args = array(
            'post_type'         => $post_type,
            'post_status'       => $status,
            'posts_per_page'    => $number_posts,
            'orderby'           => array(
                'speed_download' => 'ASC'
            )
        );
    
        $plans = new WP_Query($args);
        $output = '';
        if( $plans->have_posts() ){
            while( $plans->have_posts() ){
                $plans->the_post();
                $post_id        = get_the_ID();
                $publish_date   = get_the_date('l,j,F', $post_id);
                $post_title     = get_the_title($post_id);
                $post_content   = get_the_content();

                $plan_download  = get_post_meta($post_id, 'speed_download', true);
                $plan_upload    = get_post_meta($post_id, 'speed_upload', true);
                $plan_price     = get_post_meta($post_id, 'plan_price', true);
                $plan_txt_btn   = get_post_meta($post_id, 'plan_button_text', true);
                $plan_payment_tag   = get_post_meta($post_id, 'payment_tag', true);

                $tax_conexao    = get_the_terms($post_id, 'tipo_conexao');
                $conexao_arr       = array();
                if( !empty($tax_conexao) ){
                    foreach($tax_conexao as $conexao){
                        $conexao_arr[] = $conexao->name;
                    }
                    $tipo_conexao = join( ' - ', $conexao_arr );
                } else {
                    $tipo_conexao = "tipo da conexão";
                }
                // Tratamento do título em partes
                $plan_title_arr = explode(' ', $post_title);
                $plan_title_pt1 = $plan_title_arr[0];
                $plan_title_pt2 = $plan_title_arr[1];

                $output .= '<article data-wow-delay=".2s" id="plano-'. $post_id .'" class="wow bounceInRight planCard">
                                <h1 class="planCard__title">'. $post_title .'</h1>
                                <span class="planCard__spacer"></span>

                                <div class="planCard__bubbleInfo">
                                    <h3 class="planCard__speed">'. $plan_download .'</h3>
                                    <span class="planCard__speedTag">mega</span>
                                </div>                                    
                                <div class="col-sm-12 col-md-12">
                                    <span class="planCard__label">'. $tipo_conexao .'</span>
                                </div>
                                <span class="planCard__spacer planCard__spacer--fift"></span>
                                <ul class="planCard__content">
                                <li class="planCard__contentItem">Download: <b>'. $plan_download .' MEGA</b></li>
                                <li class="planCard__contentItem">Upload: <b>'. $plan_upload .' MEGA</b></li>
                                    <li class="planCard__contentItem">Franquia: <b>Ilimitada</b></li>
                                </ul>
                                <span class="planCard__spacer planCard__spacer--fift"></span>

                                <div class="planCard__wrap">
                                    <span class="planCard__tag planCard__tag--alignStart">R$</span>
                                    <h2 class="planCard__price" title="'. $plan_price .'">'. $plan_price .'</h2>
                                    <span class="planCard__tag planCard__tag--alignEnd">'. $plan_payment_tag .'</span>
                                </div>
                            </article>';
            }
            echo $output;
        } else {
            echo "<p style='text-align: center;'>Ainda não temos publicações.</p>";
        }
    }
    add_shortcode('show_plans', 'get_plans');
}

////////////////////////////////////////////////////////////////////////////////////////////////
// Homepage Contact section
////////////////////////////////////////////////////////////////////////////////////////////////
if( !function_exists('create_contact_section') ){
    function create_contact_section(){

        $email_support                 = get_option('contact_email_support');
        $email_comercial               = get_option('contact_email_comercial');
        $phone                         = get_option('contact_phone');
        $whatsapp                      = get_option('contact_whatsapp');
        $street                        = get_option('contact_street');
        $city                          = get_option('contact_city');
        $cep                           = get_option('contact_cep');
        $cnpj                          = get_option('contact_cnpj');
        $hours_business_day            = get_option('contact_hours_business_day');
        $hours_saturday                = get_option('contact_hours_saturday');

        // Tratamento para chamada da função que cria o card
        $arr_email          = array($email_support, $email_comercial);
        $arr_tel            = array($phone, $whatsapp);
        $arr_office_hours   = array($hours_business_day, $hours_saturday);
        $arr_address        = array($street, $city);

        // Chamada dos cards
        card_phone_contact('Telefone(s)', 'phone', array('Telefone loja', 'WhatsApp'), $arr_tel);
        card_phone_contact('E-mails(s)', 'email', array('E-mail suporte', 'E-mail comercial'), $arr_email);
        card_phone_contact('Endereço', 'map', array('Rua/Logradouro', 'Cidade'), $arr_address);
        card_phone_contact('Horário de atendimento', 'clock', array('Segunda à sexta feira', 'Sábado'), $arr_office_hours);
        echo '<span class="contactCard__help">Clique no botão para abrir</span>';

        $html = '';
        $html .= '<div class="contactCard contactCard__display--mobile">
                    <h3 class="contactCard__title contactCard__title--semiBold">Horário de atendimento</h3>
                    <span class="contactCard__spacer"></span>
                    <ul class="contactCard__list contactCard__list--expandMobile">
                        <li class="contactCard__listItem">
                            <span class="contactCard__tag">Segunda à sexta feira</span>
                            <p class="contactCard__info">'. $hours_business_day .'</p>
                        </li>
                        <span class="contactCard__spacer"></span>
                        <li class="contactCard__listItem">
                            <span class="contactCard__tag">Sábado</span>
                            <p class="contactCard__info">'. $hours_saturday .'</p>
                        </li>
                    </ul>
                </div>';
        echo $html;
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
            <p class="footer__text footer__text--copyright" style="width: 100%; text-align: center; font-size: 1.2em">Todos os direitos reservados NautilusNet 2019</p>
        </div>
        <?php
    }
    add_shortcode('show_footer_type_1', 'create_footer_type1');
}


////////////////////////////////////////////////////////////////////////////////////////////////
// Simple-fast contact app
////////////////////////////////////////////////////////////////////////////////////////////////
if( !function_exists('simple_contact_app') ){
    function simple_contact_app(){
        // Informações para contato
        $get_whatsapp       = get_option('contact_whatsapp');
        $get_tel            = get_option('contact_phone');
        $arr_caracteres     = array('-', ' ', '(', ')');

        $whatsapp_number    = str_replace($arr_caracteres, '', $get_whatsapp);
        $tel_number         = str_replace($arr_caracteres, '', $get_tel);

        //
        $html = '<div id="" class="simpleContact">        
                    <ul class="simpleContact__list simpleContact__list--hide">
                        <li class="simpleContact__listItem"><a target="_blank" href="https://wa.me/55'. $whatsapp_number .'" class="simpleContact__link">WhatsApp <i class="simpleContact__icon" data-eva="message-circle"></i></a></li>
                        <li class="simpleContact__listItem"><a target="_blank" href="tel:+55'. $tel_number .'" class="simpleContact__link">Telefone <i class="simpleContact__icon" data-eva="phone-call"></i></a></li>
                    </ul>

                    <button onclick="openSimpleSupport(jQuery(this))" class="simpleContact__buttonSelect simpleContact__buttonSelect--online"><i class="simpleContact__buttonIcon simpleContact__buttonIcon--online" data-eva="person-done"></i>Suporte online</button>
                    <span class="simpleContact__information simpleContact__information--hide">Ao selecionar a opção desejada uma nova aba sera aberta</span>
                </div>';
        
        echo $html;
    }
    add_shortcode('simple_contact', 'simple_contact_app');    
    // <button onclick="openSimpleSupport(jQuery(this))" class="simpleContact__buttonSelect simpleContact__buttonSelect--online"><span class="simpleContact__bubble simpleContact__bubble--online"></span>Suporte online</button>
}

////////////////////////////////////////////////////////////////////////////////////////////////
// Similar posts aside
////////////////////////////////////////////////////////////////////////////////////////////////
if( !function_exists('get_similar_posts_aside') ){
    function get_similar_posts_aside(){
        $post_type      = 'post';
        $order          = 'DESC';
        $orderby        = 'date';
        $status         = 'publish';
        $number_posts   = '4';
        
        $args = array(
            'post_type'         => $post_type,
            'cat'               => $category,
            'order'             => $order,
            'orderby'           => $orderby,
            'post_status'       => $status,
            'posts_per_page'    => $number_posts
        );
    
        $similar_posts = new WP_Query($args);
        $output = '';

        $output .= '<h3 class="asideBox__title">Posts populares</h3>';
        if( $similar_posts->have_posts() ){
            $output .= '<ul id="" class="similarList">';
            while( $similar_posts->have_posts() ){
                $similar_posts->the_post();
                $post_id        = get_the_ID();
                $post_title     = get_the_title($post_id);
                $post_thumb_url = get_the_post_thumbnail_url($post_id);
                $post_link      = get_the_permalink($post_id);

                $output .= '<li class="similarList__item row">
                                <div class="similarList__wrap col-lg-4">
                                    <img src="'. $post_thumb_url .'" alt="" class="similarList__thumb">
                                </div>
                                <div class="similarList__wrap col-lg-8">
                                    <a href="'. $post_link .'" alt="" target="_parent" class="similarList__title">'. $post_title .'</a>
                                    <span class="similarList__label">4 Minuto(s) de leitura</span>
                                </div>
                            </li>';
                
            }
            $output .= '</ul>';
            echo $output;
        } else {
            echo "Não encontramos notificações";
        }
    }
    add_shortcode('similar_posts_aside', 'get_similar_posts_aside');
}

////////////////////////////////////////////////////////////////////////////////////////////////
// Social network items
////////////////////////////////////////////////////////////////////////////////////////////////
if( !function_exists('create_widget_social_network') )
{
    function create_widget_social_network()
    {
        $theme_name         = get_bloginfo('name');
        $page_facebook      = get_option('facebook_page');
        $page_instagram     = get_option('instagram_page');
        $page_twitter       = get_option('twitter_page');
        $channel_youtube    = get_option('youtube_channel');
        ?>

        <h3 class="asideBox__title">Redes sociais</h3>
        <ul class="socialNetworkList">
            <li class="socialNetworkList__item">
                <a href="<?php echo $page_facebook ?>" target="_blank" alt="Página facebook <?php echo $theme_name ?>" class="socialNetworkList__link">
                    <img src="<?php echo get_template_directory_uri() . '/images/social_facebook.svg' ?>" alt="Página facebook <?php echo $theme_name ?>" class="socialNetworkList__icon">
                </a>
            </li>
            <li class="socialNetworkList__item">
                <a href="<?php echo $page_instagram ?>" target="_blank" alt="Página instagram <?php echo $theme_name ?>" class="socialNetworkList__link">
                    <img src="<?php echo get_template_directory_uri() . '/images/social_instagram.svg' ?>" alt="Página instagram <?php echo $theme_name ?>" class="socialNetworkList__icon">
                </a>
            </li>
            <li class="socialNetworkList__item">
                <a href="<?php echo $page_twitter ?>" target="_blank" alt="Página Twitter <?php echo $theme_name ?>" class="socialNetworkList__link">
                    <img src="<?php echo get_template_directory_uri() . '/images/social_twitter.svg' ?>" alt="Página twitter <?php echo $theme_name ?>" class="socialNetworkList__icon">
                </a>
            </li>
            <li class="socialNetworkList__item">
                <a href="<?php echo $channel_youtube ?>" target="_blank" alt="Página youtube <?php echo $theme_name ?>" class="socialNetworkList__link">
                    <img src="<?php echo get_template_directory_uri() . '/images/social_youtube.svg' ?>" alt="Página youtube <?php echo $theme_name ?>" class="socialNetworkList__icon">
                </a>
            </li>
        </ul>
        <?php
    }
    add_shortcode('widget_social_network', 'create_widget_social_network');
}

////////////////////////////////////////////////////////////////////////////////////////////////
// Widget Share post
////////////////////////////////////////////////////////////////////////////////////////////////
if( !function_exists('create_widget_share_post') )
{
    function create_widget_share_post()
    {
        ?>
        <div class="widgetShare">
            <span class="widgetShare__title">Compartilhe</span>

            <ul class="shareList">
                <li class="shareList__item">
                    <a href="<?php the_permalink(); ?>" data-layout="button_count" class="shareList__link fb-share-button">
                        <i class="shareList__icon" data-eva="undo"></i>
                        <span class="shareList__text">Compartilhar no facebook</span>
                    </a>
                </li>
                <li class="shareList__item">
                    <a href="<?php the_permalink(); ?>" class="shareList__link twitter-share-button">
                        <i class="shareList__icon" data-eva="repeat"></i>
                        <span class="shareList__text">Tweetar</span>
                    </a>
                </li>
                <li class="shareList__item">
                    <a href="" class="shareList__link">
                        <i class="shareList__icon" data-eva="message-square"></i>
                        <span class="shareList__text">Enviar no WhatsApp</span>
                    </a>
                </li>
            </ul>
        </div>
        
        <?php
    }
    add_shortcode('widget_share_post', 'create_widget_share_post');
}

////////////////////////////////////////////////////////////////////////////////////////////////
// Widget adsense local
////////////////////////////////////////////////////////////////////////////////////////////////
if (!function_exists('create_widget_adsense'))
{
    function create_widget_adsense(){
        if(!is_single())
        {
            echo 'Widget só funciona em publicações';
            die;
        }
        $adsense_img = '';
        $default_img = get_template_directory_uri() . '/images/no_thumb.svg';

        ?>
        <div class="widgetAdsense">
            <figure class="widgetAdsense__wrapper">
                <img src="<?php $adsense_img != '' ? print $adsense_img : print $default_img; ?>" alt="" class="widgetAdsense__img">
                <figcaption class="widgetAdsense__label">Adsense 320x250px</figcaption>
            </figure>            
        </div>
        <?php
    }
    add_shortcode('widget_adsense', 'create_widget_adsense');
}
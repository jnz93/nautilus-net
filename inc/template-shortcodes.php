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
        $number_posts   = '3';
        
        $args = array(
            'post_type'         => $post_type,
            'cat'               => $category,
            'order'             => $order,
            'orderby'           => $orderby,
            'post_status'       => $status,
            'posts_per_page'    => $number_posts
        );
        ?>
        <div class="swiper-container" style="height: 100%;">
            <div class="swiper-wrapper">
            
                <?php
                $posts_homepage = new WP_Query($args);
                $output = '';
                if( $posts_homepage->have_posts() ){
                    while( $posts_homepage->have_posts() ){
                        $posts_homepage->the_post();
                        $post_id        = get_the_ID();
                        $publish_date   = get_the_date('l,j,F', $post_id);
                        $post_title     = get_the_title($post_id);
                        $post_excerpt   = get_the_excerpt($post_id);
                        $post_thumb_url = get_the_post_thumbnail_url($post_id);
                        $post_link      = get_the_permalink($post_id);?>
                        
                        <article id="<?php echo $post_id; ?>" class="swiper-slide articleHome" style="background-image: url('<?php echo $post_thumb_url ?>')">
                            <div class="col-lg-12 row articleHome__content">
                                <div class="col-lg-6 articleHome__content--desktop">
                                    <h1 class="articleHome__title"><?php echo $post_title ?></h1>
                                    <p class="articleHome__excerpt"><?php echo $post_excerpt ?></p>
                                    <a href="<?php echo $post_link ?>" class="btn btn__primary btn__primary--big">Ler publicação</a>
                                </div> <!-- /End title, excerpt and button container desktop-->
                                <div class="col-xs-10 col-sm-10 articleHome__content--mobile">
                                    <a href="<?php echo $post_link ?>">
                                        <h1 class="articleHome__title"><?php echo $post_title ?></h1>
                                        <p class="articleHome__excerpt"><?php echo $post_excerpt ?></p>
                                    </a>
                                </div><!-- /End title, excerpt and button container mobile -->
                                <div class="col-lg-12">
                                    <?php do_shortcode('[widget_share_options]'); ?>
                                </div>
                            </div>
                        </article>
                        <?php
                    }
                } else {
                    echo "Não encontramos notificações. :)";
                }?>
                </div>
                <div class="swiper-pagination paginationSlider"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
        </div>
        <?php
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

                    <button onclick="openSimpleSupport(jQuery(this))" class="simpleContact__buttonSelect simpleContact__buttonSelect--online">
                        <i class="simpleContact__buttonIcon" data-eva="message-circle"></i>
                    </button>
                </div>';
        
        echo $html;
    }
    add_shortcode('simple_contact', 'simple_contact_app');
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

        $output .= '<h3 class="asideBox__title">Posts recentes</h3>';
        if( $similar_posts->have_posts() ){
            $output .= '<ul id="" class="listPosts">';
            while( $similar_posts->have_posts() ){
                $similar_posts->the_post();
                $post_id        = get_the_ID();
                $post_title     = get_the_title($post_id);
                $post_thumb_url = get_the_post_thumbnail_url($post_id);
                $post_link      = get_the_permalink($post_id);

                $output .= '<li class="listPosts__item row">
                                <a href="'. $post_link .'" alt="" target="_parent" class="listPosts__link row col-12">
                                <div class="listPosts__wrap col-xs-3 col-sm-3 col-md-4 col-lg-4">
                                    <img src="'. $post_thumb_url .'" alt="" class="listPosts__thumb">
                                </div>
                                <div class="listPosts__wrap col-xs-9 col-sm-9 col-md-8 col-lg-8">
                                    <h4 class="listPosts__title">'. $post_title .'</h4>
                                    <span class="listPosts__label">4 Minuto(s) de leitura</span>
                                </div>
                                </a>
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
            <?php if ($page_facebook != '') : ?>
            <li class="socialNetworkList__item">
                <a href="<?php echo $page_facebook ?>" target="_blank" alt="Página facebook <?php echo $theme_name ?>" class="socialNetworkList__link">
                    <img src="<?php echo get_template_directory_uri() . '/images/social_facebook.svg' ?>" alt="Página facebook <?php echo $theme_name ?>" class="socialNetworkList__icon">
                </a>
            </li>
            <?php endif; 
            if ($page_instagram != '') : ?>
            <li class="socialNetworkList__item">
                <a href="<?php echo $page_instagram ?>" target="_blank" alt="Página instagram <?php echo $theme_name ?>" class="socialNetworkList__link">
                    <img src="<?php echo get_template_directory_uri() . '/images/social_instagram.svg' ?>" alt="Página instagram <?php echo $theme_name ?>" class="socialNetworkList__icon">
                </a>
            </li>
            <?php endif;
            if ($page_twitter != '') : ?>
            <li class="socialNetworkList__item">
                <a href="<?php echo $page_twitter ?>" target="_blank" alt="Página Twitter <?php echo $theme_name ?>" class="socialNetworkList__link">
                    <img src="<?php echo get_template_directory_uri() . '/images/social_twitter.svg' ?>" alt="Página twitter <?php echo $theme_name ?>" class="socialNetworkList__icon">
                </a>
            </li>
            <?php endif;
            if ($channel_youtube != '') : ?>
            <li class="socialNetworkList__item">
                <a href="<?php echo $channel_youtube ?>" target="_blank" alt="Página youtube <?php echo $theme_name ?>" class="socialNetworkList__link">
                    <img src="<?php echo get_template_directory_uri() . '/images/social_youtube.svg' ?>" alt="Página youtube <?php echo $theme_name ?>" class="socialNetworkList__icon">
                </a>
            </li>
            <?php endif; ?>
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
        $title      = urlencode(get_the_title());
        $url        = urlencode(get_the_permalink());
        $summary    = urlencode(get_the_excerpt());
        $excerpt    = get_the_excerpt();
        $image      = urlencode(get_the_post_thumbnail_url());
        ?>
        <div class="widgetShare">
            <span class="widgetShare__title">Compartilhe</span>
            <ul class="shareList">
                <li class="shareList__item">
                
                    <script>
                    function open_dialog_share(){
                        window.open('http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo $title;?>&amp;p[summary]=<?php echo $summary;?>&amp;p[url]=<?php echo $url; ?>&amp;&p[images][0]=<?php echo $image;?>', 'sharer', 'toolbar=0,status=0,width=620,height=280');
                    }
                    </script>

                    <a onclick="open_dialog_share()" href="javascript: void(0)" class="shareList__link">
                        <i class="shareList__icon" data-eva="undo"></i>
                        <span class="shareList__text">Compartilhar no facebook</span>
                    </a>
                </li>
                <li class="shareList__item">
                    <a href="https://twitter.com/share?ref_src=<?php echo $url ?>" class="shareList__link" target="_blank" data-text="<?php echo $excerpt; ?>" data-hashtags="nautilusnet" data-show-count="false">
                        <i class="shareList__icon" data-eva="repeat"></i>
                        <span class="shareList__text">Tweetar</span>
                    </a>
                </li>
                <li class="shareList__item">
                    <a href="https://wa.me/?text=<?php echo $url ?>" data-action="share/whatsapp" class="shareList__link" target="_blank">
                        <i class="shareList__icon" data-eva="message-square"></i>
                        <span class="shareList__text">Enviar no WhatsApp</span>
                    </a>
                    <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
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


////////////////////////////////////////////////////////////////////////////////////////////////
// Shortcode: custom_logotipo
////////////////////////////////////////////////////////////////////////////////////////////////
if (!function_exists('get_custom_logotipo'))
{
    function get_custom_logotipo()
    {     
        if( has_custom_logo() ){
            $logo_id        = get_theme_mod('custom_logo');
            $logo_url       = wp_get_attachment_image_src($logo_id, 'medium');
            $site_name      = get_bloginfo('name');
            $site_url       = get_bloginfo('url');

            $output =   '<figure id="" class="logo">
                            <a href="'. $site_url .'" target="_parent">
                            <img src="'. $logo_url[0] .'" id="" class="logo__image" alt="'. $site_name .'">
                            </a>
                        </figure>';
            
            echo $output;
        } else {
            echo "Adicione um logotipo";
        }
    }
    add_shortcode('custom_logotipo', 'get_custom_logotipo');
}


////////////////////////////////////////////////////////////////////////////////////////////////
// Shortcode: menu_fixed
////////////////////////////////////////////////////////////////////////////////////////////////
if( ! function_exists('get_menu_fixed') ){
    function get_menu_fixed()
    {
        $args_menu = array(
            'menu'              => 'Menu Fixo',
            'menu_class'        => 'masterMenu',
            'menu_id'           => '',
            'container'         => 'div',
            'container_class'   => 'mainMenuContainer',
            'container_id'      => 'master-menu',
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
    add_shortcode('menu_fixed', 'get_menu_fixed');
}

////////////////////////////////////////////////////////////////////////////////////////////////
// Widget Share post
////////////////////////////////////////////////////////////////////////////////////////////////
if( !function_exists('create_widget_share_options') )
{
    function create_widget_share_options()
    {
        $title      = urlencode(get_the_title());
        $url        = urlencode(get_the_permalink());
        $summary    = urlencode(get_the_excerpt());
        $excerpt    = get_the_excerpt();
        $image      = urlencode(get_the_post_thumbnail_url());
        ?>
        <ul class="shareList">
            <li class="shareList__item">
            
                <script>
                function open_dialog_share(){
                    window.open('http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo $title;?>&amp;p[summary]=<?php echo $summary;?>&amp;p[url]=<?php echo $url; ?>&amp;&p[images][0]=<?php echo $image;?>', 'sharer', 'toolbar=0,status=0,width=620,height=280');
                }
                </script>

                <a onclick="open_dialog_share()" href="javascript: void(0)" class="shareList__link" title="Compartilhar no facebook">
                    <i class="shareList__icon" data-eva="undo"></i>
                </a>
            </li>
            <li class="shareList__item">
                <a href="https://twitter.com/share?ref_src=<?php echo $url ?>" class="shareList__link" target="_blank" data-text="<?php echo $excerpt; ?>" data-hashtags="nautilusnet" data-show-count="false" title="Tweetar esse post">
                    <i class="shareList__icon" data-eva="repeat"></i>
                </a>
            </li>
            <li class="shareList__item">
                <a href="https://wa.me/?text=<?php echo $url ?>" data-action="share/whatsapp" class="shareList__link" target="_blank" title="Compartilhar no whatsapp">
                    <i class="shareList__icon" data-eva="message-square"></i>
                </a>
                <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
            </li>
        </ul>
        
        <?php
    }
    add_shortcode('widget_share_options', 'create_widget_share_options');
}

////////////////////////////////////////////////////////////////////////////////////////////////
// Menu de navegação da singlepage
////////////////////////////////////////////////////////////////////////////////////////////////
if (!function_exists('get_navigation_singlepage'))
{
    function get_navigation_singlepage()
    {
        $args_menu = array(
            'menu'              => 'navigation-singlepage',
            'menu_class'        => 'navList',
            'menu_id'           => '',
            'container'         => 'nav',
            'container_class'   => 'navSinglepage',
            'container_id'      => 'master-menu',
            'fallback_cb'       => '', #Se não existir o menu chama uma função que será executada. Padrão 'wp_page_menu'.
            'before'            => '',
            'after'             => '',
            'link_before'       => '',
            'link_after'        => '',
            'echo'              => true,
            'depth'             => '',
            'walker'            => '', 
            'theme_location'    => 'navigation-singlepage',
            'item_spacing'      => ''
        );

        return wp_nav_menu($args_menu);
    }
    add_shortcode('navigation_singlepage', 'get_navigation_singlepage');
}

////////////////////////////////////////////////////////////////////////////////////////////////
// Widget para mostrar horário comercial da loja
////////////////////////////////////////////////////////////////////////////////////////////////
if (!function_exists("store_comercial_hour"))
{
    function store_comercial_hour(){
        // Horários de funcionamento
        $get_week_comercial_hour        = get_option('contact_hours_business_day');
        $get_saturdary_comercial_hour   = get_option('contact_hours_saturday');

        // Tratamento dos horários da semana
        $get_week_comercial_hour        = explode('~', $get_week_comercial_hour);
        $morning_comercial_hour         = $get_week_comercial_hour[0];
        $afternoon_comercial_hour       = $get_week_comercial_hour[1];

        $morning_hour_arr               = explode('-', $morning_comercial_hour);
        $morning_start_hour             = trim($morning_hour_arr[0]);
        $morning_end_hour               = trim($morning_hour_arr[1]);
        $morning_start_hour             = explode(':', $morning_start_hour);
        $morning_end_hour               = explode(':', $morning_end_hour);
        $start_morning                  = trim($morning_start_hour[0]);
        $end_morning                    = trim($morning_end_hour[0]);

        $afternoon_hour_arr             = explode('-', $afternoon_comercial_hour);
        $afternoon_start_hour           = trim($afternoon_hour_arr[0]);
        $afternoon_end_hour             = trim($afternoon_hour_arr[1]);
        $afternoon_start_hour           = explode(':', $afternoon_start_hour);
        $afternoon_end_hour             = explode(':', $afternoon_end_hour);
        $start_afternoon                = trim($afternoon_start_hour[0]);
        $end_afternoon                  = trim($afternoon_end_hour[0]);

        // Tratamento com horários de sábado
        $saturday_comercial_hour        = explode('-', $get_saturdary_comercial_hour);
        $saturday_start_hour            = trim($saturday_comercial_hour[0]);
        $saturday_start_hour_arr        = explode(':', $saturday_start_hour);
        $saturday_start_hour            = $saturday_start_hour_arr[0];

        $saturday_end_hour              = trim($saturday_comercial_hour[1]);
        $saturday_end_hour_arr          = explode(':', $saturday_end_hour);
        $saturday_end_hour              = $saturday_end_hour_arr[0];
        

        // Hora e configurações para comparação
        $curr_hour = date('H') - 3;
        $curr_day  = date('l');
        // print $curr_hour . " - " . $curr_day;
        if ($curr_day == 'Sunday')
        {
            echo 
            '<div class="infoWrapper">
                <i class="infoWrapper__icon infoWrapper__icon--offline" data-eva="radio-button-on"></i><p class="infoWrapper__text infoWrapper__text--offline"> A loja está fechada</p>
            </div>';
        } 
        else if ($curr_day == 'Saturday')
        {
            if ($curr_hour >= $saturday_start_hour && $curr_hour <= $saturday_end_hour)
            {
                echo '<i class="infoWrapper__icon infoWrapper__icon--online" data-eva="radio-button-on"></i><p class="infoWrapper__text infoWrapper__text--online"> A loja está aberta</p>';
            }
            else 
            {
                echo '<i class="infoWrapper__icon infoWrapper__icon--offline" data-eva="radio-button-on"></i><p class="infoWrapper__text infoWrapper__text--offline"> A loja está fechada</p>';
            }
        } 
        else 
        {
            if ($curr_hour > $end_morning && $curr_hour < $start_afternoon)
            {
                echo '<i class="infoWrapper__icon infoWrapper__icon--offline" data-eva="radio-button-on"></i><p class="infoWrapper__text infoWrapper__text--offline"> Horário de almoço. Voltaremos as 14:00 Horas.</p>';
            }
            else if ($curr_hour >= $start_morning && $curr_hour <= $end_morning)
            {
                echo '<i class="infoWrapper__icon infoWrapper__icon--online" data-eva="radio-button-on"></i><p class="infoWrapper__text infoWrapper__text--online"> A loja está aberta</p>';
            }
            else if ($curr_hour >= $start_afternoon && $curr_hour <= $end_afternoon)
            {
                echo '<i class="infoWrapper__icon infoWrapper__icon--online" data-eva="radio-button-on"></i><p class="infoWrapper__text infoWrapper__text--online"> A loja está aberta</p>';
            }
            else
            {
                echo '<i class="infoWrapper__icon infoWrapper__icon--offline" data-eva="radio-button-on"></i><p class="infoWrapper__text infoWrapper__text--offline"> A loja está fechada</p>';
            }
        }
    }
    add_shortcode('store_comercial_attendance', 'store_comercial_hour');
}

////////////////////////////////////////////////////////////////////////////////////////////////
// Widget informações para contato
////////////////////////////////////////////////////////////////////////////////////////////////
if (!function_exists("widget_contact_infos"))
{
    function widget_contact_infos()
    {
        $telephoneNumber      = get_option('contact_phone');
        $callAppsNumber       = get_option('contact_whatsapp');
        
        $arr_caracteres     = array('-', ' ', '(', ')');
        $sanitized_phoneNumber = str_replace($arr_caracteres, '', $telephoneNumber);
        $sanitized_appNumber = str_replace($arr_caracteres, '', $callAppsNumber);
        
        $address              = get_option('contact_street');
        $city                 = get_option('contact_city');

        $parameters           = $address . ',' . $city;
        $place_id             = 'ChIJ32l0tncR8ZQR-hGkFGb2frY';
        ?>
        <ul class="infoList">
            <li class="infoList__item">
                <a href="https://www.google.com/maps/search/?api=1&query=<?php echo $parameters ?>&query_place_id=<?php echo $place_id ?>" target="_blank" title="Ver no Google Maps">
                    <i class="infoList__icon" data-eva="pin"></i>
                    <span class="infoList__text"><?php echo $address ?> - <?php echo $city ?></span>
                </a>
            </li>

            <li class="infoList__item">
                <a href="https://wa.me/55<?php echo $sanitized_appNumber ?>" target="_blank" title="Conversar no Whatsapp">
                    <i class="infoList__icon" data-eva="message-circle"></i>
                    <span class="infoList__text"><?php echo $callAppsNumber ?></span>
                </a>
            </li>

            <li class="infoList__item">
                <a href="tel:+55<?php echo $sanitized_phoneNumber ?>" title="Ligar para o suporte">
                    <i class="infoList__icon" data-eva="phone-call"></i>
                    <span class="infoList__text"><?php echo $telephoneNumber ?></span>
                </a>
            </li>
        </ul> 
        <?php
    }
    add_shortcode('menu_contact_infos', 'widget_contact_infos');
}
<?php
/**
 * The assistent of functions.php
 * 
 * @package nautilusnet
 */

/**
 * Página de configurações
 * 
 * @link https://codex.wordpress.org/Creating_Options_Pages
 */
add_action('admin_menu', 'add_menu_options');
if( !function_exists('add_menu_options') ){
    
    function add_menu_options(){
        // add_options_page('Configurações do tema', 'Configurações do tema', '10', 'theme-setup-options', 'theme_options_page');
        add_menu_page('Página de configurações', 'Configurações NautilusNet', 'administrator', 'configuracoes-nautilusnet', 'theme_options_page');
    }

    // Call register settings menu
    add_action('admin_init', 'register_nautilus_settings');
}

// Callback register_nautilus_settings
if( !function_exists('register_nautilus_settings') ){
    
    function register_nautilus_settings(){
        register_setting('contact-settings-group', 'contact_email_support');
        register_setting('contact-settings-group', 'contact_email_comercial');

        register_setting('contact-settings-group', 'contact_phone');
        register_setting('contact-settings-group', 'contact_whatsapp');

        register_setting('contact-settings-group', 'contact_street');
        register_setting('contact-settings-group', 'contact_city');
        register_setting('contact-settings-group', 'contact_cep');
        register_setting('contact-settings-group', 'reference_point');

        register_setting('contact-settings-group', 'contact_cnpj');

        register_setting('contact-settings-group', 'contact_hours_business_day');
        register_setting('contact-settings-group', 'contact_hours_saturday');
        
        register_setting('contact-settings-group', 'google_analitycs');

        register_setting('contact-settings-group', 'facebook_page');
        register_setting('contact-settings-group', 'instagram_page');
        register_setting('contact-settings-group', 'twitter_page');
        register_setting('contact-settings-group', 'youtube_channel');
    }
}


// Callback form
if( !function_exists('theme_options_page') ){
    
    function theme_options_page(){

        // Se não tiver permissões
        if( ! current_user_can('manage_options') ){
            wp_die(__('Você não tem permissões suficientes para acessar esta página.'));
        }

        // Configurações do tema
        $theme          = wp_get_theme();
        $theme_name     = $theme->get('Name');
        $theme_version  = $theme->get('Version');

        // Valores atuais
        $curr_email_support                 = get_option('contact_email_support');
        $curr_email_comercial               = get_option('contact_email_comercial');
        $curr_phone                         = get_option('contact_phone');
        $curr_whatsapp                      = get_option('contact_whatsapp');
        $curr_street                        = get_option('contact_street');
        $curr_city                          = get_option('contact_city');
        $curr_cep                           = get_option('contact_cep');
        $curr_reference_point               = get_option('reference_point');
        $curr_cnpj                          = get_option('contact_cnpj');
        $curr_hours_business_day            = get_option('contact_hours_business_day');
        $curr_hours_saturday                = get_option('contact_hours_saturday');
        $curr_google_analytics              = get_option('google_analitycs');
        $curr_facebook_page                 = get_option('facebook_page');
        $curr_instagram_page                = get_option('instagram_page');
        $curr_twitter_page                  = get_option('twitter_page');
        $curr_youtube_channel               = get_option('youtube_channel');

        ?>
        <!-- <h3 class="settingsPage__title settingsPage__title--medium">Informações de contato</h3>
        <p class="settingsPage__text settingsPage__text--medium">Essas informações serão mostradas na seção de contato da homepage e em outros cenários possíveis.</p> -->

        <section id="" class="settingsPage">

            <header class="row col-lg-12 settingsPage__headerSection">
                <h1 class="settingsPage__title settingsPage__title--big">Painel de controle <?php echo $theme_name ?></h1>
                <p class="settingsPage__text settingsPage__text--medium">As informações adicionadas aqui serão refletidas nas páginas do site.</p>
                <span class="settingsPage__text settingsPage__text--small settingsPage__text--alignRight">Versão: <?php echo $theme_version ?></span>
            </header>
            
            <form method="post" action="options.php" class="row col-lg-8 settingsPage__form">
                <?php 
                settings_fields('contact-settings-group'); 
                do_settings_sections('contact-settings-group');
                ?>
                
                <div class="row col-lg-12 settingsPage__wrapperGroup">
                    <div class="col-lg-12">
                        <h3 class="settingsPage__title settingsPage__title--small">E-mails para contato</h3>
                    </div>

                    <div class="col-lg-4 settingsPage__wrapInput">
                        <label for="contact_email_support" class="settingsPage__label">E-mail do suporte</label>
                        <input type="text" id="contact_email_support" name="contact_email_support" class="settingsPage__input" placeholder="" value="<?php echo ( empty($curr_email_support) ? '' : $curr_email_support ) ?>">
                    </div>
                    <div class="col-lg-4 settingsPage__wrapInput">
                        <label for="contact_email_comercial" class="settingsPage__label">E-mail do comercial</label>
                        <input type="text" id="contact_email_comercial" name="contact_email_comercial" class="settingsPage__input" placeholder="" value="<?php echo ( empty($curr_email_comercial) ? '' : $curr_email_comercial ) ?>">
                    </div>
                </div>

                <div class="row col-lg-12 settingsPage__wrapperGroup">
                    <div class="col-lg-12">
                        <h3 class="settingsPage__title settingsPage__title--small">Telefones</h3>
                    </div>
                    <div class="col-lg-4 settingsPage__wrapInput">
                        <label for="contact_phone" class="settingsPage__label">Telefone Loja</label>
                        <input type="tel" id="contact_phone" name="contact_phone" class="settingsPage__input" placeholder="" value="<?php echo ( empty($curr_phone) ? '' : $curr_phone ) ?>">
                    </div>
                    <div class="col-lg-4 settingsPage__wrapInput">
                        <label for="contact_whatsapp" class="settingsPage__label">Número Whatsapp</label>
                        <input type="tel" id="contact_whatsapp" name="contact_whatsapp" class="settingsPage__input" placeholder="" value="<?php echo ( empty($curr_whatsapp) ? '' : $curr_whatsapp ) ?>">
                    </div>
                </div>

                <div class="row col-lg-12 settingsPage__wrapperGroup">
                    <div class="col-lg-12">
                        <h3 class="settingsPage__title settingsPage__title--small">Endereço</h3>
                    </div>
                    <div class="col-lg-4 settingsPage__wrapInput">
                        <label for="contact_street" class="settingsPage__label">Rua/Logradouro</label>
                        <input type="text" id="contact_street" name="contact_street" class="settingsPage__input" placeholder="" value="<?php echo ( empty($curr_street) ? '' : $curr_street ) ?>">
                    </div>
                    <div class="col-lg-4 settingsPage__wrapInput">
                        <label for="contact_city" class="settingsPage__label">Cidade</label>
                        <input type="text" id="contact_city" name="contact_city" class="settingsPage__input" placeholder="" value="<?php echo ( empty($curr_city) ? '' : $curr_city ) ?>">
                    </div>
                    <div class="col-lg-4 settingsPage__wrapInput">
                        <label for="contact_cep" class="settingsPage__label">CEP</label>
                        <input type="text" id="contact_cep" name="contact_cep" class="settingsPage__input" placeholder="" value="<?php echo ( empty($curr_cep) ? '' : $curr_cep ) ?>">
                    </div>
                    <div class="col-lg-4 settingsPage__wrapInput">
                        <label for="reference_point" class="settingsPage__label">Ponto de referência</label>
                        <input type="text" id="reference_point" name="reference_point" class="settingsPage__input" placeholder="" value="<?php echo ( empty($curr_reference_point) ? '' : $curr_reference_point ) ?>">
                    </div>
                </div>

                <div class="row col-lg-12 settingsPage__wrapperGroup">
                    <div class="col-lg-12">
                        <h3 class="settingsPage__title settingsPage__title--small">Horários comerciais</h3>
                    </div>

                    <div class="col-lg-4 settingsPage__wrapInput">
                        <label for="contact_hours_business_day" class="settingsPage__label">Segunda à sexta feira</label>
                        <input type="text" id="contact_hours_business_day" name="contact_hours_business_day" class="settingsPage__input" placeholder="" value="<?php echo ( empty($curr_hours_business_day) ? '' : $curr_hours_business_day ) ?>">
                    </div>
                    <div class="col-lg-4 settingsPage__wrapInput">
                        <label for="contact_hours_saturday" class="settingsPage__label">Sábados</label>
                        <input type="text" id="contact_hours_saturday" name="contact_hours_saturday" class="settingsPage__input" placeholder="" value="<?php echo ( empty($curr_hours_saturday) ? '' : $curr_hours_saturday ) ?>">
                    </div>
                </div>

                <div class="row col-lg-12 settingsPage__wrapperGroup">
                    <div class="col-lg-12">
                        <h3 class="settingsPage__title settingsPage__title--small">Informações sobre a empresa</h3>
                    </div>
                    <div class="col-lg-4 settingsPage__wrapInput">
                        <label for="contact_cnpj" class="settingsPage__label">CNPJ</label>
                        <input type="text" id="contact_cnpj" name="contact_cnpj" class="settingsPage__input" placeholder="" value="<?php echo ( empty($curr_cnpj) ? '' : $curr_cnpj ) ?>">
                    </div>
                </div>

                <div class="row col-lg-12 settingsPage__wrapperGroup">
                    <div class="col-lg-12">
                        <h3 class="settingsPage__title settingsPage__title--small">Integrações externas</h3>
                    </div>
                    <div class="col-lg-4 settingsPage__wrapInput">
                        <label for="google_analitycs" class="settingsPage__label">Google Analytics ID</label>
                        <input type="text" id="google_analitycs" name="google_analitycs" class="settingsPage__input" placeholder="" value="<?php echo ( empty($curr_google_analytics) ? '' : $curr_google_analytics ) ?>">
                    </div>
                </div>

                <div class="row col-lg-12 settingsPage__wrapperGroup">
                    <div class="col-lg-12">
                        <h3 class="settingsPage__title settingsPage__title--small">Redes Sociais</h3>
                    </div>
                    <div class="col-lg-4 settingsPage__wrapInput">
                        <label for="facebook_page" class="settingsPage__label">Página do facebook</label>
                        <input type="text" id="facebook_page" name="facebook_page" class="settingsPage__input" placeholder="" value="<?php echo ( empty($curr_facebook_page) ? '' : $curr_facebook_page ) ?>">
                    </div>
                    <div class="col-lg-4 settingsPage__wrapInput">
                        <label for="instagram_page" class="settingsPage__label">Página do instagram</label>
                        <input type="text" id="instagram_page" name="instagram_page" class="settingsPage__input" placeholder="" value="<?php echo ( empty($curr_instagram_page) ? '' : $curr_instagram_page ) ?>">
                    </div>
                    <div class="col-lg-4 settingsPage__wrapInput">
                        <label for="twitter_page" class="settingsPage__label">Página do twitter</label>
                        <input type="text" id="twitter_page" name="twitter_page" class="settingsPage__input" placeholder="" value="<?php echo ( empty($curr_twitter_page) ? '' : $curr_twitter_page ) ?>">
                    </div>
                    <div class="col-lg-4 settingsPage__wrapInput">
                        <label for="youtube_channel" class="settingsPage__label">Canal do youtube</label>
                        <input type="text" id="youtube_channel" name="youtube_channel" class="settingsPage__input" placeholder="" value="<?php echo ( empty($curr_youtube_channel) ? '' : $curr_youtube_channel ) ?>">
                    </div>
                </div>

                <?php submit_button(); ?>
            </form>
        </section>
        <?php
    }
}

/**
 * Card contact
 * @param $icon = string
 * @param $title = string
 * @param $arr = array
 */
function card_contact($title, $arr){
    
    $html = '';
    $html .= '<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <div class="contactCard__cover"></div>
                <div onClick="clickOpenContactCardMobile(jQuery(this))" class="contactCard">
                    <h3 class="contactCard__title contactCard__title--semiBold">'. $title .'</h3>
                    <span class="contactCard__spacer"></span>
                    <ul class="contactCard__list">';
                    if( is_array($arr) ){
                        foreach( $arr as $item ){
                            $html .= '<li class="contactCard__listItem">';
                            $html .= '<span class="contactCard__tag">Identificação do item</span>';
                            $html .= '<p class="contactCard__info">'.$item.'</p>';
                            $html .= '<button class=""><i class="" data-eva="phone"></i>Fazer chamada</button>';
                            $html .= '</li>';
                            $html .= '<span class="contactCard__spacer"></span>';
                        }
                        
                    }
            $html .= '</ul>
                </div>
            </div>';

    echo $html ;
}


/**
 * Card Phone contact
 * @param $title_card = string com o título do cartão
 * @param $title_info = array com os títulos de cada informaçao
 * @param $icon = nome do icone utilizado no modo mobile
 * @param $arr_infos = array com as informações a serem escritas
 */
function card_phone_contact($title_card, $icon, $title_info, $arr_infos){
    $html = '';
    $html .= '<div data-wow-delay=".3s" class="wow bounceInUp col-xs-4 col-sm-4 col-md-6 col-lg-6 contactCard__flex contactCard__flex--alignCenter">
                <div class="contactCard__cover"></div>
                <button class="contactCard__closeBtn contactCard__closeBtn"><i class="" data-eva="close"></i></button>
                <div onClick="clickOpenContactCardMobile(jQuery(this))" class="contactCard">
                    <div class="contactCard__wrapIcon">
                        <i class="contactCard__icon" data-eva="'. $icon .'"></i>
                    </div>
                    <h3 class="contactCard__title contactCard__title--semiBold">'. $title_card .'</h3>
                    <span class="contactCard__spacer"></span>
                    <ul class="contactCard__list">
                        <li class="contactCard__listItem">
                            <span class="contactCard__tag">'. $title_info[0] .'</span>
                            <p class="contactCard__info">'. $arr_infos[0] .'</p>
                        </li>
                        <span class="contactCard__spacer"></span>
                        <li class="contactCard__listItem">
                            <span class="contactCard__tag">'. $title_info[1] .'</span>
                            <p class="contactCard__info">'. $arr_infos[1] .'</p>
                        </li>
                    </ul>
                </div>
            </div>';

    echo $html ;
}

// <button class=""><i class="" data-eva="whatsapp"></i>Iniciar conversa</button>
// <button class=""><i class="" data-eva="phone"></i>Fazer chamada</button>

/**
 * Custom logotipo nautilus na tela de login 
 * @hook login_enqueue_scripts
 * @link https://codex.wordpress.org/Customizing_the_Login_Form
 * */
function custom_company_logo(){
    $logo_id        = get_theme_mod('custom_logo');
    $logo_url       = wp_get_attachment_image_src($logo_id, 'medium');
    $site_name      = get_bloginfo('name');
    ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo $logo_url[0] ?>);
            height:120px;
            width:120px;
            background-size: 100%;
            background-repeat: no-repeat;
            padding-bottom: 30px;
            position: relative;
            color: blue;
            font-size: 24px;

            overflow: initial;
            text-indent: 0;
        }
        #login h1 a p{
            width: 400px;
            color: #2e3a59;
            font-weight: 700;
            text-indent: 0;
            position: absolute;
            bottom: 0;
            left: -140px;
        }
    </style>
    <?php
}
add_action('login_enqueue_scripts', 'custom_company_logo');

/**
 * Alterar link do logotipo
 * @hook login_headerurl
 * @link https://codex.wordpress.org/Customizing_the_Login_Form
 * */
function company_url_logo(){
    return get_bloginfo('url');
}
add_filter('login_headerurl', 'company_url_logo');

/**
 * Alterar título do logotipo
 * @hook login_headertitle
 * @link https://codex.wordpress.org/Customizing_the_Login_Form
 * */
function company_title_logo(){
    return '<p>' . get_bloginfo('name') . '</p>';
}
add_filter('login_headertitle', 'company_title_logo');


/**
 * Google Analytics tracking
 * Retorna snippet gtag para indexação do site
 * 
 * @param $g_analytics_id
 */
function snippet_ganalytics(){
    $g_analytics_id = get_option('google_analitycs');
    $snippet_js = '<script async src="https://www.googletagmanager.com/gtag/js?id='. $g_analytics_id .'"></script><script>window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag("js", new Date()); gtag("config", "'. $g_analytics_id .'");</script>';

    echo $snippet_js;
}

?>
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
        register_setting('contact-settings-group', 'contact_email');
        register_setting('contact-settings-group', 'contact_phone');
        register_setting('contact-settings-group', 'contact_whatsapp');
        register_setting('contact-settings-group', 'contact_address');
        register_setting('contact-settings-group', 'contact_cep');
        register_setting('contact-settings-group', 'contact_cnpj');
        register_setting('contact-settings-group', 'contact_office_hours');
    }
}


// Callback form
if( !function_exists('theme_options_page') ){
    
    function theme_options_page(){

        // Se não tiver permissões
        if( ! current_user_can('manage_options') ){
            wp_die(__('Você não tem permissões suficientes para acessar esta página.'));
        }

        // Valores salvos
        $curr_contact_email             = get_option('contact_email');
        $curr_contact_phone             = get_option('contact_phone');
        $curr_contact_whatsapp          = get_option('contact_whatsapp');
        $curr_contact_address           = get_option('contact_address');
        $curr_contact_cep               = get_option('contact_cep');
        $curr_contact_cnpj              = get_option('contact_cnpj');
        $curr_contact_office_hours      = get_option('contact_office_hours');
        ?>
        <section id="" class="container-fluid sctSetupTheme">
            <h1 class="sctSetupTheme__title">Painel de configurações do tema</h1>
            <form method="post" action="options.php" class="formSetup">
                <?php 
                settings_fields('contact-settings-group'); 
                do_settings_sections('contact-settings-group');
                ?>
                <h3 class="formSetup__title">Informações de contato</h3>
                <p class="formSetup__text">Essas informações serão mostradas na seção de contato da homepage e em outros cenários possíveis.</p>

                <div class="col-lg-6">
                    <div class="formSetup__wrapInput">
                        <label for="contact_email" class="">E-mail para contato</label>
                        <input type="text" id="contact_email" name="contact_email" class="" placeholder="" value="<?php echo ( empty($curr_contact_email) ? '' : $curr_contact_email ) ?>">
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="formSetup__wrapInput">
                        <label for="contact_phone" class="">Telefone fixo</label>
                        <input type="tel" id="contact_phone" name="contact_phone" class="" placeholder="" value="<?php echo ( empty($curr_contact_phone) ? '' : $curr_contact_phone ) ?>">
                    </div>
                    <div class="formSetup__wrapInput">
                        <label for="contact_whatsapp" class="">Whatsapp</label>
                        <input type="tel" id="contact_whatsapp" name="contact_whatsapp" class="" placeholder="" value="<?php echo ( empty($curr_contact_whatsapp) ? '' : $curr_contact_whatsapp ) ?>">
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="formSetup__wrapInput">
                        <label for="contact_address" class="">Endereço</label>
                        <input type="text" id="contact_address" name="contact_address" class="" placeholder="" value="<?php echo ( empty($curr_contact_address) ? '' :$curr_contact_address ) ?>">
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="formSetup__wrapInput">
                        <label for="contact_cep" class="">CEP</label>
                        <input type="text" id="contact_cep" name="contact_cep" class="" placeholder="" value="<?php echo ( empty($curr_contact_cep) ? '' : $curr_contact_cep ) ?>">
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="formSetup__wrapInput">
                        <label for="contact_cnpj" class="">CNPJ</label>
                        <input type="text" id="contact_cnpj" name="contact_cnpj" class="" placeholder="" value="<?php echo ( empty($curr_contact_cnpj) ? '' : $curr_contact_cnpj ) ?>">
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="formSetup__wrapInput">
                        <label for="contact_office_hours" class="">Horário de atendimento</label>
                        <input type="text" id="contact_office_hours" name="contact_office_hours" class="" placeholder="" value="<?php echo ( empty($curr_contact_office_hours) ? '' : $curr_contact_office_hours ) ?>">
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
?>
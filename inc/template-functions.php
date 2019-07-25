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
function card_contact($icon, $title, $arr){
    
    $html = '';
    $html .= '<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 contactCard">
                <div class="contactCard__header">
                    <span class="contactCard__icon"><i data-eva="'. $icon .'" data-width="" data-height="" data-fill=""></i></span>
                    <h3 class="contactCard__title">'. $title .'</h3>
                </div>
                <div class="contactCard__body">';
                if( is_array($arr) ){
                    foreach( $arr as $item ){
                        $html .= '<p class="contactCard__info">'.$item.'</p>';
                    }
                    
                }
        $html .= '</div>
            </div>';

    echo $html ;
}
?>
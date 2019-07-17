<?php
/**
 * Registro de meta-boxes para tipos específicos de posts
 * 
 * @package nautilusnet
 * @since 1.0.0
 * 
 * @link https://developer.wordpress.org/reference/functions/add_meta_box/
 */
global $post;
$post_id = $post->ID;

function nautilusnet_register_metaboxes(){
    #post-type: beneficios
    add_meta_box('mb-icon', 'Selecione um ícone', 'render_ipt_icon', 'beneficios');

    #post-type: planos
    add_meta_box('mb-speed-download', 'Velocidade de download', 'render_ipt_speed_download', 'planos');
    add_meta_box('mb-speed-upload', 'Velocidade de upload', 'render_ipt_speed_upload', 'planos');
    add_meta_box('mb-price-plan', 'Valor do plano', 'render_ipt_plan_price', 'planos');
    add_meta_box('mb-tag-payment', 'Regime do plano', 'render_ipt_tag_payment', 'planos');
    add_meta_box('mb-text-button', 'Texto do botão de conversão', 'render_ipt_text_button', 'planos');
}
add_action('add_meta_boxes', 'nautilusnet_register_metaboxes');

////////////////////////////////////////////////////////////////////////////////////////////////
// Callback input render: Ícone
////////////////////////////////////////////////////////////////////////////////////////////////
function render_ipt_icon($post){
    $curr_val       = get_post_meta($post->ID, 'benefit_icon', true);
    ?>
    <input type="text" name="benefit_icon" id="benefit_icon" class="" placeholder="<?php echo ($curr_val != "" ? $curr_val : 'Selecione o ícone para este plano') ?>"value="<?php echo ($curr_val != "" ? $curr_val : "")?>">
    <?php
}

////////////////////////////////////////////////////////////////////////////////////////////////
// Callback input render: Velocidade de download e upload
////////////////////////////////////////////////////////////////////////////////////////////////
function render_ipt_speed_download($post){
    $curr_val       = get_post_meta($post->ID, 'speed_download', true);
    ?>
    <input type="number" name="speed_download" class="" placeholder="<?php echo ($curr_val != "" ? $curr_val : 'Apenas números') ?>" value="<?php echo ($curr_val != "" ? $curr_val : "")?>">
    <?php
}

function render_ipt_speed_upload($post){
    $curr_val       = get_post_meta($post->ID, 'speed_upload', true);
    ?>
    <input type="number" name="speed_upload" class="" placeholder="<?php echo ($curr_val != "" ? $curr_val : 'Apenas números') ?>" value="<?php echo ($curr_val != "" ? $curr_val : "")?>">
    <?php
}

////////////////////////////////////////////////////////////////////////////////////////////////
// Callback input render: Valor do plano
////////////////////////////////////////////////////////////////////////////////////////////////
function render_ipt_plan_price($post){
    $curr_val       = get_post_meta($post->ID, 'plan_price', true);
    ?>
    <input type="number" name="plan_price" id="plan_price" class="" placeholder="<?php echo ($curr_val != "" ? $curr_val : "Apenas números") ?>" value="<?php echo ($curr_val != "" ? $curr_val : "")?>">
    <?php
}

////////////////////////////////////////////////////////////////////////////////////////////////
// Callback input render: Tag do regime do plano - Ex: /mês - /anual - /trimestral
////////////////////////////////////////////////////////////////////////////////////////////////
function render_ipt_tag_payment($post){
    $curr_val       = get_post_meta($post->ID, 'payment_tag', true);
    ?>
    <input type="text" name="payment_tag" id="payment_tag" class="" placeholder="<?php echo ($curr_val != "" ? $curr_val : "Ex: /Mês - /Trimestral - /Anual") ?>" value="<?php echo ($curr_val != "" ? $curr_val : "")?>">
    <?php
}

////////////////////////////////////////////////////////////////////////////////////////////////
// Callback input render: Tag do regime do plano - Ex: /mês - /anual - /trimestral
////////////////////////////////////////////////////////////////////////////////////////////////
function render_ipt_text_button($post){
    $curr_val       = get_post_meta($post->ID, 'plan_button_text', true);
    ?>
    <input type="text" name="plan_button_text" id="plan_button_text" class="" placeholder="<?php echo ($curr_val != "" ? $curr_val : "Texto do botão")?>" value="<?php echo ($curr_val != "" ? $curr_val : "")?>"> 
    <?php
}


/**
 * Função que salva e faz update nos meta-campos registrados acima
 * 
 * @link https://codex.wordpress.org/Function_Reference/update_post_meta
 */
function nautilusnet_save_metaboxes($post_id){

    if( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){
        return $post_id;
    }

    # Armazenar valores via $_POST para salvar posteriormente
    # post-type: beneficios
    $benefit_icon                   = $_POST['benefit_icon'];

    # post-type: planos
    $plan_speed_download            = $_POST['speed_download'];
    $plan_speed_upload              = $_POST['speed_upload'];
    $plan_price                     = $_POST['plan_price'];
    $plan_tag                       = $_POST['payment_tag'];
    $plan_button_text               = $_POST['plan_button_text'];

    # Update dos meta-campos
    update_post_meta($post_id, 'benefit_icon', $benefit_icon);
    update_post_meta($post_id, 'speed_download', $plan_speed_download);
    update_post_meta($post_id, 'speed_upload', $plan_speed_upload);
    update_post_meta($post_id, 'plan_price', $plan_price);
    update_post_meta($post_id, 'payment_tag', $plan_tag);
    update_post_meta($post_id, 'plan_button_text', $plan_button_text);
}
add_action('save_post', 'nautilusnet_save_metaboxes');
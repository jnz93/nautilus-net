/**
 * functions.js responsável por funções genéricas e reutilizaveis. Uma vez que esse arquivo vai ser carregado em todos os cantos do site
 * v1.0.0
 */

jQuery(document).ready(function(){
    
    // Elementos
    var menuMobile = jQuery('#main-menu'),
        screenWidth = jQuery(window).width();

    /**
     * Smooth scroll na rolagem das seções clicando nos links
     * @link https://css-tricks.com/snippets/jquery/smooth-scrolling/
     */
    jQuery('a[href*="#"]')
    // Remover links desnecessários da seleção
    .not('a[href="#"]')
    .not('a[href="#0"]')
    .click(function(event){
        // se for links da página atual
        if( location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname ){
            // Definição do target de rolagem
            var target = jQuery(this.hash);
            target = target.length ? target : jQuery('[name='+ jQuery(this.hash).slice(1) +']');
    
            // O target existe?
            if(target.length) {
                // Previne o padrão apenas se animação acontecer
                event.preventDefault();
                
                jQuery('html').animate({
                    scrollTop: target.offset().top
                }, 500);
            }
    
        }
        
        // Se for mobile faz ações no menu
        if( screenWidth < 600){
            // Econde o menu
            menuMobile.removeClass('mainMenuContainer__mobile--enabled');

            // Troca de ícones do botão do menu
            jQuery('#ico-menu').toggleClass('mainHeader__icoMenu--disabled');
            jQuery('#ico-close').toggleClass('mainHeader__icoMenu--disabled');
            
            // Esconder e mostrar o botão da notificação
            btnOpenNotification.toggleClass('notification__iconWrap--disabled');
        }
    });


    /**
     * Abrir e fechar a notificação
     * 
     */
    // Elementos
    var btnOpenNotification = jQuery('#openNotification'),
        appNotification = jQuery('#appNotification'),
        contentNotification = jQuery('.notification__content');

    // Ações mediante ao clique no botão
    btnOpenNotification.click(function(){

        // Troca dos icones no botão
        jQuery('#ico-show-notification').toggleClass('notification__icon--show notification__icon--disabled');
        jQuery('#ico-close-notification').toggleClass('notification__icon--disabled notification__icon--show');

        // Mostrar o conteúdo
        appNotification.toggleClass('notification__wrapper--expand');
        contentNotification.toggleClass('notification__content--show');
    });
});

/**
 * Fixed Header - Após determinada rolagem da página adiciona ao main header a classe fixed. O contrário acontece quando o usuário voltar ao inicio.
 * 
 */
jQuery(window).scroll(function(){
    var mainHeader = jQuery('.mainHeader');
    var offSetTop = jQuery(this).scrollTop();
    
    if( offSetTop >= 250){
        mainHeader.addClass('mainHeader__type--fixed');
    } else{
        mainHeader.removeClass('mainHeader__type--fixed');
    }

});


/////////////////////////////////////////////////////////////////////////////////////////////////////
// Função clickOpenCardsMobile() - Responsável por expandir os cards clicados na
// seção beneficios mobile.
/////////////////////////////////////////////////////////////////////////////////////////////////////
function clickOpenCardsMobile(el){
    var screenWidth = jQuery(window).width();

    // Se não for mobile não faz nada
    if( screenWidth > 500){
        return false;
    }

    // Elementos para manipulação
    var elToExpand  = el,
        elTitle     = el.find('.benefitCard__title'),
        elText      = el.find('.benefitCard__text'),
        btnClose    = el.siblings('.benefitCard__closeBtn');
        elCover     = el.siblings('.benefitCard__cover');

    // Expandir o card e seus elementos
    elToExpand.addClass('benefitCard__expandMobile');
    elTitle.addClass('benefitCard__title--expandMobile');
    elText.addClass('benefitCard__text--expandMobile');
    btnClose.addClass('benefitCard__closeBtn--showBtn');
    elCover.addClass('benefitCard__cover--expandMobile');

    // Fechar o card
    btnClose.click(function(){
        elToExpand.removeClass('benefitCard__expandMobile');
        elTitle.removeClass('benefitCard__title--expandMobile');
        elText.removeClass('benefitCard__text--expandMobile');
        elCover.removeClass('benefitCard__cover--expandMobile');

        jQuery(this).removeClass('benefitCard__closeBtn--showBtn');
    });
}


/////////////////////////////////////////////////////////////////////////////////////////////////////
// Função clickOpenContactCardMobile() - Responsável por expandir os cards clicados na
// seção contato mobile.
/////////////////////////////////////////////////////////////////////////////////////////////////////
function clickOpenContactCardMobile(el){
    var screenWidth = jQuery(window).width();

    // Se não for mobile não faz nada
    if( screenWidth > 500){
        return false;
    }

    // Elementos para manipulação
    var elToExpand  = el,
        elTitle     = el.find('.contactCard__title'),
        // elText      = el.find('.contactCard__text'),
        elBodyInfo  = el.find('.contactCard__list'),
        btnClose    = el.siblings('.contactCard__closeBtn');
        elCover     = el.siblings('.contactCard__cover');

    // Expandir o card e seus elementos
    elToExpand.addClass('contactCard__expandMobile');
    elTitle.addClass('contactCard__title--expandMobile');
    elBodyInfo.addClass('contactCard__list--expandMobile');
    btnClose.addClass('contactCard__closeBtn--showBtn');
    elCover.addClass('contactCard__cover--expandMobile');

    // Fechar o card
    btnClose.click(function(){
        elToExpand.removeClass('contactCard__expandMobile');
        elTitle.removeClass('contactCard__title--expandMobile');
        elBodyInfo.removeClass('contactCard__list--expandMobile');
        elCover.removeClass('contactCard__cover--expandMobile');

        jQuery(this).removeClass('contactCard__closeBtn--showBtn');
    });
}

/////////////////////////////////////////////////////////////////////////////////////////////////////
// Função clickOpenMenuMobile() - Abre e fecha o menu mobile
/////////////////////////////////////////////////////////////////////////////////////////////////////
function clickOpenMenuMobile(){

    // Elementos
    var menuMobile = jQuery("#main-menu"),
        btnOpenNotification = jQuery('#openNotification');
    
    // Troca de ícones do botão
    jQuery('#ico-menu').toggleClass('mainHeader__icoMenu--disabled');
    jQuery('#ico-close').toggleClass('mainHeader__icoMenu--disabled');

    // Esconder e mostrar o botão da notificação
    btnOpenNotification.toggleClass('notification__iconWrap--disabled');

    // Ações para mostrar o menu
    menuMobile.addClass('mainMenuContainer__mobile');
    menuMobile.toggleClass('mainMenuContainer__mobile--enabled');
}
/**
 * functions.js responsável por funções genéricas e reutilizaveis. Uma vez que esse arquivo vai ser carregado em todos os cantos do site
 * v1.0.0
 */

jQuery(document).ready(function(){
    
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
        jQuery('#ico-show').toggleClass('notification__icon--show notification__icon--disabled');
        jQuery('#ico-close').toggleClass('notification__icon--disabled notification__icon--show');

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

function clickCloseCardsMobile(el){

}
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
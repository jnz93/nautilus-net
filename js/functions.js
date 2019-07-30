/**
 * functions.js responsável por funções genéricas e reutilizaveis. Uma vez que esse arquivo vai ser carregado em todos os cantos do site
 * v1.0.0
 */

/**
 * Smooth scroll na rolagem das seções clicando nos links
 * @link https://css-tricks.com/snippets/jquery/smooth-scrolling/
 */
jQuery(document).ready(function(){

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
                console.log(target)
                // Previne o padrão apenas se animação acontecer
                event.preventDefault();
                
                jQuery('html').animate({
                    scrollTop: target.offset().top
                }, 500);
            }
    
        }
    
    });
})
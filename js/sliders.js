/**
 * sliders.js responsável por adicionar, remover e modificar slick-sliders nos elementos necessários
 * v1.0.0
 */
jQuery(document).ready(function(){
   
    var screenWidth = jQuery(window).width(),
        offset = jQuery(this).offset();
    
    /**
     * slider team cards - just mobile version
     */
    if( screenWidth <= 400 ){

        /**
         * Slick slider - Vantagens
         */
        jQuery('.sct__benefits > .sct__contentWrapper').slick({
            dots: true,
            arrows: false,
            infinite: false,
            slidesToShow: 1,
            slidesToScroll: 1
        });

        /**
         * Slick slider - Planos mobile
         */
        jQuery('.sct__plans > .sct__contentWrapper').slick({
            dots: true,
            arrows: true,
            infinite: false,
            slidesToShow: 1,
            slidesToScroll: 1,
        });


       
    };

    /**
     * slider team cards - above old desktop
     */
    if( screenWidth >= 860 ){
        /**
         * Slick slider - Planos desktop
         */
        jQuery('.sct__plans > .sct__contentWrapper').slick({
            dots: true,
            arrows: true,
            infinite: false,
            slidesToShow: 4,
            slidesToScroll: 4,
        });
        
        // Altearção no elemento do slider -> provisório
        jQuery('.sct__plans .slick-list').css({
            'min-height' : '540px'
        });

        jQuery('.sct__plans .slick-track').css({
            'margin' : '25px auto'
        })

    }
    // Adicionar ícones aos botões do slider
    var iconPrev = '<i class="" data-eva="arrow-circle-left"></i>',
        iconNext = '<i class="" data-eva="arrow-circle-right"></i>';

    jQuery('.slick-prev').text('').append(iconPrev);
    jQuery('.slick-next').text('').append(iconNext);
    eva.replace(); // Chamanda para dar replace nos ícones



    // Configurações Swiper Home
    var swiperHomeSection = new Swiper ('.swiper-container', 
    {
        direction: 'vertical',
        effect: 'coverflow',

        autoplay: {
            delay: 5800,
            disableOnInteraction: true
        },

        pagination: {
            el: '.swiper-pagination',
        },

        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev'
        }
    });
});